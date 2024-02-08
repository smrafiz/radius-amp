const mix = require("laravel-mix");
const fs = require("fs-extra");
const path = require("path");
const cliColor = require("cli-color");
const emojic = require("emojic");
const wpPot = require("wp-pot");
const os = require("os");
const archiver = require("archiver");

const package_path = path.resolve(__dirname);

const temDirectory = package_path + "/dist";

const package_slug = path.basename(path.resolve(package_path));

async function getVersion() {
	let data = await fs.readFile(package_path + "/radius-amp.php", "utf-8");
	const lines = data.split(/\r?\n/);
	let version = "";
	for (let i = 0; i < lines.length; i++) {
		if (lines[i].includes("* Version:") || lines[i].includes("*Version:")) {
			version = lines[i]
				.replace("* Version:", "")
				.replace("*Version:", "")
				.trim();
			break;
		}
	}
	return version;
}

if (process.env.NODE_ENV === "package") {
	mix.then(function () {
		const copyTo = path.resolve(`${temDirectory}/${package_slug}`);
		// Select All file then paste on list
		let includes = [
			"assets",
			"languages",
			"app",
			"templates",
			"vendor",
			"index.php",
			"README.txt",
			"LICENSE.txt",
			"radius-amp.php",
		];
		fs.ensureDir(copyTo, function (err) {
			if (err) return console.error(err);
			includes.map((include) => {
				fs.copy(
					`${package_path}/${include}`,
					`${copyTo}/${include}`,
					function (err) {
						if (err) return console.error(err);
						console.log(
							cliColor.white(`=> ${emojic.smiley}  ${include} copied...`)
						);
					}
				);
			});
			console.log(
				cliColor.white(`=> ${emojic.whiteCheckMark}  Build directory created`)
			);
		});
	});

	return;
}
if (
	process.env.NODE_ENV === "development" ||
	process.env.NODE_ENV === "production"
) {
	if (Mix.inProduction()) {
		let languages = path.resolve("languages");
		fs.ensureDir(languages, function (err) {
			if (err) return console.error(err); // if file or folder does not exist
			wpPot({
				package: "radius-amp",
				bugReport: "",
				src: "**/*.php",
				domain: "radius-amp",
				destFile: `languages/radius-amp.pot`,
			});
		});
	}
	mix.options({
		terser: {
			extractComments: false,
		},
		processCssUrls: false,
	});
	mix.js(`src/js/app.js`, `assets/js/`).sass(`src/sass/app.scss`, `assets/css/`);
}
if (process.env.NODE_ENV === "zip") {
	const version_get = getVersion();
	version_get.then(function (version) {
		const destinationPath = `${temDirectory}/${package_slug}.zip`;
		const output = fs.createWriteStream(destinationPath);
		const archive = archiver("zip", { zlib: { level: 9 } });
		output.on("close", function () {
			console.log(archive.pointer() + " total bytes");
			console.log(
				"Archive has been finalized and the output file descriptor has closed."
			);
			// fs.removeSync(`${temDirectory}/${package_slug}`);
		});
		output.on("end", function () {
			console.log("Data has been drained");
		});
		archive.on("error", function (err) {
			throw err;
		});

		archive.pipe(output);
		archive.directory(`${temDirectory}/${package_slug}`, package_slug);
		archive.finalize();
	});
}

<?php
/**
 * Template: HTML end.
 *
 * @package Radius_AMP
 */

use RT\Amp\Helpers\Fns;
?>

		</div><!-- #page -->
		<?php
		/**
		 * Footer.
		 */
		$this->load_parts( array( 'footer' ) );
		?>

	</div><!-- #content -->
	<?php
	do_action( 'amp_post_template_footer', $this );
	?>

</body>
</html>

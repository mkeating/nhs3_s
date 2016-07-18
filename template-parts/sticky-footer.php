<?php
/**
 * Template part for displaying sticky navigation for front page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package nhs3_s
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer site-footer-sticky" role="contentinfo">
		<div class="row-fluid">
				<div class=" col-lg-4 col-med-4 col-sm-4 col-xs-12 text-center">
					<a  href="<?php bloginfo('url')?>"><img src="<?php echo get_theme_mod( 'site_logo' ); ?>" class="brand-logo"/> </a>
						
					<div class="site-social"> 
						<?php

							$facebook =  get_theme_mod( 'facebook_textbox' );
							$twitter =  get_theme_mod( 'twitter_textbox');
							$instagram =  get_theme_mod( 'instagram_textbox');
							$linkedin =  get_theme_mod( 'linkedin_textbox');

							debug_to_console('facebook: ' . $facebook);

							if( $facebook != NULL ){
								?>
								<a href="<?php echo $facebook; ?>" ><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
							<?php
							}


							if( $twitter != NULL ){
								?>
								<a href="<?php echo $twitter; ?>" ><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
							<?php
							}


							if( $instagram != NULL ){
								?>
								<a href="<?php echo $instagram; ?>" ><i class="fa fa-instagram" aria-hidden="true"></i></a>
							<?php
							}

							if( $linkedin != NULL ){
								?>
								<a href="<?php echo $linkedin; ?>" ><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
							<?php
							}
						?>
					</div>



				</div><!-- .site-info -->

				<div class="col-lg-4 col-med-4 col-sm-4 col-xs-12 ">
					<div style="margin: 0 auto; width: 80%">
						<img src="http://localhost/wordpress/wp-content/uploads/2016/07/hthcsph_white.gif" /> <br /><br />
						<img src="http://localhost/wordpress/wp-content/uploads/2016/07/hms_white.gif" /><br /><br />
						<img src="http://localhost/wordpress/wp-content/uploads/2016/07/bwh_white.gif" />

					</div>
						
				</div>

				<div class="site-info col-lg-4 col-med-4 col-sm-4 col-xs-12 text-center">

						nhs3@channing.harvard.edu<br />
						Nurses’ Health Study<br />
						Channing Laboratory<br />
						181 Longwood Avenue<br />
						Boston, MA 02115<br />
						Telephone: 617-525-2279<br />
						Fax: 617-525-2008<br />

							<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'nhs3_s' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'nhs3_s' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'nhs3_s' ), 'nhs3_s', '<a href="http://underscores.me/" rel="designer">Michael Keating</a>' ); ?>
				</div>

			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<div class="push"></div>
<?php wp_footer(); ?>

</body>


</html>


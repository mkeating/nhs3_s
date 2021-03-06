<?php
/**
 * Template part for displaying big hero header on front page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package nhs3_s
 */

?>

<!-- Big Hero HHeader -->
	<header id="masthead" class="site-header" role="banner">
		<?php
			//get custom header image and add it to site-header
				$bg_image = get_header_image();
				
				$bg_large 	= get_theme_mod( 'bg_large' );
				$bg_med 	= get_theme_mod( 'bg_med' );
				$bg_small 	= get_theme_mod( 'bg_small' );		
		?>

		<div class="headerBg">
			<img  srcset="<?php echo $bg_small; ?> 320w, <?php echo $bg_med; ?> 700w, <?php echo $bg_large; ?> 1200w" sizes="100vw">
		</div>

		<div class="site-branding ">
			
			<img src="<?php echo get_theme_mod( 'site_logo' ); ?>" class="logo">
			<?php

			/*if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
			<?php else : ?>
				<p class="site-title"><?php bloginfo( 'name' ); ?></p>
			<?php
			endif;*/

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>

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

			<div class="buttons">
				
				<div class="row-fluid">
					<button class="btn" id="cta-btn"> <?php echo get_theme_mod( 'button_textbox', 'Call to Action!' ); ?> </button>
				</div>

				<div class="row-fluid">
					<div id="sec-btn-label"><?php echo get_theme_mod( 'sec_button_label' ); ?></div>
					<a class="btn" href="<?php echo site_url().get_theme_mod( 'sec_button_target' ); ?>"> 
						<button class="btn" id="sec-btn"><?php echo get_theme_mod( 'sec_button_textbox', 'Log in!' ); ?> </button>
					</a>
				</div>
					
			</div>

			<script type="text/javascript">

				jQuery("#cta-btn").click(function(){
						
							jQuery( "html, body" ).animate({scrollTop: jQuery("#main").offset().top  }, 800);
							return false; 
							});

			</script>
		</div><!-- .site-branding -->

		<?php
			get_template_part( 'template-parts/sticky-nav', get_post_format() );

			?>

		<!--<nav id="site-navigation" class="main-navigation navbar navbar-default" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'nhs3_s' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
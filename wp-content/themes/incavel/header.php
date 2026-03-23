<?php
// Garante que a sessão esteja iniciada antes de qualquer saída HTML.
if ( ! session_id() ) {
	session_start();
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
		// Estratégia por sessão para tags/códigos da filial:
		// primeiro tenta sessão; se não houver, usa o comportamento original (the_field/get_field da página atual).
		$session_meta_tags = ! empty( $_SESSION['filial_meta_tags'] ) ? $_SESSION['filial_meta_tags'] : '';
		$session_code_head = ! empty( $_SESSION['filial_codigo_personalizado_head'] ) ? $_SESSION['filial_codigo_personalizado_head'] : '';
		$session_code_body = ! empty( $_SESSION['filial_codigo_personalizado_body'] ) ? $_SESSION['filial_codigo_personalizado_body'] : '';

		$field_meta_tags = get_field( 'meta_tags' );
		$field_code_head = get_field( 'codigo_personalizado_head' );
		$field_code_body = get_field( 'codigo_personalizado_body' );

		$incavel_meta_tags = ! empty( $session_meta_tags ) ? $session_meta_tags : $field_meta_tags;
		$incavel_code_head = ! empty( $session_code_head ) ? $session_code_head : $field_code_head;
		$incavel_code_body = ! empty( $session_code_body ) ? $session_code_body : $field_code_body;
	?>

	<?php if ( $is_filial ) : ?>
		<?php if ( ! empty( $incavel_meta_tags ) ) : ?>
			<meta name="google-site-verification" content="<?php echo (string) $incavel_meta_tags; ?>" />
		<?php endif; ?>
	<?php endif; ?>
	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<!--     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700;800&display=swap" rel="stylesheet"> -->

    <!-- Inclua o jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Inclua o JS do Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- GSAP ScrollTrigger Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.0/ScrollTrigger.min.js"></script>
    <!-- GSAP (TweenMax) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.0/gsap.min.js"></script>



    <?php wp_head(); ?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/style-mobile.css" media="screen and (min-width: 320px) and (max-width: 767px)">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/style-desktop.css" media="screen and (min-width: 768px)">
	
		<?php if ( $is_filial ) : ?>
			<script>
				<?php
				if ( ! empty( $incavel_code_head ) ) {
					echo (string) $incavel_code_head; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
			</script>
		<?php endif; ?>

		<?php if ( ! $is_filial ) : ?>
		<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-KJN2SP2');</script>
			<!-- End Google Tag Manager -->
		<?php endif; ?>

</head>

<?php
	$navbar_scheme   = get_theme_mod( 'navbar_scheme', 'navbar-light bg-light' ); // Get custom meta-value.
	$navbar_position = get_theme_mod( 'navbar_position', 'static' ); // Get custom meta-value.

	$search_enabled  = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
?>
	
<body <?php body_class(); ?>>
	<?php if ( $is_filial ) : ?>
		<script>
			<?php
			if ( ! empty( $incavel_code_body ) ) {
				echo (string) $incavel_code_body; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
		</script>
	<?php endif; ?>

	<?php if ( ! $is_filial ) : ?>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KJN2SP2"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
	<?php endif; ?>

<?php wp_body_open(); ?>
	
<a href="#main" class="visually-hidden-focusable"><?php esc_html_e( 'Skip to main content', 'incavel' ); ?></a>

<div id="wrapper">
	<header id="main-header">
		<?php
		// 1) Detecta domínio atual e se é filial (qualquer domínio diferente de incavel.com.br).
		$public_host        = function_exists( 'incavel_get_current_public_host' ) ? incavel_get_current_public_host() : ( $_SERVER['HTTP_HOST'] ?? '' );
		$public_host_no_www = preg_replace( '/^www\./', '', $public_host );
		$is_filial          = ( $public_host_no_www && 'incavel.com.br' !== $public_host_no_www );

		// 2) Logo da filial:
		//    - primeiro tenta pelo domínio (helper PHP),
		//    - se vazio, tenta sessão (setada em single-representantes),
		//    - se ainda vazio, cai na logo padrão do tema no HTML abaixo.
		$filial_logo = '';
		if ( $is_filial && function_exists( 'incavel_get_filial_logo_for_current_domain' ) ) {
			$filial_logo = incavel_get_filial_logo_for_current_domain();
		}
		if ( $is_filial && ! $filial_logo && ! empty( $_SESSION['filial_logo'] ) ) {
			$filial_logo = $_SESSION['filial_logo'];
		}

		// 3) WhatsApp do header:
		//    - cookie revenda_whatsapp (mesma "sessão" já usada em single-produto),
		//    - se vazio, helper PHP por domínio,
		//    - se vazio, WhatsApp global das opções do tema.
		$header_wamelink = '';
		if ( ! empty( $_COOKIE['revenda_whatsapp'] ) ) {
			$header_wamelink = esc_url_raw( $_COOKIE['revenda_whatsapp'] );
		}
		if ( ! $header_wamelink && function_exists( 'incavel_get_revenda_whatsapp_link_for_current_domain' ) ) {
			$header_wamelink = incavel_get_revenda_whatsapp_link_for_current_domain();
		}
		if ( ! $header_wamelink && function_exists( 'get_field' ) ) {
			$global_whatsapp = get_field( 'whatsapp', 'option' );
			if ( ! empty( $global_whatsapp ) ) {
				$search          = array( ' ', '-', '(', ')' );
				$number          = str_replace( $search, '', $global_whatsapp );
				$number          = ltrim( $number, '+' );
				$header_wamelink = 'https://wa.me/' . $number;
			}
		}
		?>

		<nav id="header" class="d-none d-md-block navbar navbar-expand-md <?php echo esc_attr( $navbar_scheme ); if ( is_home() || is_front_page() ) : echo ' home'; endif; ?>">
			<div class="container">
				<a class="navbar-brand" href="/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php
					// Em domínios de filial, prioriza o logo do ACF do representante.
					if ( $is_filial && ! empty( $filial_logo ) ) :
						?>
						<img src="<?php echo esc_url( $filial_logo ); ?>" style="height:200px;max-height:200px;width:auto;" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
					<?php
					else :
						$header_logo = get_theme_mod( 'header_logo' ); // Get custom meta-value.

						if ( ! empty( $header_logo ) ) :
							?>
							<img src="<?php echo esc_url( $header_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
							<?php
						else :
							echo esc_attr( get_bloginfo( 'name', 'display' ) );
						endif;
					endif;
					?>
				</a>

				<?php if ( ! $is_filial ) : ?>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'incavel' ); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div id="navbar" class="collapse navbar-collapse ">
						<?php
							// Menu completo apenas no domínio principal.
							wp_nav_menu(
								array(
									'menu_class'     => 'navbar-nav me-auto',
									'container'      => '',
									'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
		//							'walker'         => new WP_Bootstrap_Navwalker(),
									'theme_location' => 'main-menu',
								)
							);
						?>
	                    <a href="<?php echo esc_url( $header_wamelink ); ?>" target="_blank" class="whatsapp-header">
	                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg> Entre em contato!</a>

					</div><!-- /.navbar-collapse -->
				<?php else : ?>
					<a href="<?php echo esc_url( $header_wamelink ); ?>" target="_blank" class="whatsapp-header">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg> Entre em contato!</a>
				<?php endif; ?>
			</div><!-- /.container -->
		</nav><!-- /#header -->


<!--        mobile nav -->

        <nav id="header" class="d-block d-md-none navbar navbar-expand-md <?php echo esc_attr( $navbar_scheme ); if ( is_home() || is_front_page() ) : echo ' home'; endif; ?>">
            <div class="container">
                <a class="navbar-brand" href="/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php
					// Mesma lógica de logo para mobile.
					if ( $is_filial && ! empty( $filial_logo ) ) :
						?>
						<img src="<?php echo esc_url( $filial_logo ); ?>" style="height:200px;max-height:200px;width:auto;" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
					<?php
					else :
						$header_logo = get_theme_mod( 'header_logo' ); // Get custom meta-value.

						if ( ! empty( $header_logo ) ) :
							?>
							<img src="<?php echo esc_url( $header_logo ); ?>" style="height:100px;max-height:100px;width:auto;" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
							<?php
						else :
							echo esc_attr( get_bloginfo( 'name', 'display' ) );
						endif;
					endif;
					?>
                </a>

                <a href="<?php echo esc_url( $header_wamelink ); ?>" target="_blank" class="whatsapp-header" style="width:56px; height: 40px; padding:18px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px;" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg></a>

				<?php if ( ! $is_filial ) : ?>
	                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'incavel' ); ?>" style="border-radius: 2px;">
	                    <span class="navbar-toggler-icon"></span>
	                </button>

	                <div id="navbar" class="collapse navbar-collapse ">
	                    <?php
		                    wp_nav_menu(
		                        array(
		                            'menu_class'     => 'navbar-nav me-auto',
		                            'depth'          => 3,
		                            'container'      => '',
		                            'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
		                            'walker'         => new WP_Bootstrap_Navwalker(),
		                            'theme_location' => 'main-menu-mobile',
		                        )
		                    );
	                    ?>
	                </div><!-- /.navbar-collapse -->
				<?php endif; ?>
            </div><!-- /.container -->
        </nav><!-- /#header -->
	</header>
	<main id="main">

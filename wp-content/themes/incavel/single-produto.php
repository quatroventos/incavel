<?php
get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?> class="page filial">

    <!--    hero -->
    <?php if (!empty(get_field('cabecalho'))) { ?>

        <div class="container-fluid hero hero-produto" style="background-image: url('<?php the_field('cabecalho'); ?>');">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow1">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow2">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/white.svg" id="hero-arrow3">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1 class="hero-title"><?php the_title(); ?></h1>
                        <p class="hero-caption"><?php echo the_field('subtitulo'); ?></p>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
    <!--    hero -->

    <!-- produto -->

    <div class="container container-single-product">
        <div class="row">
            <div class="col-md-6 col-sm-12 product-content" style="position:relative; ">
                <h2><?php the_title(); ?></h2>
                <p><?php the_content(); ?></p>
				<?php
				$produto_wamelink = '';

				// 1) Se houver cookie de revenda (setado na página de representantes) e não estivermos no domínio principal, usa ele.
				$host = incavel_get_current_public_host();
				$host = preg_replace( '/^www\./', '', $host );
				if ( 'incavel.com.br' !== $host && ! empty( $_COOKIE['revenda_whatsapp'] ) ) {
					$produto_wamelink = esc_url_raw( $_COOKIE['revenda_whatsapp'] );
				}

				// 2) Se não tiver cookie, tenta descobrir a revenda pelo domínio.
				if ( ! $produto_wamelink && function_exists( 'incavel_get_revenda_whatsapp_link_for_current_domain' ) ) {
					$produto_wamelink = incavel_get_revenda_whatsapp_link_for_current_domain();
				}

				// 3) Fallback: WhatsApp global (opções do tema).
				if ( ! $produto_wamelink && function_exists( 'get_field' ) ) {
					$global_whatsapp = get_field( 'whatsapp', 'option' );
					if ( ! empty( $global_whatsapp ) ) {
						$search           = array( ' ', '-', '(', ')' );
						$number           = str_replace( $search, '', $global_whatsapp );
						$number           = ltrim( $number, '+' );
						$produto_wamelink = 'https://wa.me/' . $number;
					}
				}
				?>
                <a href="<?php echo esc_url( $produto_wamelink ); ?>" class=" d-flex align-items-center contact">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="24" viewBox="0 0 23 24" fill="none"><path d="M19.5089 3.88839C21.6652 6.04464 23 8.8683 23 11.9487C23 18.2121 17.7634 23.346 11.4487 23.346C9.54911 23.346 7.70089 22.8326 6.0067 21.9598L0 23.5L1.59152 17.596C0.616071 15.9018 0.0513393 13.9509 0.0513393 11.8973C0.0513393 5.63393 5.18527 0.5 11.4487 0.5C14.529 0.5 17.404 1.73214 19.5089 3.88839ZM11.4487 21.3951C16.6853 21.3951 21.0491 17.1339 21.0491 11.9487C21.0491 9.3817 19.971 7.02009 18.1741 5.22321C16.3772 3.42634 14.0156 2.45089 11.5 2.45089C6.26339 2.45089 2.00223 6.71205 2.00223 11.8973C2.00223 13.6942 2.51562 15.4397 3.43973 16.9799L3.69643 17.3393L2.72098 20.8304L6.31473 19.8549L6.62277 20.0603C8.11161 20.933 9.75446 21.3951 11.4487 21.3951ZM16.6853 14.3103C16.942 14.4643 17.1473 14.5156 17.1987 14.6696C17.3013 14.7723 17.3013 15.3371 17.0446 16.0045C16.7879 16.6719 15.6585 17.2879 15.1451 17.3393C14.221 17.4933 13.5022 17.442 11.7054 16.6205C8.83036 15.3884 6.98214 12.5134 6.82812 12.3594C6.67411 12.154 5.69866 10.8192 5.69866 9.3817C5.69866 7.99554 6.41741 7.32812 6.67411 7.02009C6.9308 6.71205 7.23884 6.66071 7.4442 6.66071C7.59821 6.66071 7.80357 6.66071 7.95759 6.66071C8.16295 6.66071 8.3683 6.60938 8.625 7.17411C8.83036 7.73884 9.44643 9.125 9.49777 9.27902C9.54911 9.43304 9.60045 9.58705 9.49777 9.79241C8.98438 10.8705 8.3683 10.8192 8.67634 11.3326C9.8058 13.2321 10.8839 13.8996 12.5781 14.721C12.8348 14.875 12.9888 14.8237 13.1942 14.6696C13.3482 14.4643 13.9129 13.7969 14.067 13.5402C14.2723 13.2321 14.4777 13.2835 14.7344 13.3862C14.9911 13.4888 16.3772 14.1562 16.6853 14.3103Z" fill="white"/></svg>
                     Entre em contato!</a>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="owl-carousel galeria">
                    <?php
                    $galeria = get_field('fotos'); // Obtém a galeria do ACF
                    if ($galeria) {
                        foreach ($galeria as $foto) {
                            ?>
                            <div class="item">
                                <img src="<?php echo $foto['url']; ?>" alt="Parceiro">
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- produto -->


    <!--        Produtos  -->
    <div class="container home-produtos-container">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="produtos-arrow1">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="produtos-arrow2">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/ghost.svg" id="produtos-arrow3">
        <div class="row">
            <div class="col-md-1" style="position:relative">
                <h2 class="rotated-title">Produtos</h2>
            </div>
            <div class="col-md-11">
                <div class="row home-produtos">
                    <?php
                    // Arguments for the custom query
                    $args = array(
                        'post_type' => 'produto', // Nome do seu custom post type
                        'posts_per_page' => 10, // Mostrar todos os produtos
                    );

                    $query = new WP_Query($args);

                    // Loop através dos produtos
                    while ($query->have_posts()) : $query->the_post();
                        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); // Tamanho da imagem em miniatura do WordPress

                        ?>
                        <div class="home-produto">
                            <div class="home-produto-item" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');">
                                <a href="<?php the_permalink(); ?>">
                                <div class="home-produto-overlay">
                                    <h3><?php the_title(); ?></h3>
                                </div>
                                </a>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); // Restaura os dados originais do post global
                    ?>
                </div>
            </div>
        </div>
    </div><!-- /.container -->
    <!--        Produtos  -->

    <!--carrossel-->
    <script>
        $(document).ready(function(){

            $('.galeria').owlCarousel({
                items: 1, // Quantidade de itens por slide
                margin:0,
                loop: true, // Loop infinito
                nav: false, // Mostrar botões de navegação
                dots: false, // Desabilitar indicadores
                smartSpeed: 1000,
                autoplay:true,
                autoplayTimeout:3000,
                autoplayHoverPause:false
            });

        });
    </script>
    <!--carrossel-->

    <!--animações-->
    <script>

        gsap.registerPlugin(ScrollTrigger);

        function startSlowMovement() {
            gsap.to("#hero-arrow2", { x: "+=12", scale:1.3, duration: 5, ease: "linear", repeat: -1, yoyo: true });
            gsap.to("#hero-arrow1", { x: "+=10", scale:1.2, duration: 5, delay: 0.2, ease: "linear", repeat: -1, yoyo: true });
            gsap.to("#hero-arrow3", { x: "+=8", scale:1.1, duration: 5, delay: 0.4, ease: "linear", repeat: -1, yoyo: true });
        }

        gsap.from(".hero-title", { x: -200, opacity: 0, duration: 1, delay: 0, ease: "power2.out"});
        gsap.from(".hero-caption", { opacity: 0, duration: 1, delay: 0.2, ease: "power2.out"});
        gsap.from(".hero .btn-contact", { opacity: 0, duration: 1, delay: 0.4, ease: "power2.out"});

        gsap.from("#hero-arrow2", { x: -400, opacity: 0, duration: 1, delay: 0.2, ease: "power2.out" });
        gsap.from("#hero-arrow1", { x: -400, opacity: 0, duration: 1, delay: 0.4, ease: "power2.out" });
        gsap.from("#hero-arrow3", { x: -400, opacity: 0, duration: 1, delay: 0.6, ease: "power2.out", onComplete: startSlowMovement });


        gsap.from("#produtos-arrow2",{
            scrollTrigger:{
                trigger: ".home-produtos",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            x: -400, opacity: 0, duration: 1, delay: 0, ease: "power2.out" });

        gsap.from("#produtos-arrow1",{
            scrollTrigger:{
                trigger: ".home-produtos",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            x: -400, opacity: 0, duration: 1, delay: 0.2, ease: "power2.out" });

        gsap.from("#produtos-arrow3",{
            scrollTrigger:{
                trigger: ".home-produtos",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            x: -400, opacity: 0, duration: 1, delay: 0.6, ease: "power2.out" });


        gsap.from("#map-arrow2",{
            scrollTrigger:{
                trigger: ".map",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            x: -400, opacity: 0, duration: 1, delay: 0, ease: "power2.out" });

        gsap.from("#map-arrow1",{
            scrollTrigger:{
                trigger: ".map",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            x: -400, opacity: 0, duration: 1, delay: 0.2, ease: "power2.out" });

        gsap.from("#map-arrow3",{
            scrollTrigger:{
                trigger: ".map",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            x: -400, opacity: 0, duration: 1, delay: 0.6, ease: "power2.out" });


        gsap.from("#blocos-arrow2",{
            scrollTrigger:{
                trigger: ".container-qualidade",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            y: -400, opacity: 0, duration: 1, delay: 0, ease: "power2.out" });

        gsap.from("#blocos-arrow1",{
            scrollTrigger:{
                trigger: ".container-qualidade",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            y: -400, opacity: 0, duration: 1, delay: 0.2, ease: "power2.out" });

        gsap.from("#blocos-arrow3",{
            scrollTrigger:{
                trigger: ".container-qualidade",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            y: -400, opacity: 0, duration: 1, delay: 0.6, ease: "power2.out" });



    </script>
    <!--animações-->

</div>
<?php
    }
}
get_footer();

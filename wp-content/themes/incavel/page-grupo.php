<?php
/**
 * Template Name: Grupo Incavel
 * Description: Página quem somos.
 *
 */

get_header();
the_post();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?> class="page grupo">
<!--    hero -->
    <?php
    $hero = get_field('hero');
    if( $hero ): ?>
        <div class="container-fluid" id="hero" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.40) 0%, rgba(0, 0, 0, 0.40) 100%), url('<?php echo esc_url( $hero['imagem'] ); ?>') no-repeat center / 100% 148.311%; background-color: lightgray; background-size: cover;">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow1">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow2">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/white.svg" id="hero-arrow3">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-12">
                        <h1>  <?php echo $hero['título']; ?></h1>
                        <p>  <?php echo $hero['subtitulo']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<!--    mapa -->
    <div class="container map-container">

        <div class="row">
            <div class="col-md-8 col-sm-12">
                <img class="map" src="<?php echo get_stylesheet_directory_uri(); ?>/img/map.svg">
            </div>
            <div class="col-md-4 col-sm-12 map-text">

                <!-- Bloco 1 -->
                    <?php
                    $bloco1 = get_field('bloco1');
                    if( $bloco1 ): ?>
                        <h3><?php echo $bloco1['titulo']; ?></h3>
                        <p><?php echo $bloco1['texto']; ?></p>
                    <?php endif; ?>
                <!--  Bloco 1 -->

                <!-- Bloco 2 -->
                <?php
                $bloco2 = get_field('bloco2');
                if( $bloco2 ): ?>
                    <h3><?php echo $bloco2['titulo']; ?></h3>
                    <p><?php echo $bloco2['texto']; ?></p>
                <?php endif; ?>
                <!--  Bloco 2 -->

                <div class="row mt-5 map-whatsapp d-flex align-items-center">
                    <div class="col d-flex align-items-center"><h4>Não encontrou o que procurava?</h4></div>
                    <div class="col d-flex align-items-center"><button><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/whatsapp.svg"> Entre em contato!</button></div>
                </div>
            </div>
        </div>
    </div>


    <!-- search -->
    <div class="container-fluid busca-container ">
        <div class="container busca mt-5">
            <div class="row">
                <div class="col-md-6 col-sm-12 d-flex align-items-center">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/search-logo.svg" width="500">
                </div>
                <div class="col-md-6 col-sm-12 d-flex align-items-center">
                    <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- search -->

    <!-- blocks -->
    <?php if( get_field('bloco4') || get_field('bloco5') ): ?>
    <div class="container container-qualidade">

        <!-- Bloco 4 -->
        <?php
        $bloco4 = get_field('bloco4');
        if( $bloco4 ): ?>
            <div class="row">
                <div class="col-md-6 col-sm-12 texto">
                    <h2><?php echo $bloco4['titulo']; ?></h2>
                    <?php echo $bloco4['texto']; ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/ghost-arrow-down.svg" id="qualidade-arrow1">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/grey-arrow-down.svg" id="qualidade-arrow2">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/grey-arrow-down.svg" id="qualidade-arrow3">
                </div><!--col-->
                <div class="col-md-6 col-sm-12 imagem">
                    <img src="<?php echo $bloco4['imagem']; ?>">
                </div><!--col-->
            </div><!-- row-->
        <?php endif; ?>
        <!--  Bloco 4 -->

        <!-- Bloco 5 -->
        <?php
        $bloco5 = get_field('bloco5');
        if( $bloco5 ): ?>
            <div class="row mt-5">
                <div class="col-md-6 col-sm-12 imagem d-flex">
                    <img src="<?php echo $bloco5['imagem']; ?>">
                </div><!--col-->
                <div class="col-md-6 col-sm-12 texto">
                    <h2><?php echo $bloco5['titulo']; ?></h2>
                    <?php echo $bloco5['texto']; ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/ghost-arrow-down.svg" id="qualidade-arrow1">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/grey-arrow-down.svg" id="qualidade-arrow2">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/grey-arrow-down.svg" id="qualidade-arrow3">qualidade                </div><!--col-->

            </div><!-- row-->
        <?php endif; ?>
        <!--  Bloco 5 -->

    </div><!--container-->
    <?php endif; ?>

    <!-- blocks -->

</div>

    <!--animações-->
    <script>

        gsap.registerPlugin(ScrollTrigger);

        function startSlowMovement() {
            gsap.to("#hero-arrow2", { x: "+=12", scale:1.3, duration: 5, ease: "linear", repeat: -1, yoyo: true });
            gsap.to("#hero-arrow1", { x: "+=10", scale:1.2, duration: 5, delay: 0.2, ease: "linear", repeat: -1, yoyo: true });
            gsap.to("#hero-arrow3", { x: "+=8", scale:1.1, duration: 5, delay: 0.4, ease: "linear", repeat: -1, yoyo: true });
        }

        gsap.from("#hero h1", { x: -200, opacity: 0, duration: 1, delay: 0, ease: "power2.out"});
        gsap.from("#hero p", { opacity: 0, duration: 1, delay: 0.2, ease: "power2.out"});
        gsap.from(".video-button", { opacity: 0, duration: 1, delay: 0.4, ease: "power2.out"});

        gsap.from("#hero-arrow2", { x: -400, opacity: 0, duration: 1, delay: 0.2, ease: "power2.out" });
        gsap.from("#hero-arrow1", { x: -400, opacity: 0, duration: 1, delay: 0.4, ease: "power2.out" });
        gsap.from("#hero-arrow3", { x: -400, opacity: 0, duration: 1, delay: 0.6, ease: "power2.out", onComplete: startSlowMovement });

        gsap.from("#compromisso-arrow2",{
            scrollTrigger:{
                trigger: ".container-compromisso",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            x: -400, opacity: 0, duration: 1, delay: 0, ease: "power2.out" });

        gsap.from("#compromisso-arrow1",{
            scrollTrigger:{
                trigger: ".container-compromisso",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            x: -400, opacity: 0, duration: 1, delay: 0.2, ease: "power2.out" });

        gsap.from("#compromisso-arrow3",{
            scrollTrigger:{
                trigger: ".container-compromisso",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            x: -400, opacity: 0, duration: 1, delay: 0.6, ease: "power2.out" });


        gsap.from("#qualidade-arrow2",{
            scrollTrigger:{
                trigger: ".container-qualidade",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            y: -400, opacity: 0, duration: 1, delay: 0, ease: "power2.out" });

        gsap.from("#qualidade-arrow1",{
            scrollTrigger:{
                trigger: ".container-qualidade",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            y: -400, opacity: 0, duration: 1, delay: 0.2, ease: "power2.out" });

        gsap.from("#qualidade-arrow3",{
            scrollTrigger:{
                trigger: ".container-qualidade",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            y: -400, opacity: 0, duration: 1, delay: 0.6, ease: "power2.out" });


    </script>
    <!--animações-->

<?php
get_footer();

<?php
/**
 * Template Name: Quem somos
 * Description: Página quem somos.
 *
 */

get_header();
the_post();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?> class="page quem-somos">
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
                    <div class="col-md-7">
                        <h1>  <?php echo $hero['título']; ?></h1>
                        <p>  <?php echo $hero['subtitulo']; ?></p>
                    </div>
                    <div class="col">
                        <a href="<?php echo $hero['video_url'] ?>" target="_blank" class="video-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="94" viewBox="0 0 80 94" fill="none">
                                <path d="M5 1.39141C8.125 -0.4974 12.0833 -0.4974 15.2083 1.60128L75.2083 38.3282C78.125 40.217 80 43.5749 80 46.9328C80 50.5005 78.125 53.8584 75.2083 55.5373L15.2083 92.4741C12.0833 94.3629 8.125 94.5728 5 92.684C1.875 91.005 0 87.6471 0 83.8695V9.996C0 6.42824 1.875 3.07035 5 1.39141ZM13.3333 4.32956C11.25 3.07035 8.75 3.07035 6.66667 4.32956C4.58333 5.3789 3.33333 7.68745 3.33333 9.996V83.8695C3.33333 86.3879 4.58333 88.6965 6.66667 89.7458C8.75 91.005 11.25 91.005 13.3333 89.7458L73.3333 52.8091C75.4167 51.5498 76.6667 49.4512 76.6667 46.9328C76.6667 44.6242 75.4167 42.5255 73.3333 41.2663L13.3333 4.32956Z" fill="white"/>
                            </svg>
                            <p>Veja nosso<br>vídeo institucional</p>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    <?php endif; ?>

<!--    compromissos -->
    <?php
        if( have_rows('compromissos') ):
            ?>
            <div class="container compromisso-container">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/grey.svg" id="compromisso-arrow1">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/grey.svg" id="compromisso-arrow2">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/ghost.svg" id="compromisso-arrow3">
                <div class="row">
                    <div class="col-md-1 col-sm-12" style="position:relative">
                        <h2 class="rotated-title">Nosso<br><span class="red-title">Compromisso</span></h2>
                    </div><!-- col -->
                    <div class="col-md-7 col-sm-12">
                        <ul>
                            <?php
                                // Loop through rows.
                                while( have_rows('compromissos') ) : the_row();
                                    echo "<li>".get_sub_field('compromisso')."</li>";
                                endwhile;
                            ?>
                        </ul>
                    </div> <!-- col -->
                    <div class="col-md-4 col-sm-12 d-flex justify-content-center align-items-center">
                       <img src="<?php the_field('foto') ?>">
                    </div><!-- col -->
                </div> <!--row -->
            </div> <!-- container -->
    <?php
        endif;
    ?>

<!--    historia-->
    <?php
    $historia = get_field('historia');
    if( $historia ): ?>
        <div class="container-fluid historia-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h2>  <?php echo $historia['titulo']; ?></h2>
                        <p class="lead"><?php echo $historia['subtitulo']; ?></p>
                    </div> <!-- col -->

                    <div class="col-md-6 col-sm-12 description">
                        <?php echo $historia['historia']; ?>
                    </div>
                </div> <!-- row -->

                <div class="row galeria">

                    <?php
                    $images = $historia['fotos'];
                    $size = 'medium'; // (thumbnail, medium, large, full or custom size)
                    if( $images ): ?>

                        <?php foreach( $images as $image ): ?>
                        <div class="col foto">
                            <img src="<?php echo $image; ?>">
                        </div>
                        <?php endforeach; ?>

                    <?php endif; ?>

                </div> <!-- row -->

            </div> <!-- container -->
        </div> <!-- container-fluid -->

    <?php endif; ?>


<!--    missao-->
    <?php
    $missao = get_field('missao');
    if( $missao ): ?>

        <div class="container container-missao">
            <div class="row">
                <div class="col">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/rapidez-e-qualidade.svg" style="max-width: 100%;">
                </div>
            </div>
            <div class="row mt-5">

                <div class="d-block d-md-none col-md-6 col-sm-12">
                    <h2><?php echo $missao['titulo']; ?></h2>
                </div>

                <div class="col-md-6 col-sm-12 missao">
                    <?php echo $missao['missao']; ?>
                </div> <!-- col -->

                <div class="d-none d-md-block col-md-6 col-sm-12">
                    <h2><?php echo $missao['titulo']; ?></h2>
                </div>
            </div> <!-- row -->

            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/ghost-arrow-down.svg" id="missao-arrow1">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/grey-arrow-down.svg" id="missao-arrow2">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/grey-arrow-down.svg" id="missao-arrow3">


        </div> <!-- container -->

    <?php endif; ?>

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


        gsap.from("#missao-arrow2",{
            scrollTrigger:{
                trigger: ".container-missao",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            y: -400, opacity: 0, duration: 1, delay: 0, ease: "power2.out" });

        gsap.from("#missao-arrow1",{
            scrollTrigger:{
                trigger: ".container-missao",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            y: -400, opacity: 0, duration: 1, delay: 0.2, ease: "power2.out" });

        gsap.from("#missao-arrow3",{
            scrollTrigger:{
                trigger: ".container-missao",
                toggleActions: "restart reset resume pause",
                start: "top bottom"
            },
            y: -400, opacity: 0, duration: 1, delay: 0.6, ease: "power2.out" });



    </script>
    <!--animações-->

<?php
get_footer();

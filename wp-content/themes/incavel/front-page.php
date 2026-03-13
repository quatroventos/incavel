<?php
/**
 * Template Name: Page (Default)
 * Description: Page template with Sidebar on the left side.
 *
 */

get_header();

the_post();
?>

    <div class="owl-carousel hero">
        <?php
        // ACF Repeater Loop
        if (have_rows('carrossel')) {
            while (have_rows('carrossel')) {
                the_row();
                $image_url = get_sub_field('imagem');
                $title = get_sub_field('titulo');
                $subtitle = get_sub_field('subtitulo');
                ?>
                <div class="item" style="background-image: url('<?php echo $image_url; ?>');">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow1">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow2">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/white.svg" id="hero-arrow3">
                    <div class="carousel-caption">
                        <h2 class="hero-title"><?php echo $title; ?></h2>
                        <p class="hero-caption"><?php echo $subtitle; ?></p>
                        <a href="/contato" class="btn-contact">Entre em contato</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <!--        Marcas  -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="owl-carousel marcas">
                    <?php
                    $marcas_parceiras = get_field('marcas_parceiras'); // Obtém a galeria do ACF

                    if ($marcas_parceiras) {
                        foreach ($marcas_parceiras as $marca) {
                            $imagem = $marca['url'];
                            ?>
                            <div class="item">
                                <img src="<?php echo $imagem; ?>" alt="Parceiro">
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!--        Marcas  -->

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
                        $produto_nome = get_the_title();
                        ?>
                        <div class="home-produto">
                            <div class="home-produto-item" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');">
                                <a href="<?php the_permalink(); ?>">
                                <div class="home-produto-overlay">
                                    <h3><?php echo esc_html($produto_nome); ?></h3>
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


    <div class="container-fluid depoimentos-container">
        <div class="container">
            <div class="row">
                <div class="col-12 chamada d-block d-sm-none d-m-none">
                    Qualidade que <strong>nossos clientes confiam.</strong>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="owl-carousel depoimentos">
                        <?php
                        // ACF Repeater Loop
                        if (have_rows('depoimentos')) {
                            while (have_rows('depoimentos')) {
                                the_row();
                                $nome = get_sub_field('nome');
                                $depoimento = get_sub_field('depoimento');
                                ?>
                                <div class="item">
                                    <p class="depoimento"><?php echo $depoimento; ?></p>
                                    <p class="nome"><?php echo $nome; ?></p>
                                </div>

                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-6 chamada d-none d-m-block d-lg-block">
                    Qualidade que <strong>nossos clientes confiam.</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- search -->
    <div class="container-fluid busca-container ">
        <div class="container busca">
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

    <!-- map -->
    <div class="container map-container">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/grey.svg" id="map-arrow1">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/ghost.svg" id="map-arrow2">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <img class="map" src="<?php echo get_stylesheet_directory_uri(); ?>/img/map.svg">
                <div class="map-title">
                    <h4>GRUPO INCAVEL</h4>
                    <h2>Sobre<br><strong>Nós</strong></h2>
                </div>
            </div>
            <div class="col map-text">
                <h3>Tradição <strong>desde 1979</strong></h3>
                <p>O Grupo Incavel nasceu de um sonho de um empreendedor de oferecer peças para ônibus e, assim, ajudar empresários a fazer o transporte de pessoas em um país em crescimento. Foi assim que, em 1979, a Incavel começou a operar em Curitiba: com muita vontade de atender com qualidade.</p>

                <h3 class="mt-5">O maior <strong>estoque do Brasil</strong></h3>
                <p>O Grupo Incavel é composto por uma rede de lojas localizadas estrategicamente em todas as regiões do Brasil.Para melhor atender nossos clientes, contamos com mais de 150 colaboradores e um espaço físico de 10.000 m².</p>

                <div class="row mt-5 map-whatsapp d-flex align-items-center">
                    <div class="col d-flex align-items-center"><h4>Não encontrou o que procurava?</h4></div>
                    <div class="col d-flex align-items-center"><button><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/whatsapp.svg"> Entre em contato!</button></div>
                </div>
            </div>
        </div>
    </div>
    <!-- map -->

    <!-- blog -->
    <div class="container-fluid blog-title-container">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 d-flex align-items-center">
                    <h2>Blog <strong>Incavel</strong></h2>
                </div>
                <div class="col-md-4 col-sm-6 d-flex align-items-center">
                    <p>Fique por dentro de todas as<br>novidades sobre ônibus no Brasil e no mundo.</p>
                </div>
                <div class="col-md-4 col-sm-12 float-end d-flex align-items-center justify-content-end blog-button">
                    <a href="#" class="btn-branco">Ver todas as notícias</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container blog-posts-container">
        <div class="row">
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 4
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
                    ?>
                    <div class="col-md-6 mb-4">
                        <div class="blog-post">
                            <div class="col-md-4">
                                <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <div class="post-thumbnail" style="background: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>), lightgray 50%;"></div>
                                </a>
                                <?php endif; ?>
                            </div>
                            <div class="col">
                                <div class="post-date">
                                    <?php echo get_the_date('d, M Y'); ?>
                                </div>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_excerpt(), 9); ?></a></p>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo "No posts found.";
            endif;
            ?>
        </div>
    </div>

    <!-- blog -->


    <!--carrossel-->
        <script>
            $(document).ready(function(){
                $('.hero').owlCarousel({
                    items: 1, // Quantidade de itens por slide
                    loop: true, // Loop infinito
                    nav: false, // Desabilitar botões de navegação
                    dots: true, // Mostrar indicadores
                    dotsContainer: '.owl-dots-container', // Container dos indicadores
                });

                $('.marcas').owlCarousel({
                    items: 5, // Quantidade de itens por slide
                    margin:100,
                    loop: true, // Loop infinito
                    nav: false, // Mostrar botões de navegação
                    dots: false, // Desabilitar indicadores
                    smartSpeed: 1000,
                    autoplay:true,
                    autoplayTimeout:3000,
                    autoplayHoverPause:false,
                    responsive: {
                        0: {
                            items: 1 ,// Mostra 1 item em telas menores que 600px
                            margin:50,
                        },
                        600: {
                            items: 3, // Mostra 3 itens em telas de 600px ou maiores
                            margin:200,
                        },
                        1000: {
                            items: 5 // Mostra 5 itens em telas de 1000px ou maiores
                        }
                    }
                });

                $('.depoimentos').owlCarousel({
                    items: 1, // Quantidade de itens por slide
                    loop: true, // Loop infinito
                    nav: false, // Desabilitar botões de navegação
                    dots: true, // Mostrar indicadores
                    dotsContainer: '.owl-dots-container', // Container dos indicadores
                    smartSpeed: 1000,
                    autoplay:false,
                    autoplayTimeout:6000,
                    autoplayHoverPause:true
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



        </script>
    <!--animações-->


<?php
get_footer();

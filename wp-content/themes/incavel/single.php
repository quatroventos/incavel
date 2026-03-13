<?php
/**
 * The Template for displaying all single posts.
 */

get_header();
wp_reset_postdata();

$post_thumbnail_id = get_post_thumbnail_id();
$thumbnail_size = 'full'; // Tamanho da miniatura desejado (pode ser 'thumbnail', 'medium', 'large', ou personalizado)
$thumbnail_image = wp_get_attachment_image_src($post_thumbnail_id, $thumbnail_size);
$thumbnail_url = $thumbnail_image[0];

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?> >

    <!--    hero -->

        <div class="container-fluid blog-hero" style="background-image: url('<?php echo $thumbnail_url; ?>'); color:white;">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow1">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow2">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/white.svg" id="hero-arrow3">
            <div class="container">
                <div class="row">
                    <div class="col" >
                        <p class="post-meta text-center" style="max-width: 100%;"><?php echo get_the_date('j \d\e F, Y'); ?></p>
                        <h1 class="hero-title text-center" style="width: 100%;"><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>

    <!--    hero -->

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <?php the_content(); ?>
            </div>
        </div>
        <div class="row blog-share">
            <ul class="social">
                <li class="share-title">
                    Compartilhe esta notícia:
                </li>
                <li>
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" class="facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="21" viewBox="0 0 11 21" >
                            <path d="M10.168 11.75H7.23828V20.5H3.33203V11.75H0.128906V8.15625H3.33203V5.38281C3.33203 2.25781 5.20703 0.5 8.05859 0.5C9.42578 0.5 10.8711 0.773438 10.8711 0.773438V3.85938H9.26953C7.70703 3.85938 7.23828 4.79688 7.23828 5.8125V8.15625H10.7148L10.168 11.75Z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo $url; ?>" class="X">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
                    </a>
                </li>
                <li>
                    <a target="_blank" ref="https://www.linkedin.com/shareArticle?url=<?php echo $url; ?>" class="linkedin">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/></svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- blog -->
    <div class="container-fluid blog-title-container mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 d-flex align-items-center">
                    <h2>Leia <strong>Também</strong></h2>
                </div>
                <div class="col-4 d-flex align-items-center d-none d-md-block">
                    <p>Fique por dentro de todas as<br>novidades sobre ônibus no Brasil e no mundo.</p>
                </div>
                <div class="col-3 float-end d-flex align-items-center justify-content-end d-none d-md-block">
                    <a href="/blog" class="btn-branco">Ver todas as notícias</a>
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

</div>

<?php

get_footer();

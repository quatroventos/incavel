<?php
/**
 * Template Name: Blog Index
 * Description: The template for displaying the Blog index /blog.
 *
 */

get_header();
$page_id = get_option( 'page_for_posts' );
?>
<style>
	
	.pagination{
		justify-content: center;
		gap: 10px;
	}
	
	.pagination a{
		color:rgba(194, 49, 52, 1);
		
	}

</style>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?>>

    <!--    hero -->
        <div class="container-fluid hero blog-hero" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/img/blog-header.png');">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow1">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow2">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/white.svg" id="hero-arrow3">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1 class="hero-title">Blog da Incavel</h1>
                        <p class="hero-caption">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id varius metus. Ut at consequat tortor.
                        </p>
                    </div>
                </div>
            </div>
        </div>


    <div class="container mt-5">

            <?php

            function custom_excerpt_length($length) {
                return 10; // Defina o número desejado de palavras aqui
            }
            add_filter('excerpt_length', 'custom_excerpt_length');

            if ( have_posts() ) :
                ?>
                <div class="row">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        $post_thumbnail_id = get_post_thumbnail_id();
                        $thumbnail_size = 'full'; // Tamanho da miniatura desejado (pode ser 'thumbnail', 'medium', 'large', ou personalizado)
                        $thumbnail_image = wp_get_attachment_image_src($post_thumbnail_id, $thumbnail_size);
                        $thumbnail_url = $thumbnail_image[0];

                    ?>
                    <div class="col-md-6" style="padding:25px;">
                        <a href="<?php the_permalink(); ?>">
                            <div class="row post-item">
                                <div class="col-md-4">
                                    <img src="<?php echo $thumbnail_url; ?>">
                                </div>
                                <div class="col">
                                    <p class="post-meta"><?php echo get_the_date('j \d\e F, Y'); ?></p>
                                    <h2><?php the_title(); ?></h2>
                                    <p><?php the_excerpt(); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php
                    endwhile;
                    ?>
					
					<div class="pagination">
                <?php
                echo paginate_links(array(
                    'total' => $wp_query->max_num_pages
                ));
                ?>
            </div>
					
                </div>
            <?php
            endif;

            wp_reset_postdata();
            ?>

    </div>
</div>

<?php
get_footer();

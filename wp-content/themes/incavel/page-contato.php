<?php
/**
 * Template Name: Contato
 * Description: Página de contato
 *
 */
get_header();

if(have_posts()){
    while(have_posts()){
the_post();

    $localizacoes = wp_get_object_terms( get_the_ID() , 'localizacao' );
?>

    <div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?>>

    <!--    hero -->
    <?php if (!empty(get_field('cabecalho'))) { ?>

        <div class="container-fluid hero contact-hero" style="background-image: url('<?php the_field('cabecalho'); ?>');">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow1">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow2">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/white.svg" id="hero-arrow3">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1 class="hero-title"><?php the_title(); ?></h1>
                        <p class="hero-caption"><?php echo the_field('lead'); ?></p>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
    <!--    hero -->


    <!-- contato -->

    <?php
    $contato = get_field('contato');
    if( $contato ): ?>


            <div class="container container-contato" style="background:none; border:none; padding:0; margin-bottom:0;">
                <div class="row">
                    <div class="col">
                        <div class="contato-left">
                            <h3>Entre em contato</h3>

                            <br><hr><br>

                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="24" viewBox="0 0 23 24" fill="none"><path d="M19.5089 3.88839C21.6652 6.04464 23 8.8683 23 11.9487C23 18.2121 17.7634 23.346 11.4487 23.346C9.54911 23.346 7.70089 22.8326 6.0067 21.9598L0 23.5L1.59152 17.596C0.616071 15.9018 0.0513393 13.9509 0.0513393 11.8973C0.0513393 5.63393 5.18527 0.5 11.4487 0.5C14.529 0.5 17.404 1.73214 19.5089 3.88839ZM11.4487 21.3951C16.6853 21.3951 21.0491 17.1339 21.0491 11.9487C21.0491 9.3817 19.971 7.02009 18.1741 5.22321C16.3772 3.42634 14.0156 2.45089 11.5 2.45089C6.26339 2.45089 2.00223 6.71205 2.00223 11.8973C2.00223 13.6942 2.51562 15.4397 3.43973 16.9799L3.69643 17.3393L2.72098 20.8304L6.31473 19.8549L6.62277 20.0603C8.11161 20.933 9.75446 21.3951 11.4487 21.3951ZM16.6853 14.3103C16.942 14.4643 17.1473 14.5156 17.1987 14.6696C17.3013 14.7723 17.3013 15.3371 17.0446 16.0045C16.7879 16.6719 15.6585 17.2879 15.1451 17.3393C14.221 17.4933 13.5022 17.442 11.7054 16.6205C8.83036 15.3884 6.98214 12.5134 6.82812 12.3594C6.67411 12.154 5.69866 10.8192 5.69866 9.3817C5.69866 7.99554 6.41741 7.32812 6.67411 7.02009C6.9308 6.71205 7.23884 6.66071 7.4442 6.66071C7.59821 6.66071 7.80357 6.66071 7.95759 6.66071C8.16295 6.66071 8.3683 6.60938 8.625 7.17411C8.83036 7.73884 9.44643 9.125 9.49777 9.27902C9.54911 9.43304 9.60045 9.58705 9.49777 9.79241C8.98438 10.8705 8.3683 10.8192 8.67634 11.3326C9.8058 13.2321 10.8839 13.8996 12.5781 14.721C12.8348 14.875 12.9888 14.8237 13.1942 14.6696C13.3482 14.4643 13.9129 13.7969 14.067 13.5402C14.2723 13.2321 14.4777 13.2835 14.7344 13.3862C14.9911 13.4888 16.3772 14.1562 16.6853 14.3103Z" fill="white"/></svg>
                            <?php
                            $whatsapp = $contato['whatsapp'];
                            $search = array(' ','-');
                            echo $whatsapp;
                            ?>
                            <br><br>
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="24" viewBox="0 0 23 24" fill="none"><path d="M21.7762 15.3564C22.6761 15.7613 23.171 16.7512 22.946 17.696L22.0012 21.9253C21.7762 22.8701 20.9664 23.5 19.9765 23.5C8.95344 23.5 0 14.5466 0 3.52348C0 2.53365 0.62989 1.72379 1.57473 1.54382L5.80399 0.553993C6.74883 0.329032 7.73865 0.823946 8.14358 1.72379L10.0782 6.31299C10.4382 7.12285 10.2132 8.11268 9.53834 8.69758L7.69366 10.1823C8.99844 12.5219 10.9781 14.5016 13.3177 15.8063L14.8474 14.0067C15.3873 13.2868 16.3772 13.0618 17.187 13.3768L21.7762 15.3564ZM20.5614 21.6103L21.5513 17.3811C21.6412 17.0661 21.4613 16.7962 21.1913 16.6612L16.6471 14.7265C16.3772 14.6365 16.1072 14.6815 15.9272 14.9065L14.0826 17.1561C13.8576 17.4261 13.4977 17.516 13.2277 17.3361C10.1682 15.8513 7.64867 13.3318 6.16393 10.3173C5.98396 10.0023 6.07394 9.64241 6.3439 9.41745L8.5935 7.57277C8.81847 7.3928 8.86346 7.12285 8.77347 6.8529L6.83881 2.30869C6.70383 2.08373 6.47887 1.90376 6.25391 1.90376C6.20892 1.90376 6.16393 1.94875 6.11894 1.94875L1.88967 2.93858C1.61972 2.98357 1.43975 3.20853 1.43975 3.52348C1.43975 13.7367 9.7633 22.1052 19.9765 22.1052C20.2915 22.1052 20.5164 21.8803 20.5614 21.6103Z" fill="white"/></svg>
                            <?php echo $contato['telefone']; ?>
                            <br><br>
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="19" viewBox="0 0 23 19" fill="none"><path d="M0 3.75C0 2.17773 1.25781 0.875 2.875 0.875H20.125C21.6973 0.875 23 2.17773 23 3.75V15.25C23 16.8672 21.6973 18.125 20.125 18.125H2.875C1.25781 18.125 0 16.8672 0 15.25V3.75ZM1.4375 3.75V5.54688L10.1973 12.0156C10.9609 12.5547 11.9941 12.5547 12.7578 12.0156L21.5625 5.54688V3.75C21.5625 2.98633 20.8887 2.3125 20.125 2.3125H2.83008C2.06641 2.3125 1.39258 2.98633 1.39258 3.75H1.4375ZM1.4375 7.34375V15.25C1.4375 16.0586 2.06641 16.6875 2.875 16.6875H20.125C20.8887 16.6875 21.5625 16.0586 21.5625 15.25V7.34375L13.6113 13.1836C12.3535 14.082 10.6016 14.082 9.34375 13.1836L1.4375 7.34375Z" fill="white"/></svg>
                            <?php echo $contato['email']; ?>

                            <br><br><hr><br>

                            <div class="endereco"><?php echo $contato['endereco']; ?><br><br>
                            <?php echo $contato['horarios_de_atendimento']; ?>
                            </div>
                        </div>

                    </div>
                    <div class="col bg-white" style="padding:0;">
                        <form>
                            <div class="row">
                                <div class="col input-box">
                                    <label for="nome">NOME</label>
                                    <input type="text" class="form-control" name="nome" placeholder="Seu nome">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-box">
                                    <label for="email">E-MAIL</label>
                                    <input type="text" class="form-control" name="email" placeholder="email@email.com.br">
                                </div>
                                <div class="col input-box">
                                    <label for="telefone">TELEFONE</label>
                                    <input type="text" class="form-control" name="telefone" placeholder="(00) 9999-9999">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col input-box">
                                    <label for="mensagem">MENSAGEM</label>
                                    <textarea type="text" class="form-control" name="mensagem" rows="8" placeholder="Sua mensagem aqui"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <button>ENVIAR</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>


    <?php endif; ?>

    <!-- contato -->



    <!--carrossel-->
    <script>
        $(document).ready(function(){

            $('.marcas').owlCarousel({
                items: 5, // Quantidade de itens por slide
                margin:100,
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

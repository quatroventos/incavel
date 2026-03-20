<?php
get_header();

if(have_posts()){
    while(have_posts()){
the_post();

    $localizacoes = wp_get_object_terms( get_the_ID() , 'localizacao' );

$contato  = get_field('contato');
$logo_url = get_field('logo');
    $all_fields = get_fields();
    $candidate_keys = array();
    if ( is_array( $all_fields ) ) {
        foreach ( $all_fields as $acf_key => $acf_value ) {
            if (
                false !== strpos( (string) $acf_key, 'codigo' ) ||
                false !== strpos( (string) $acf_key, 'meta' ) ||
                false !== strpos( (string) $acf_key, 'tag' )
            ) {
                $candidate_keys[] = (string) $acf_key;
            }
        }
    }
    $search = array(' ','-', '(', ')');

$wamelink = 'https://wa.me/'.str_replace($search, '', $contato['whatsapp']);

// Salva dados da filial na sessão assim que o usuário entra na home da filial.
if ( ( ! empty( $logo_url ) || ! empty( $wamelink ) ) ) {
	if ( ! session_id() ) {
		session_start();
	}
	if ( ! empty( $logo_url ) ) {
		$_SESSION['filial_logo'] = esc_url_raw( $logo_url );
	}
	if ( ! empty( $wamelink ) ) {
		$_SESSION['filial_whatsapp'] = esc_url_raw( $wamelink );
	}

	// Salva também as tags/códigos personalizados da filial para páginas internas.
	$meta_tags = get_field( 'meta_tags' );
	$code_head = get_field( 'codigo_personalizado_head' );
	$code_body = get_field( 'codigo_personalizado_body' );

	if ( ! empty( $meta_tags ) ) {
		$_SESSION['filial_meta_tags'] = $meta_tags;
	}
	if ( ! empty( $code_head ) ) {
		$_SESSION['filial_codigo_personalizado_head'] = $code_head;
	}
	if ( ! empty( $code_body ) ) {
		$_SESSION['filial_codigo_personalizado_body'] = $code_body;
	}

	// #region agent log
	try {
		$logPath = '/Users/gabriel/VisualStudioProjects/incavel/incavel/.cursor/debug-c605db.log';
		$payload = array(
			'sessionId'   => 'c605db',
			'runId'       => 'run1',
			'hypothesisId'=> 'H_session_seed_representante',
			'location'    => 'single-representantes.php:session-seed',
			'message'     => 'Seeded filial session values from representante page',
			'timestamp'   => (int) round( microtime(true) * 1000 ),
			'data'        => array(
				'post_id'                => get_the_ID(),
				'host'                   => ( function_exists( 'incavel_get_current_public_host' ) ? incavel_get_current_public_host() : '' ),
				'logo_set'               => ( empty( $logo_url ) ? 0 : 1 ),
				'wamelink_set'           => ( empty( $wamelink ) ? 0 : 1 ),
				'meta_set'               => ( empty( $meta_tags ) ? 0 : 1 ),
				'code_head_set'          => ( empty( $code_head ) ? 0 : 1 ),
				'code_body_set'          => ( empty( $code_body ) ? 0 : 1 ),
			),
		);
		file_put_contents( $logPath, wp_json_encode( $payload ) . "\n", FILE_APPEND );
	} catch ( Exception $e ) {}
	// #endregion
}

    // Grava o WhatsApp desta revenda em um cookie, para ser reutilizado em páginas de produto
    // quando o acesso vier por domínio de filial.
    ?>
    <!-- #region agent log -->
    <?php echo '<!-- ACF_REP_DEBUG host=' . ( function_exists( 'incavel_get_current_public_host' ) ? incavel_get_current_public_host() : '' ) . ' logo=' . ( ! empty( $logo_url ) ? '1' : '0' ) . ' wa=' . ( ! empty( $wamelink ) ? '1' : '0' ) . ' meta=' . ( ! empty( $meta_tags ) ? '1' : '0' ) . ' head=' . ( ! empty( $code_head ) ? '1' : '0' ) . ' body=' . ( ! empty( $code_body ) ? '1' : '0' ) . ' sessionMeta=' . ( ! empty( $_SESSION['filial_meta_tags'] ) ? '1' : '0' ) . ' sessionHead=' . ( ! empty( $_SESSION['filial_codigo_personalizado_head'] ) ? '1' : '0' ) . ' sessionBody=' . ( ! empty( $_SESSION['filial_codigo_personalizado_body'] ) ? '1' : '0' ) . ' keys=' . esc_attr( wp_json_encode( $candidate_keys ) ) . ' -->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    <pre class="acf-debug-print" style="display:none;"><?php print_r( $all_fields ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_print_r,WordPress.Security.EscapeOutput.OutputNotEscaped ?></pre>
    <!-- #endregion -->
    <script>
        (function() {
            try {
                // #region agent log
                fetch('http://127.0.0.1:7676/ingest/500ab85a-d51d-4a87-9a4b-aec0b61c84fb',{method:'POST',headers:{'Content-Type':'application/json','X-Debug-Session-Id':'c605db'},body:JSON.stringify({sessionId:'c605db',runId:'run3',hypothesisId:'H_session_seed_representante',location:'single-representantes.php:browser-runtime',message:'Representante page runtime with ACF/session values',data:{host:window.location.hostname,metaSet:<?php echo ! empty( $meta_tags ) ? 'true' : 'false'; ?>,headSet:<?php echo ! empty( $code_head ) ? 'true' : 'false'; ?>,bodySet:<?php echo ! empty( $code_body ) ? 'true' : 'false'; ?>,sessionMetaSet:<?php echo ! empty( $_SESSION['filial_meta_tags'] ) ? 'true' : 'false'; ?>,sessionHeadSet:<?php echo ! empty( $_SESSION['filial_codigo_personalizado_head'] ) ? 'true' : 'false'; ?>,sessionBodySet:<?php echo ! empty( $_SESSION['filial_codigo_personalizado_body'] ) ? 'true' : 'false'; ?>},timestamp:Date.now()})}).catch(()=>{});
                // #endregion
                var host = window.location.hostname.replace(/^www\./, '');
                if (host !== 'incavel.com.br') {
                    var wamelink = <?php echo json_encode( $wamelink ); ?>;
                    if (wamelink) {
                        document.cookie = 'revenda_whatsapp=' + encodeURIComponent(wamelink) + '; path=/; max-age=' + (7*24*60*60);
                    }
                }
            } catch (e) {}
        })();
    </script>
    <?php
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?> class="page filial">

<!--    hero -->
    <?php if (!empty(get_field('cabecalho'))) { ?>

        <div class="container-fluid hero hero-representantes mt-0-custom" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.40) 0%, rgba(0, 0, 0, 0.40) 100%), url(<?php the_field('cabecalho'); ?>) no-repeat center / 100% 148.311%; background-color: lightgray; background-size: cover;">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow1">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/red.svg" id="hero-arrow2">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/white.svg" id="hero-arrow3">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-12">
                        <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php the_title(); ?>" class="filial-logo">
                    </div>
                    <div class="col-md-10 col-sm-12">
                        <h1 class="hero-title"><?php the_title(); ?></h1>
                        <p class="hero-caption"><?php echo $localizacoes[0]->name; ?></p>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
<!--    hero -->

<!--    descricao -->
    <div class="container-fluid container-descricao">
        <div class="container">
            <div class="row">
                <div class="col d-none d-md-block">
                    <h2>
                        <?php
                        function custom_display_title() {
                            // Get the original title
                            $title = get_the_title();

                            // Check if the title is not empty
                            if (!empty($title)) {
                                // Split the title into an array of words
                                $words = explode(' ', $title);

                                // Check if there are words in the array
                                if (count($words) > 0) {
                                    // Modify the first word (e.g., add <br> after it)
                                    $words[0] = $words[0] . '<br>';

                                    // Join the words back together with spaces
                                    $modified_title = implode(' ', $words);

                                    // Display the modified title
                                    echo $modified_title;
                                }
                            }
                        }
                        ?>
                        <?php custom_display_title(); ?>
                    </h2>
                </div>
                <div class="col">
                    <p><?php the_field('descricao'); ?></p>
                </div>
            </div>
        </div>
    </div>
<!--    descricao -->


    <!--    mapa -->
    <div class="container map-container">

        <div class="row">
            <div class="col-md-6 col-sm-12">
				<?php if($contato['whatsapp'] != ''){ ?>
                <a href="<?php echo $wamelink; ?>" target='_blank'>
                    <img class="map" src="<?php the_field('mapa')?>">
                </a>
				<?php } ?>
            </div>
            <div class="col-md-6 col-sm-12 map-text">

                <?php the_field('texto_mapa_1'); ?>
                <?php the_field('texto_mapa_2'); ?>

            </div>
        </div>
    </div>
    <!--    mapa -->

    <!--        Marcas  -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel marcas">
                    <?php
                    $marcas_parceiras = get_field('marcas'); // Obtém a galeria do ACF

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
				<h2 class="rotated-title" style="text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;">Produtos</h2>
			</div>
			<div class="col-md-11">
				<div class="row home-produtos">
					<?php
					// Pega os produtos do campo ACF relacional
					$produtos = get_field('produtos'); // Substitua 'produtos' pelo nome do seu campo ACF

					if ($produtos) :
						// Loop pelos produtos do ACF
						foreach ($produtos as $produto) :
							$thumbnail_url = get_the_post_thumbnail_url($produto->ID, 'thumbnail');
							// Usa URL relativa para manter sempre o domínio atual (proxy/mascarado).
							$produto_link  = wp_make_link_relative( get_permalink( $produto->ID ) );
							?>
							<div class="home-produto">
								<div class="home-produto-item" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');">
									<a href="<?php echo esc_url( $produto_link ); ?>">
										<div class="home-produto-overlay">
											<h3><?php echo get_the_title($produto->ID); ?></h3>
										</div>
									</a>
								</div>
							</div>
						<?php
						endforeach;

					else :
						// Fallback: Mostra todos os produtos via WP_Query
						$args = array(
							'post_type' => 'produto',
							'posts_per_page' => 10,
						);

						$query = new WP_Query($args);

						if ($query->have_posts()) :
							while ($query->have_posts()) : $query->the_post();
								$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
								// Usa URL relativa também no fallback.
								$fallback_link = wp_make_link_relative( get_permalink() );
								?>
								<div class="home-produto">
									<div class="home-produto-item" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');">
										<a href="<?php echo esc_url( $fallback_link ); ?>">
											<div class="home-produto-overlay">
												<h3><?php the_title(); ?></h3>
											</div>
										</a>
									</div>
								</div>
							<?php
							endwhile;
							wp_reset_postdata();
						else :
							echo '<p>Nenhum produto encontrado.</p>';
						endif;
					endif;
					?>
				</div>
			</div>
		</div>
	</div><!-- /.container -->
	<!--        Produtos  -->


    <!--    contato-->
        <div class="container-fluid primeiro-contato-container mt-5">
            <div class="container">
                <div class="row">
                    <div class="col ml-3">
                        <h2>Entre em contato com a<br><strong><?php the_title(); ?></strong></h2>
                    </div> <!-- col -->
					<?php if($contato['whatsapp'] != ''){ ?>
                    <div class="col d-flex justify-content-end">
                        <a href="<?php echo $wamelink; ?>" target="_blank" class="whatsapp">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/whatsapp.svg" height="30"> Entre em contato!
                        </a>
                    </div>
					<?php } ?>

                </div> <!-- row -->

                <div class="row galeria">

                    <?php
                    $images = get_field('galeria');
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


    <!-- blocks -->
        <?php if( get_field('bloco1') || get_field('bloco2') ): ?>
    <div class="container container-blocos">

        <!-- Bloco 1 -->
        <?php
        $bloco1 = get_field('bloco_1');
        if( $bloco1 ): ?>
            <div class="row">
                <div class="col texto">
                    <h2><?php echo $bloco1['titulo']; ?></h2>
                    <?php echo $bloco1['descricao']; ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/ghost-arrow-down.svg" id="blocos-arrow1">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/grey-arrow-down.svg" id="blocos-arrow2">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/grey-arrow-down.svg" id="blocos-arrow3">
                </div><!--col-->
                <div class="col imagem">
                    <img src="<?php echo $bloco1['imagem']; ?>">
                </div><!--col-->
            </div><!-- row-->
        <?php endif; ?>
        <!--  Bloco 1 -->

        <!-- Bloco 2 -->
        <?php
        $bloco2 = get_field('bloco_2');
        if( $bloco2 ): ?>
            <div class="row" style="margin-top:90px;">
                <div class="col imagem d-flex">
                    <img src="<?php echo $bloco2['imagem']; ?>">
                </div><!--col-->
                <div class="col texto">
                    <h2><?php echo $bloco2['titulo']; ?></h2>
                    <?php echo $bloco2['descricao']; ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/ghost-arrow-down.svg" id="blocos-arrow1">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/grey-arrow-down.svg" id="blocos-arrow2">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrows/grey-arrow-down.svg" id="blocos-arrow3">                </div><!--col-->

            </div><!-- row-->
        <?php endif; ?>
        <!--  Bloco 2 -->
    </div><!--container-->
    <!-- blocks -->

        <?php endif; ?>



    <!-- contato -->

    <?php
    $contato = get_field('contato');
    if( $contato ): ?>

        <div class="container-fluid container-contato">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3>Entre em contato</h3>

                        <br><hr><br>

                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="24" viewBox="0 0 23 24" fill="none"><path d="M19.5089 3.88839C21.6652 6.04464 23 8.8683 23 11.9487C23 18.2121 17.7634 23.346 11.4487 23.346C9.54911 23.346 7.70089 22.8326 6.0067 21.9598L0 23.5L1.59152 17.596C0.616071 15.9018 0.0513393 13.9509 0.0513393 11.8973C0.0513393 5.63393 5.18527 0.5 11.4487 0.5C14.529 0.5 17.404 1.73214 19.5089 3.88839ZM11.4487 21.3951C16.6853 21.3951 21.0491 17.1339 21.0491 11.9487C21.0491 9.3817 19.971 7.02009 18.1741 5.22321C16.3772 3.42634 14.0156 2.45089 11.5 2.45089C6.26339 2.45089 2.00223 6.71205 2.00223 11.8973C2.00223 13.6942 2.51562 15.4397 3.43973 16.9799L3.69643 17.3393L2.72098 20.8304L6.31473 19.8549L6.62277 20.0603C8.11161 20.933 9.75446 21.3951 11.4487 21.3951ZM16.6853 14.3103C16.942 14.4643 17.1473 14.5156 17.1987 14.6696C17.3013 14.7723 17.3013 15.3371 17.0446 16.0045C16.7879 16.6719 15.6585 17.2879 15.1451 17.3393C14.221 17.4933 13.5022 17.442 11.7054 16.6205C8.83036 15.3884 6.98214 12.5134 6.82812 12.3594C6.67411 12.154 5.69866 10.8192 5.69866 9.3817C5.69866 7.99554 6.41741 7.32812 6.67411 7.02009C6.9308 6.71205 7.23884 6.66071 7.4442 6.66071C7.59821 6.66071 7.80357 6.66071 7.95759 6.66071C8.16295 6.66071 8.3683 6.60938 8.625 7.17411C8.83036 7.73884 9.44643 9.125 9.49777 9.27902C9.54911 9.43304 9.60045 9.58705 9.49777 9.79241C8.98438 10.8705 8.3683 10.8192 8.67634 11.3326C9.8058 13.2321 10.8839 13.8996 12.5781 14.721C12.8348 14.875 12.9888 14.8237 13.1942 14.6696C13.3482 14.4643 13.9129 13.7969 14.067 13.5402C14.2723 13.2321 14.4777 13.2835 14.7344 13.3862C14.9911 13.4888 16.3772 14.1562 16.6853 14.3103Z" fill="white"/></svg>
					<?php if($contato['whatsapp'] != ''){ ?>
						<a href="<?php echo $wamelink; ?>" target="_blank" style="color:white;">
                            <?php echo $contato['whatsapp']; ?>
                        </a>
                        <br><br>
						<?php } ?>
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
                    <div class="col bg-white">

                        <p>Preencha o formulário abaixo e logo a <?php the_title(); ?> irá entrar em contato com você.</p>
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
                                    <textarea type="text" class="form-control" name="mensagem" rows="6" placeholder="Sua mensagem aqui"></textarea>
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
        </div>
				<?php if($contato['whatsapp'] != ''){ ?>
			<a href="<?php echo $wamelink;?>" target="_blank" class="botao-whatsapp-flutuante display-whatsapp-filial-domain">
			<?php } ?>
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
    </a>
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

<?php

/**
 * The template for displaying category pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 */

get_header();
// get the current taxonomy term
$term = get_queried_object();
// vars
$imagem = get_field('imagem_para_o_hero', $term);
$descricao = get_field('descricao', $term);
?>

    <div id="content" class="site-content category-page container-fluid mt-4">
        <div id="primary" class="content-area">

            <!-- Hook to add something nice -->
            <?php bs_after_primary(); ?>

            <main id="main" class="site-main">

                <div class="hero" style="background:url('<?php echo $imagem; ?>')">
                    <div class="hero--content">
                        <p class="hero--head">CATEGORIA</p>
                        <p class="hero--title"><?php single_cat_title('' , true ); ?></p>
                        <p class="hero--description"><?php echo $descricao; ?></p>
                    </div>
                </div>


                <div class="container post--list">

                    <!-- Sticky Post -->
                    <?php if (is_sticky()) : ?>
                    <div class="row">
                        <div class="col">
                            <h3 class="session--title">Em destaque</h3>
                            <?php
                            $args = array(
                                'posts_per_page' => 1,
                                'post__in'  => get_option('sticky_posts'),
                                'ignore_sticky_posts' => 1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'category',
                                        'field'    => 'slug',
                                        'terms'    => $term->slug,
                                    ),
                                )
                            );
                            $the_query = new WP_Query($args);
                            if ($the_query->have_posts()) :
                                while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                    <article class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <div class="card horizontal mb-4">
                                            <div class="row">
                                                <!-- Featured Image-->
                                                <?php if (has_post_thumbnail())
                                                    echo '<div class="card-img-left col-md-6">' . get_the_post_thumbnail(null, 'blog_featured') . '</div>';
                                                ?>
                                                <div class="col">
                                                    <div class="card-body">
                                                        <div class="row mb-2">
                                                            <div class="col-10">
                                                                <?php bootscore_category_badge(); ?>
                                                            </div>
                                                        </div>
                                                        <!-- Title -->
                                                        <h2 class="post--title">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h2>
                                                        <!-- Meta -->
                                                        <?php if ('post' === get_post_type()) : ?>
                                                            <small class="post--date">
                                                                Publicado em: <?php the_time('d/m/Y'); ?>
                                                            </small>
                                                        <?php endif; ?>
                                                        <!-- Excerpt -->
                                                        <div class="post--text">
                                                            <?php the_excerpt(); ?>
                                                        </div>
                                                        <hr>
                                                        <!-- Read more -->
                                                        <a class="post--read-more" href="<?php the_permalink(); ?>">Veja o post completo <i class="fas fa-external-link-alt"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                    </article>
                                <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                            </h3>
                            <!-- col -->
                        </div>
                        <!-- row -->
                        <?php endif; ?>
                    </div>

                    <!-- categories -->
                    <?php
                    $args = ['depth' => 1, 'hide_empty' => 0, 'echo' => 0, 'orderby' => 'id', 'order'=> 'asc'];
                    $cats = get_categories($args);
                    ?>
                    <div class="container category--list">
                        <div class="row">
                            <div class="col-md-1 category--title">CATEGORIAS:</div>
                            <div class="col-md-11 owl-carousel category--carousel">
                                <?php
                                //TODO: Ajustar layout de acordo
                                foreach($cats as $cat){
                                    if($cat->term_id != 1) { //esconde "sem categoria"
                                        echo "<div class='item'><a href='category/" . $cat->slug . "'>" . $cat->name . "</a></div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- categories -->

                    <div class="row main--news">
                        <!-- Post List -->
                        <div class="row post--list">
                            <div class="col col-md-12 col-xxl-12">
                                <h3 class="session--title">Principais notícias</h3>
                                <!-- Grid Layout -->
                                <?php
                                $args = array(
                                    'posts_per_page' => 3,
                                    'post__in'  => get_option('sticky_posts'),
                                    'ignore_sticky_posts' => 1,
                                    'offset' => 1,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'category',
                                            'field'    => 'slug',
                                            'terms'    => $term->slug,
                                        ),
                                    )
                                );
                                $the_query = new WP_Query($args);
                                if ($the_query->have_posts()) : ?>
                                <div class="row">
                                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                        <div class="post col-md-4 mb-4 ml-5">
                                            <!-- Featured Image-->
                                            <?php if (has_post_thumbnail())
                                                echo '<div class="col-lg-12">' . get_the_post_thumbnail(null, 'blog_featured') . '</div>';
                                            ?>
                                            <div class="col card card--shadow">
                                                <div class="card-body">
                                                    <div class="row mb-2">
                                                        <div class="col-10">
                                                            <?php bootscore_category_badge(); ?>
                                                        </div>
                                                    </div>
                                                    <!-- Title -->
                                                    <h2 class="post--title">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h2>
                                                    <!-- Meta -->
                                                    <?php if ('post' === get_post_type()) : ?>
                                                        <small class="post--date">
                                                            Publicado em: <?php the_time('d/m/Y'); ?>
                                                        </small>
                                                    <?php endif; ?>
                                                    <!-- Excerpt -->
                                                    <div class="post--text">
                                                        <?php the_excerpt(); ?>
                                                    </div>
                                                    <hr>
                                                    <!-- Read more -->
                                                    <a class="post--read-more" href="<?php the_permalink(); ?>">Veja o post completo <i class="fas fa-external-link-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                    <?php endif; ?>
                                    <?php wp_reset_postdata(); ?>
                                </div><!-- row -->
                            </div><!-- col -->
                        </div><!-- row -->
                    </div> <!--container-->
                </div> <!--post--list-->

                <!-- newsletter -->
                <div class="container-fluid newsletter">
                    <h2 class="newsletter--title">Inscreva-se em nossa newsletter</h2>
                    <p class="newsletter--text">E receba por e-mail nossos conteúdos exclusivos ✌️</p>
                    <form class="newsletter--form">
                        <div class="row">
                            <div class="col">
                                <label for="name">Nome<span class="asterisk">*</span></label>
                                <input type="text" class="form-control" placeholder="Digite seu nome aqui..." aria-label="Nome">
                            </div>
                            <div class="col">
                                <label for="email">E-mail<span class="asterisk">*</span></label>
                                <input type="email" class="form-control" placeholder="Digite seu e-mail aqui..." aria-label="E-mail">
                            </div>
                            <div class="col">
                                <label></label>
                                <input type="button" class="form-control btn btn--newsletter" value="Receba conteúdos">
                            </div>
                        </div>
                    </form>
                </div>

                <!-- latest news -->
                <div class="container latest--news">
                    <div class="row post--list">
                        <?php echo do_shortcode('[ajax_load_more post_type="post" posts_per_page="3" repeater="template_1" scroll="false" button_label="Carregar mais posts" transition_container_classes="row post--list" category="'.$term->slug.'"]'); ?>
                    </div><!--container-->
                </div>

            </main><!-- #main -->

        </div><!-- #primary -->
    </div><!-- #content -->
<?php
get_footer();

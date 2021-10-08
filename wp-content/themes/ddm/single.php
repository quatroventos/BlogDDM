<?php
/*
	 * Template Post Type: post
	 */

get_header();

// get the current taxonomy term
$category = get_the_category();
$category_name = $category[0]->cat_name;
$category_slug = $category[0]->slug;

//get author infos
$author_name = get_the_author_meta( 'display_name', $post->post_author );
$author_bio= get_the_author_meta( 'user_description', $post->post_author );
$author_avatar = get_avatar_url( get_the_author_meta('user_email') , 200 );

//estima o tempo de leitura
function readingtimeestimate(){
    $content = get_post_field('post_content');
    $char_count = mb_strlen(strip_tags($content), "UTF-8");

    $min = ceil($char_count / 1200); // tempo médio de leitura: 1200 caracteres

    $tempo = '';

    if ($min <= 10) {
        $tempo .= '0';
    }
    if ($min <= 1) {
        $tempo .= '1 min';
    }
    else {
        $tempo .= $min . ' mins';
    }

    return $tempo;
}
?>

    <div id="content" class="site-content single-post container-fluid mt-4">
        <div id="primary" class="content-area">

            <!-- Hook to add something nice -->
            <?php bs_after_primary(); ?>

            <main id="main" class="site-main">

                <div class="hero" style="background:url('<?php the_field('imagem_para_o_hero'); ?>')">
                    <div class="hero--content">
                        <div class="hero--category">
                            <div class="category-badge mb-2">
                                <a href="<?php echo get_site_url()."/category/".$category_slug; ?>" class="badge bg-secondary text-decoration-none <?php echo $category_slug; ?>"><?php echo $category_name; ?></a>
                            </div>
                        </div>
                        <h1 class="hero--title"><?php the_title(); ?></h1>
                        <p class="hero--description"><?php the_excerpt(); ?></p>
                        <div class="hero--author">
                            <div class="hero--author--avatar">
                                <img src="<?php echo $author_avatar; ?>" alt="<?php echo $author_name; ?>" >
                            </div>
                            <div class="hero--author--name">
                                <?php echo $author_name; ?>
                            </div>
                            <div class="hero--author--bio">
                                <?php echo $author_bio; ?>
                            </div>
                        </div>
                        <div class="hero--post--meta">
                            <p>Publicado em: <strong><?php the_time('d/m/Y'); ?></strong> | Leitura: <strong><?php echo readingtimeestimate(); ?></strong></p>
                        </div>
                    </div>
                </div>

                <!-- title and social -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 "><?php the_title(); ?></div>
                        <div class="col-md-6">
                            <ul>
                                <li>Compartilhe:</li>
                                <li><i class="fab fa-facebook-square"></i></li>
                                <li><i class="fab fa-twitter"></i></li>
                                <li><i class="fab fa-linkedin"></i></li>
                                <li><i class="fab fa-envelope"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Post -->
                <div class="container">
                    <div class="row post--list">

                        <div class="col-md-8 post--content">
                            <?php the_content(); ?>
                        </div><!-- col-md-8 -->

                        <div class="col-md-6">
                            <ul>
                                <li>Compartilhe nas redes:</li>
                                <li><i class="fab fa-facebook-square"></i> Facebook</li>
                                <li><i class="fab fa-twitter"></i> Twitter</li>
                                <li><i class="fab fa-linkedin"></i> Linkedin</li>
                                <li><i class="fab fa-envelope"></i> E-mail</li>
                            </ul>
                        </div>

                        <div class="col-md-3 offset-md-1 related--posts">
                            <h4 class="session--title">POSTS RELACIONADOS</h4>
                            <div class="row">

                                <?php

                                    $first_tag = $tags[0]->term_id;
                                    $args=array(
                                        'post__not_in' => array($post->ID),
                                        'posts_per_page'=>3,
                                        'caller_get_posts'=>1,
                                        'orderby' => 'rand',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'category',
                                                'field'    => 'slug',
                                                'terms'    => $category_slug,
                                            ),
                                        )
                                    );
                                    $my_query = new WP_Query($args);
                                    if( $my_query->have_posts() ) {
                                        while ($my_query->have_posts()) : $my_query->the_post(); ?>
                                            <div class="post col-md-12 mb-4">
                                                <!-- Featured Image-->
                                                <?php if (has_post_thumbnail())
                                                    echo '<div class="col-lg-12">' . get_the_post_thumbnail(null, 'blog_featured') . '</div>';
                                                ?>
                                                <div class="col card">
                                                    <div class="card-body">
                                                        <!-- Title -->
                                                        <h2 class="post--title">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        <?php
                                        endwhile;
                                    }
                                    wp_reset_query();

                                ?>
                            </div>

                            <!--sidebar-->
                            <?php get_sidebar('Sidebar'); ?>

                        </div><!-- row post--list -->
                    </div><!--container-->

            </main><!-- #main -->

        </div><!-- #primary -->
    </div><!-- #content -->

<?php get_footer(); ?>
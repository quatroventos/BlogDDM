<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 */

get_header();
?>
<div id="content" class="site-content container-fluid mt-4">
  <div id="primary" class="content-area">

    <!-- Hook to add something nice -->
    <?php bs_after_primary(); ?>

    <main id="main" class="site-main">

      <!-- Hero -->
        <?php
        $args = array(
        'post_type' => 'banner',
        'post_status' => 'publish',
        'posts_per_page' => -1
        );

        $loop = new WP_Query( $args );

        while ( $loop->have_posts() ) : $loop->the_post();
        ?>

            <div class="hero" style="background:url('<?php the_field('imagem_para_o_hero'); ?>')">
                <div class="hero--content">
                    <p class="hero--head"><?php the_field('head'); ?></p>
                    <p class="hero--title"><?php the_field('titulo'); ?></p>
                    <p class="hero--description"><?php the_field('descricao'); ?></p>
                </div>
            </div>


        <?
        endwhile;

        wp_reset_postdata();
        ?>

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

<div class="container post--list">

      <!-- Sticky Post -->
      <?php if (is_sticky() && is_home() && !is_paged()) : ?>
        <div class="row">
          <div class="col">
              <h3 class="session--title">Em destaque</h3>
            <?php
            $args = array(
              'posts_per_page' => 1,
              'post__in'  => get_option('sticky_posts'),
              'ignore_sticky_posts' => 1
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
                'offset' => 1
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


    <!-- most viewed categories -->
    <div class="container featured--categories">
        <div class="row">
                <h3 class="session--title">Categorias mais visitadas</h3>
                <?php
                    //TODO: Ver como pegar categorias mais visitadas, agora está puxando os com mais conteúdo
                    $args = ['depth' => 1, 'hide_empty' => 0, 'echo' => 0, 'orderby' => 'count', 'order'=> 'desc', 'number'=>5];
                    $cats = get_categories($args);
                ?>
                <?php foreach($cats as $cat){ ?>
                    <?php if($cat->term_id != 1) { //esconde "sem categoria" ?>
                        <div class="col-md-3 ml-2 text-center">
                            <a href="<?php echo $cat->slug; ?>" class="card">
                                <div class="card-body">
                                    <img src="<?php echo z_taxonomy_image_url($cat->term_id); ?>"/>
                                    <div class="card--title"><?php echo $cat->name; ?></div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
        </div> <!--row-->
    </div><!--container-->


    <!-- latest news -->
    <div class="container latest--news">
        <div class="row post--list">
            <div class="col-md-8">
                <h3 class="session--title">Últimas notícias</h3>
                <?php echo do_shortcode('[ajax_load_more post_type="post" posts_per_page="3" scroll="false" button_label="Carregar mais posts"]'); ?>
            </div><!-- col-md-8 -->

            <div class="col-md-3 offset-md-1 top--posts">
                <h4 class="session--title">Top posts</h4>
                <div class="row">

                    <?php
                    $args = array(
                        'meta_key' => 'post_views_count',
                        'orderby' => 'meta_value_num',
                        'posts_per_page' => 3
                    );
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) : ?>
                    <div class="row">
                        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
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
                        <?php endwhile; ?>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>

                </div>
            </div>

            <!--sidebar-->
            <?php get_sidebar('Sidebar'); ?>

        </div><!-- row post--list -->
    </div><!--container-->

    </main><!-- #main -->

  </div><!-- #primary -->
</div><!-- #content -->
<?php
get_footer();

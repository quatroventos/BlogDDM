<?php
/*
	 * Template Post Type: post
	 */

get_header();

// get the current taxonomy term
$category = get_the_category();
$category_name = $category[0]->cat_name;
$category_slug = $category[0]->slug;
?>

    <div id="content" class="site-content single-post container-fluid mt-4">
        <div id="primary" class="content-area">

            <!-- Hook to add something nice -->
            <?php bs_after_primary(); ?>

            <main id="main" class="site-main">


                <div class="hero" style="background:url('<?php the_field('imagem_para_o_hero'); ?>')">
                    <div class="hero--content">
                        <p class="hero--category">
                        <div class="category-badge mb-2"><a href="<?php echo get_site_url()."/category/".$category_slug; ?>" class="badge bg-secondary text-decoration-none <?php echo $category_slug; ?>"><?php echo $category_name; ?></a></div>
                        </p>
                        <h1 class="hero--title"><?php the_title(); ?></h1>
                        <p class="hero--description"><?php the_excerpt(); ?></p>
                    </div>
                </div>


                <!-- Post -->
                <div class="container latest--news">
                    <div class="row post--list">
                        <div class="col-md-8">
                            <?php the_content(); ?>
                        </div><!-- col-md-8 -->

                        <div class="col-md-3 offset-md-1 top--posts">
                            <h4 class="session--title">POSTS RELACIONADOS</h4>
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

<?php get_footer(); ?>
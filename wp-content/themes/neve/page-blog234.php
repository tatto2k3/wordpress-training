<?php

/**
 * Template Name: Blog Page
 */

get_header('blog');
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/page-blog.css" type="text/css" media="all">

<div class="blog-content">
    <div class="row pt-4">
        <div class="col-12 col-md-8">
            <nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
                <p>
                    <a href="/woredpress">Trang chủ</a>
                    <span class="separator"> » </span>
                    <span class="last">Blog</span>
                </p>
            </nav>
        </div> 
    </div>

    <div class="main-body-blog">
        <div class="main-post">
            <div class="img-main-post">
                <img src="" alt="">
            </div>
            <div class="title-img-main-post">
                <p class=""></p>
            </div>
        </div>
        <div class="other-post">

        </div>
    </div>

    <?php
    $args = array(
        'posts_per_page' => -1,
    );

    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
    ?>
            <div class="post-item">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-excerpt"><?php the_excerpt(); ?></div>
            </div>
    <?php
        endwhile;
    else :
        echo '<p>Không có bài viết nào.</p>';
    endif;

    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>
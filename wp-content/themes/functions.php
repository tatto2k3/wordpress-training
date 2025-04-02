<?php
// Mở đầu tệp functions.php
if ( ! function_exists( 'custom_blog_posts_shortcode' ) ) {
    // Đăng ký shortcode để hiển thị bài viết
    function custom_blog_posts_shortcode() {
        // Thiết lập các tham số cho WP_Query
        $args = array(
            'post_type'      => 'post',         
            'posts_per_page' => 5,             
            'orderby'        => 'date',        
            'order'          => 'DESC',        
        );

        // Tạo đối tượng WP_Query
        $query = new WP_Query( $args );
        $output = '';

        // Kiểm tra xem có bài viết nào không
        if ( $query->have_posts() ) :
            $output .= '<ul>';
            while ( $query->have_posts() ) : $query->the_post();
                $output .= '<li>';
                $output .= '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
                $output .= '<p>' . get_the_excerpt() . '</p>';
                $output .= '</li>';
            endwhile;
            $output .= '</ul>';
        else :
            $output .= '<p>Không có bài viết nào.</p>';
        endif;

        // Reset dữ liệu
        wp_reset_postdata();

        // Trả về output để hiển thị trong bài viết hoặc trang
        return $output;
    }

    // Đăng ký shortcode
    add_shortcode('blog_posts', 'custom_blog_posts_shortcode');
}
?>

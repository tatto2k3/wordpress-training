<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header id="header-blog">
        <div class="header-content">
            <div class="logo">
                <a href="<?php echo home_url(); ?>">
                    <img src="https://rentracks.com.vn/wp-content/uploads/2022/10/cropped-new_logo.png" alt="" />
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="/">GROUP COMPANIES</a></li>
                    <li><a href="/blog">BLOG</a></li>
                    <li><a href="/huong-dan-thiet-lap-tai-khoan-nha-phan-phoi-publisher/">HƯỚNG DẪN</a></li>
                    <li><a href="/">ADVERTISER</a></li>
                    <li><a href="/about">PUBLISHER</a></li>
                    <li><a href="/contact">VN</a></li>
                </ul>
            </nav>
        </div>
    </header>
</body>

</html>
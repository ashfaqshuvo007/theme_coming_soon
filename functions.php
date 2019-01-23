<?php

if (site_url() == "http://wpcomingsoon.local/") {
    define("VERSION", time());
} else {
    define("VERSION", wp_get_theme()->get("Version"));
}

//after theme setup support
function launcher_setup_theme()
{
    load_theme_textdomain("launcher");
    add_theme_support("post-thumbnails");
    add_theme_support("title-tag");
}

add_action("after_setup_theme", "launcher_setup_theme");

//scripts and stylesheets
function launcher_assets()
{
    if (is_page()) {
        $launcher_template_name = basename(get_page_template());
        if ($launcher_template_name == "launcher.php") {
            wp_enqueue_style("animate-css", get_theme_file_uri("/assets/css/animate.css"));
            wp_enqueue_style("icomoon-css", get_theme_file_uri("/assets/css/icomoon.css"));
            wp_enqueue_style("bootstrap-css", get_theme_file_uri("/assets/css/bootstrap.css"));
            wp_enqueue_style("style-css", get_theme_file_uri("/assets/css/style.css"));
            wp_enqueue_style("launcher", get_stylesheet_uri(), null, VERSION);

            wp_enqueue_script("easing-jquery-js", get_theme_file_uri("/assets/js/jquery.easing.1.3.js"), array("jquery"), null, true);
            wp_enqueue_script("bootstrap-jquery-js", get_theme_file_uri("/assets/js/bootstrap.min.js"), array("jquery"), null, true);
            wp_enqueue_script("waypoint-jquery-js", get_theme_file_uri("/assets/js/jquery.waypoints.min.js"), array("jquery"), null, true);
            wp_enqueue_script("countdown-jquery-js", get_theme_file_uri("/assets/js/simplyCountdown.js"), array("jquery"), null, true);
            wp_enqueue_script("main-jquery-js", get_theme_file_uri("/assets/js/main.js"), array("jquery"), VERSION, true);

            // Dynamic custom field for date
            $launcher_day = get_post_meta(get_the_ID(), "day", true);
            $launcher_month = get_post_meta(get_the_ID(), "month", true);
            $launcher_year = get_post_meta(get_the_ID(), "year", true);

            wp_localize_script("main-jquery-js", "custom_date", array(
                "year" => $launcher_year,
                "month" => $launcher_month,
                "day" => $launcher_day,
            ));
        } else {
            wp_enqueue_style("launcher", get_stylesheet_uri(), null, VERSION);
            wp_enqueue_style("bootstrap-css", get_theme_file_uri("/assets/css/bootstrap.css"));
        }
    }
}

add_action("wp_enqueue_scripts", "launcher_assets");

function launcher_widgets()
{
    /** Footer widget sidebar Area */
    register_sidebar(
        array(
            'name' => __('Footer left', 'launcher'),
            'id' => 'footer-left',
            'description' => __('widget for the left side footer', 'launcher'),
            'before_widget' => '<section id="%1s" class="widget %2s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name' => __('Footer right', 'launcher'),
            'id' => 'footer-right',
            'description' => __('widget for the right side footer', 'launcher'),
            'before_widget' => '<section id="%1s" class="text-right widget %2s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        )
    );
}
add_action("widgets_init", "launcher_widgets");

//Custom Style in WP Head
function launcher_styles()
{
    if (is_page()) {
        $thumbnail_url = get_the_post_thumbnail_url(null, "Large");
        //var_dump($thumbnail_url);?>
        <style>
            .home-side{
                background-image: url("<?php echo $thumbnail_url; ?>");
            }
            #fh5co-logo {
                margin-top: 350px;
            }
            #fh5co-logo a {
                font-size: 75px;
                color: #222 !important;
            }

        </style>
        <?php
    }
}
add_action("wp_head", "launcher_styles");

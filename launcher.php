<?php
/**
 * Template Name: Launcher Homepage
 */
?>
<?php
echo get_header();
the_post();

// Custom fields
$placeholder = get_post_meta(get_the_ID(), "placeholder-text", true);
$btn_label = get_post_meta(get_the_ID(), "button-label", true);
$hint = get_post_meta(get_the_ID(), "hint", true);
?>
	<body <?php body_class();?>>
        <div class="fh5co-loader"></div>
        <aside id="fh5co-aside" role="sidebar" class="text-center home-side">
            <h1 id="fh5co-logo">
                <a href="<?php echo site_url(); ?>">
                    <?php bloginfo("name");?>
                </a>
            </h1>
        </aside>

        <div id="fh5co-main-content">
                <div class="dt js-dt <?php post_class();?>">
                    <div class="dtc js-dtc">
                        <div class="simply-countdown-one animate-box" data-animate-effect="fadeInUp"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="fh5co-intro animate-box">
                                            <h2><?php the_title();?></h2>
                                            <?php the_content();?>
                                        </div>
                                    </div>

                                    <div class="col-lg-7 animate-box">
                                        <form action="#" id="fh5co-subscribe">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="<?php echo esc_attr($placeholder) ?>">
                                                <input type="submit" value="<?php echo esc_attr($btn_label) ?>" class="btn btn-primary">
                                                <p class="tip"><?php echo esc_attr($hint) ?></p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <div id="fh5co-footer">
                <div class="row">
                    <div class="col-md-6">
                        <?php
if (is_active_sidebar("footer-left")) {
    dynamic_sidebar("footer-left");
}
?>
                    </div>
                    <div class="col-md-6 fh5co-copyright">
                        <?php
if (is_active_sidebar("footer-right")) {
    dynamic_sidebar("footer-right");
}
?>
                    </div>
                </div>
            </div>

        </div>
<?php get_footer();?>


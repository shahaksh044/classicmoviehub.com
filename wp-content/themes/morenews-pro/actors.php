<?php
/* Template Name: Custom Page Template */
get_header(); // Include header.php
?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Your jQuery code goes here.
    });
</script>

<script type="text/javascript">
    var interval = 2; // seconds
    var numberImages = 9;
    var movie_folder = 'tyrone_power';
    var startImage = 1;
    var currentImage = startImage;

    function smoothup(slideShowContainer) {
        slideShowContainer.innerHTML = '';
    }

    function loadNext() {
        var slideShowContainer = document.getElementById("image_box");
        smoothup(slideShowContainer);
        slideShowContainer.innerHTML = '<img src="https://img-assets.classicmoviehub.com/images/thumbs' + movie_folder + '/' + currentImage + '.jpg" />';
        currentImage++;
        if (currentImage == numberImages + 1) currentImage = startImage;
        setTimeout(loadNext, interval * 1000);
    }
</script>

<body onload="loadNext()">
    <div id="container">
        <?php
        get_template_part('template-parts/logo'); // Replace _logo.php
        get_template_part('template-parts/header'); // Replace _header.php
        get_template_part('template-parts/navbar-one'); // Replace _navbar_one.php
        ?>

        <div id="main">
            <?php get_sidebar(); // Replace _left_col.php ?>
            <div id="main_area">
                <?php
                global $wpdb;
                $results = $wpdb->get_results("SELECT * FROM agatti_people WHERE gender = 1");
                foreach ($results as $person) {
                    echo '<p>' . esc_html($person->first_name) . ' ' . esc_html($person->last_name) . '</p>';
                }
                ?>
            </div>
            <?php get_sidebar('right'); // Replace _right_col.php ?>
            <div class="clear"></div>
        </div>
        <?php get_footer(); // Replace _footer.php ?>
    </div>
</body>

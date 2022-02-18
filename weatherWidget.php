//create the template for the page 
<?php

/**
 * Template Name: Weather Widget
 * 
 */

get_header();
?>

<section id="weatherWidget">
    <h2>'The weather in <the city we want></h2>
    <?php echo do_shortcode("[weatherWidget]"); ?>
</section>


<?php get_footer(); ?>

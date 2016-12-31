<?php
/**
 * The main template file.
 * @package dumplinghub-site_Theme
 */
get_header(); ?>
  <section class="front-content">
    <div class="title">
      <p class="small">
        <?php echo CFS()->get( 'small_text'); ?>
      </p>
      <h1 class="large">
        <?php echo CFS()->get( 'big_words'); ?> </h1>
    </div>
    <div class="front-description">
      <p>
        <?php echo CFS()->get( 'description'); ?>
      </p>
    </div>
    <div class= "front-button">
      <a href="#" class="button">Learn More</a>
      </div>
    <div class="front-image">
      <h2> image of electronic devices </h2>
    </div>
  </section>
  <!--footer-->
  <?php get_footer();?>
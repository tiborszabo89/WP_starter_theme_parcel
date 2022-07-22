<?php 
// Used for blog page
get_header(); ?>

<div class="container mt-5">
  <div class="row">
    <div class="col-12">
      <h1><?php single_post_title(); ?></h1>
    </div>
  </div>
</div>

<?php get_footer(); ?>
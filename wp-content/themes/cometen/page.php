<?php get_header(); ?>
<div class="fixed_page_title">
  <h1><?php the_title(); ?></h1>
</div>
<main>
  <article class="page">
    <section class="fixed_page">
      <div class="fixed_content">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

          <?php the_content(); ?>

      <?php endwhile;
      endif; ?>
      </div>
    </section>
  </article>
</main>

<?php get_footer(); ?>
<?php get_header(); ?>

<div class="fixed_page_title">
    <h1>NEWS</h1>
</div>

<main>
    <article class="single">
        <section class="single_container">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php
                $start_date = function_exists('get_field') ? get_field('start_date') : get_post_meta(get_the_ID(), 'start_date', true);
                $end_date   = function_exists('get_field') ? get_field('end_date')   : get_post_meta(get_the_ID(), 'end_date', true);

                $end_display = '';
                if (cometen_has_news_period($start_date, $end_date)) {
                    $end_display = (substr($start_date, 0, 4) === substr($end_date, 0, 4))
                        ? substr($end_date, 5)
                        : $end_date;
                }
                ?>
                <div class="single_title">
                    <?php if (cometen_has_news_period($start_date, $end_date)) : ?>
                        <time class="single_date" datetime="<?php echo esc_attr($start_date); ?>">
                            <?php echo esc_html($start_date); ?> - <?php echo esc_html($end_display); ?>
                        </time>
                    <?php else : ?>
                        <time class="single_date" datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
                            <?php echo esc_html(get_the_date('Y-m-d')); ?>
                        </time>
                    <?php endif; ?>
                    <h2 class="single_title"><?php the_title(); ?></h2>
                </div>

                <div class="single_content">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; endif; ?>

            <?php
            $posts_page_id = (int) get_option('page_for_posts');
            $news_url      = $posts_page_id ? get_permalink($posts_page_id) : home_url('/');
            ?>
            <div class="single_back">
                <a href="<?php echo esc_url($news_url); ?>">← NEWS一覧へ</a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">ホームへ →</a>
            </div>
        </section>
    </article>
</main>

<?php get_footer(); ?>

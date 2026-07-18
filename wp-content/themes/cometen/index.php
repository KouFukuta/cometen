<?php get_header(); ?>

<div class="fixed_page_title">
    <h1>
        <?php
        if (is_home()) {
            echo esc_html(get_the_title(get_option('page_for_posts')));
        } else {
            echo esc_html(wp_strip_all_tags(get_the_archive_title()));
        }
        ?>
    </h1>
</div>

<main>
    <article class="archive">
        <section class="archive_container">
            <div class="archive_content">
                <div class="news_content">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
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
                        <dl class="news_item">
                            <dt>
                                <?php if (cometen_has_news_period($start_date, $end_date)) : ?>
                                    <time datetime="<?php echo esc_attr($start_date); ?>">
                                        <?php echo esc_html($start_date); ?> - <?php echo esc_html($end_display); ?>
                                    </time>
                                <?php else : ?>
                                    <time datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>"><?php echo esc_html(get_the_date('Y-m-d')); ?></time>
                                <?php endif; ?>
                            </dt>
                            <dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
                        </dl>
                    <?php endwhile; ?>

                    <?php
                    global $wp_query;
                    $current_page = max(1, get_query_var('paged'));
                    $total_pages  = max(1, (int) $wp_query->max_num_pages);
                    ?>

                    <?php
                    $prev_link = get_previous_posts_link('&lt;');
                    $next_link = get_next_posts_link('&gt;', $total_pages);
                    ?>
            </div>

                    <!-- ページのナビゲーション -->
                    <div class="archive_pagination">
                        <?php echo $prev_link ?: '<span class="archive_pagination_arrow is-disabled">&lt;</span>'; ?>
                        <span class="archive_pagination_status">
                            <?php echo esc_html($current_page); ?> / <?php echo esc_html($total_pages); ?>
                        </span>
                        <?php echo $next_link ?: '<span class="archive_pagination_arrow is-disabled">&gt;</span>'; ?>
                    </div>

                <?php else : ?>
                    <p>投稿がありません。</p>
                <?php endif; ?>

                <div class="archive_back">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">← ホームへ</a>
                </div>
            </div>
        </section>
    </article>
</main>

<?php get_footer(); ?>

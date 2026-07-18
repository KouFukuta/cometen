<?php get_header(); ?>

<!-- ヒーローセクション -->
<div class="hero">
    <div class="hero_slide">
        <?php foreach ( cometen_get_hero_images() as $hero_image ) : ?>
            <img src="<?php echo esc_url( $hero_image ); ?>" alt="">
        <?php endforeach; ?>
    </div>

    <div class="hero_content">
        <div class="hero_logo">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/logo/cometen_logo.svg" alt="cometen_logo">
        </div>

        <div class="hero_catchcopy">
            <h1>米と</h1>
            <h1>米の</h1>
            <h1>まわりを</h1>
            <h1>伝える活動</h1>
        </div>
    </div>
</div>


<main>
    <!-- ニュース -->
    <section class="front_news fade-in">
    <div class="news_container">
        <div class="news_header">
            <h2>NEWS</h2>
        </div>

        <div class="news_content">
            <?php
            $news_query = new WP_Query([
                'post_type'            => 'post',
                'posts_per_page'       => 3,
                'ignore_sticky_posts' => true,
                'cometen_news_order'  => true,
            ]);

            if ($news_query->have_posts()) :
                while ($news_query->have_posts()) :
                    $news_query->the_post();
            ?>
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
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
            <div class="news_more">
                <a class="news" href="<?php echo esc_url( get_permalink( get_page_by_path('news') ) ); ?>">more...</a>
            </div>

        </div>
    </div>
</section>

<!-- 店舗詳細 -->
<section class="description fade-in">
    <div class="description_container">
        <div class="description_header">
            <h2>米と米のまわりを伝える活動。</h2>
        </div>

        <div class="description_content">
            <div class="description_text--ja">
                <p>日本はぜんぶ米どころ。cometenは米の周りを紹介する米屋です。私たちは日本の大切な風土文化をはぐくむお米を、人やもの、土地のストーリーと一緒に届けていきます。</p>
            </div>

            <div class="description_text--en">
                <p>Japan as a whole iss a rice-producing country.We suppry not only the rice that is nurtured by
                    Japan's important climate and culture, but also stories of the people, things and land that
                    surround it.</p>
            </div>
        </div>
    </div>
</section>

<!-- cometenについて -->
 <section class="about fade-in">
    <div class="about_container">
        <div class="about_header">
            <h2>cometen 国立米店</h2>
        </div>

        <div class="about_body">
            <div class="description_text--ja">
                <p>東京・国立市にある、米と米の周りのライフスタイルを伝えるお店。お米のギフトや量り売り、ご飯を美味しく味わう食や道具、土鍋で炊けるごはんの様子を見ながら味わうことのできるキッチンと、お米の産地やテーマを設けたポップアップや企画行う大きなテーブルのある店内で、「お米がもっと美味しくなる」体験を伝えます。</p>
            </div>
            <div class="description_text--en">
                <p>This shop in Kunitachi City, Tokyo, convays a lifestyle around rice and rice.The shop conveys
                    the experience of "rice made more delicious" with rice gifts and rice sold by weights, food
                    and tools for tasting rice, a kitchen where you can watch and teste rice begin cooked in
                    clay pots, and a large table for pop-ups and projects with rice production areas and themes.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 店舗詳細 -->
 <section class="shopinfo fade-in">
    <div class="shopinfo_container">
        <div class="shopinfo_content">
            <span class="shopinfo_businessday">OPEN 10:00-18:00</span>
            <span class="shopinfo_businessday">月曜日 10:00-16:00</span>

            <ul>
                <li>公式SNSから営業カレンダーをご確認ください。</li>
                <li>産地への取材や仕入れのため臨時休業となる場合があります。ご了承ください。</li>
            </ul>

            <span class="shopinfo_address">所在地 東京都国立市西2-10-5</span>

            <h3 class="shopinfo_access">access</h3>
            <p>JR中央線国立駅から徒歩12分</p>
            <p>12-minute walk from Kunitachi Station on the JR Chuo Line.</p>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>

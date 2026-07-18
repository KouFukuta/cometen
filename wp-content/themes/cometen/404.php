<?php get_header(); ?>

<div class="fixed_page_title">
    <h1>404　NotFound</h1>
</div>

<main>
    <article class="notfound">
        <section>
            <div class="notfound_container">
                <p>お探しのページは見つかりませんでした。</p>
                <p>The page you requested could not be found.</p>
            </div>

            <div class="notfound_back">
                <a href="<?php echo esc_url(home_url('/')); ?>">← ホームへ</a>
            </div>

        </section>
    </article>

</main>

<style>
    .notfound {
        text-align: center;
    }

    .notfound_back {
        margin-top: 50px;
    }
</style>

<?php get_footer(); ?>
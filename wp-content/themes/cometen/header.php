<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!-- adobefonts -->
    <script>
        (function (d) {
            var config = {
                kitId: 'pcj4hha',
                scriptTimeout: 3000,
                async: true
            },
                h = d.documentElement, t = setTimeout(function () { h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive"; }, config.scriptTimeout), tk = d.createElement("script"), f = false, s = d.getElementsByTagName("script")[0], a; h.className += " wf-loading"; tk.src = 'https://use.typekit.net/' + config.kitId + '.js'; tk.async = true; tk.onload = tk.onreadystatechange = function () { a = this.readyState; if (f || a && a != "complete" && a != "loaded") return; f = true; clearTimeout(t); try { Typekit.load(config) } catch (e) { } }; s.parentNode.insertBefore(tk, s)
        })(document);
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <nav class="nav_overlay">
        <ul class="nav_list">
            <li class="nav_item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">HOME</a></li>
            <li class="nav_item"><a href="<?php echo esc_url( home_url( '/news' ) ); ?>">NEWS</a></li>
            <li class="nav_item"><a href="<?php echo esc_url( home_url( '/company' ) ); ?>">COMPANY</a></li>
            <li class="nav_item"><a href="https://cometen.stores.jp/">ONLINE SHOP</a></li>
            <li class="nav_item"><a href="https://www.instagram.com/cometen88/">Instagram</a></li>
            <li class="nav_item"><a href="https://www.facebook.com/cometen88/">Facebook</a></li>
            <li class="nav_item"><a href="https://note.com/cometen/">note</a></li>
            <li class="nav_item"><a href="https://x.com/cometen88/">X</a></li>
        </ul>
    </nav>

    <header>
        <div class="header_accessory_clip">
            <img class="header_accessory" src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/hero/cometen_band.svg" alt="cometen_band">
        </div>
        <div class="header_inner"></div>
    </header>

    <button class="menu_button">
        <span class="menu_button_line"></span>
        <span class="menu_button_line"></span>
        <span class="menu_button_line"></span>
    </button>

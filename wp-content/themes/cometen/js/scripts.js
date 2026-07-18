
// ページロード完了でフェードイン
window.addEventListener('load', () => {
    document.body.classList.add('is-loaded');
});

// ヘッダーのアクセサリーの色を変更する
const header = document.querySelector('header');
const hero = document.querySelector('.hero');
const headerAccessory = document.querySelector('.header_accessory');
const headerAccessoryClip = document.querySelector('.header_accessory_clip');

const observer = new IntersectionObserver(([entry]) => {
    header.classList.toggle('scrolled', !entry.isIntersecting);
}, { threshold: 0 });

if (hero) observer.observe(hero);

// スクロールでheader_accessoryを縮小、ハンバーガーを上に移動、一定で止める
const ACCESSORY_MAX = 150;  // 初期の高さ(px)
const ACCESSORY_MIN = 75;  // 最小の高さ(px)
const BUTTON_TOP_MAX = 175; // ボタンの初期top(px)
const BUTTON_TOP_MIN = 100;  // ボタンの最小top(px)
const SCROLL_RANGE   = 300; // 何pxスクロールで最小になるか

const menuButton = document.querySelector('.menu_button');
const navOverlay = document.querySelector('.nav_overlay');

menuButton.addEventListener('click', () => {
    menuButton.classList.toggle('is-open');
    navOverlay.classList.toggle('is-open');
});

window.addEventListener('scroll', () => {
    const progress = Math.min(window.scrollY / SCROLL_RANGE, 1);
    const height = ACCESSORY_MAX - (ACCESSORY_MAX - ACCESSORY_MIN) * progress;
    const buttonTop = BUTTON_TOP_MAX - (BUTTON_TOP_MAX - BUTTON_TOP_MIN) * progress;
    headerAccessoryClip.style.height = `${height}px`;
    menuButton.style.top = `${buttonTop}px`;
}, { passive: true });

// セクションが画面に入ったらふわっと表示
const fadeTargets = document.querySelectorAll('.fade-in');
const fadeObserver = new IntersectionObserver((entries, obs) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            obs.unobserve(entry.target);
        }
    });
}, { threshold: 0.15 });

fadeTargets.forEach((el) => fadeObserver.observe(el));

// hero_slide 内の画像のみ取得
const images = document.querySelectorAll('.hero_slide img');
let currentIndex = 0;

function slideImages() {
    images[currentIndex].classList.remove('active');
    currentIndex = (currentIndex + 1) % images.length;
    images[currentIndex].classList.add('active');
}

// 最初の画像を表示
images[0].classList.add('active');

setInterval(slideImages, 5000);

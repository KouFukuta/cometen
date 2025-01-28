$(document).ready(function () {
  var scroll;
  var winH = $(window).height();
  var objTop = $(".scrollObj").offset().top; // クラス名を指定

  $(window).on("scroll", function () {
    // イベント名を scroll に修正
    scroll = $(window).scrollTop();

    if (scroll >= objTop - winH / 2) {
      $(".scrollObj").addClass("scrollShow"); // addClass に修正
    } else {
      $(".scrollObj").removeClass("scrollShow"); // removeClass の確認
    }
  });
});

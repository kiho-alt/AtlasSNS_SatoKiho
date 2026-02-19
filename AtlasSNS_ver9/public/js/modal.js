$(function () {
  // 編集モーダル
  $(document).on('click', '.js-modal-open', function () {
    $('.js-modal').fadeIn();
    // 規約：スネークケースの変数名
    var $post_val = $(this).attr('post');
    var $post_id = $(this).attr('post_id');

    // HTML側のクラス名修正に合わせる
    $('.modal_post').val($post_val);
    $('.modal_id').val($post_id);
    return false;
  });

  // 削除モーダル
  $(document).on('click', '.js-modal-delete-open', function () {
    $('.js-modal-delete').fadeIn();
    var $delete_url = $(this).attr('href');
    // JS依存クラス btn-real-delete は維持
    $('.btn-real-delete').attr('href', $delete_url);
    return false;
  });

  // 閉じる (modal_bg や js-modal-close)
  $(document).on('click', '.js-modal-close', function () {
    $('.js-modal').fadeOut();
    $('.js-modal-delete').fadeOut();
    return false;
  });
});

// ヘッダーのドロップダウンメニュー
$(function () {
  // ユーザー情報部分をクリックしたら
  $('.js-menu-open').on('click', function () {
    // 修正：スネークケースのクラス名を指定
    $('.nav_menu').slideToggle(200);
    // 修正：スネークケースのクラス名を指定
    $('.nav_arrow').toggleClass('is_active');
  });
});

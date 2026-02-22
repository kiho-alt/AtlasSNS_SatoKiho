function showEditModal() {
  $('.js-modal').show();
}

$(function () {
  // 編集モーダル
  $(document).on('click', '.js-modal-open', function () {
    $('.js-modal .error_message_area').hide();

    $('.js-modal').fadeIn();
    var $post_val = $(this).attr('post');
    var $post_id = $(this).attr('post_id');

    $('.modal_post').val($post_val);
    $('.modal_id').val($post_id);
    return false;
  });

  // 削除モーダル
  $(document).on('click', '.js-modal-delete-open', function () {
    $('.js-modal-delete').fadeIn();
    var $delete_url = $(this).attr('href');
    $('.btn-real-delete').attr('href', $delete_url);
    return false;
  });

  // 閉じる
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
    $('.nav_menu').slideToggle(200);
    $('.nav_arrow').toggleClass('is_active');
  });
});

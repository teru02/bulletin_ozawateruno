$(function () {
  var favorite = $('.js-favorite-toggle');
  var favoritePostId;

  favorite.on('click', function () {
    var $this = $(this);
    favoritePostId = $this.data('postid');
    $.ajax({
      headers: {//Laravelでajaxを利用するためにはCSRFトークンを設定する必要がある
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/ajaxfavorite',  //routeの記述
      type: 'POST', //受け取り方法の記述（GETもある）
      data: {
        'post_id': favoritePostId //コントローラーに渡すパラメーター
      },
    })

      // Ajaxリクエストが成功した場合
      .done(function (data) {
        //lovedクラスを追加
        $this.toggleClass('loved');

        //.favoritesCountの次の要素のhtmlを「data.postFavoritesCount」の値に書き換える
        $this.next('.favoritesCount').html(data.postFavoritesCount);

      })
      // Ajaxリクエストが失敗した場合
      .fail(function (data, xhr, err) {
        //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
        //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
        console.log('エラー');
        console.log(err);
        console.log(xhr);
      });

    return false;
  });
});

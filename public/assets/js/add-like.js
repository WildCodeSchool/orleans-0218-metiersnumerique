$(document).on('click', '.like', function (e) {
    e.preventDefault();
    let commentId = $(this).attr('data-commentId');
    const likeBtn = $(this);
    $.post('/like', {commentId: commentId}).done(function (nbLike) {
        likeBtn.next().html(nbLike);
    });
});
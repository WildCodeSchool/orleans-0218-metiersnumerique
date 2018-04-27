$(document).on('click', '.like', function (e) {
    e.preventDefault();
    let commentId = $(this).attr('data-commentId');
    let commentJobId = $(this).attr('data-commentJobId');
    const likeBtn = $(this);
    $.post('/like', {commentId: commentId, commentJobId: commentJobId}).done(function (nbLike) {
        likeBtn.next().html(nbLike);
    });
});
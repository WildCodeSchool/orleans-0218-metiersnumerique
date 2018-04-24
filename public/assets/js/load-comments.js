$('#voirPlus').click(function () {
    let nbComments = $('.one-comment').length;
    let jobId = $('#comments').attr('data-jobId');
    console.log(nbComments);
    $.post('/job/load-comment', {jobId: jobId, offset: nbComments}).done(function (comments) {
        $('#row-comments').append(comments);
    });
});
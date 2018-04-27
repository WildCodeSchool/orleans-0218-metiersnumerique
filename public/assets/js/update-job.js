
//affichage de la miniature sur sélection de la photo
$('#thumbnail').change(function (e) {
    let f = e.target.files[0];
    let reader = new FileReader();
    reader.onload = (function (file) {
        return function (e) {
            let img = $('#imgthumbnail');
            img.attr('src', reader.result);
        }
    })(f);
    reader.readAsDataURL(f);
});

//affichage de la miniature sur sélection de la photo
$('#image').change(function (e) {
    let f = e.target.files[0];
    let reader = new FileReader();
    reader.onload = (function (file) {
        return function (e) {
            let img = $('#imgimage');
            img.attr('src', reader.result);
        }
    })(f);
    reader.readAsDataURL(f);
});

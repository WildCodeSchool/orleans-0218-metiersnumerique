
//affichage de la miniature sur sélection de la photo
$('#avatar').change(function (e) {
    let f = e.target.files[0];
    let reader = new FileReader();
    reader.onload = (function (file) {
        return function (e) {
            let img = $('#photo');
            img.attr('src', reader.result);
        }
    })(f);
    reader.readAsDataURL(f);
});
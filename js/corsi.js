$(document).ready(function () {
    const popup = $('#popup');
    const closeBtn = $('.close');

    $('.clickable').each(function () {
        $(this).on('click', function () {
            const data = JSON.parse($(this).attr('data-istruttore'));
            $('#istruttoreNome').text(`${data.nome} ${data.cognome}`);
            $('#istruttoreFoto').attr('src', $(this).attr('src'));
            $('#istruttoreEmail').text(`Email: ${data.email}`);
            $('#istruttoreCellulare').text(`Cellulare: ${data.cellulare}`);
            popup.show();
        });
    });

    closeBtn.on('click', function () {
        popup.hide();
    });

    $(window).on('click', function (event) {
        if (event.target == popup[0]) {
            popup.hide();
        }
    });
});

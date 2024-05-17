function toggleNewTipologia() {
    var select = $('#tipologia');
    var newTipologiaInput = $('#newTipologiaInput');
    if (select.val() === 'new') {
        newTipologiaInput.show();
    } else {
        newTipologiaInput.hide();
        $('#newTipologia').val('');
    }
}

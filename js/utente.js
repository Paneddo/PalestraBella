$('#tipo').on('change', (e) => {
    let istruttore = e.target.value === 'istruttore';
    $('#img-upload').attr('type', istruttore ? 'file' : 'hidden');
});

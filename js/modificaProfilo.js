const editButton = $('#editButton');
const saveButton = $('#saveButton');
const cancelButton = $('#cancelButton');

var nome;
var cognome;
var email;

const inputs = $('input[type=text], input[type=radio]');

editButton.on('click', () => {
    nome = $('#nome').val();
    cognome = $('#cognome').val();
    email = $('#email').val();

    inputs.removeAttr('disabled');
    saveButton.show();
    cancelButton.show();
    editButton.hide();
});

cancelButton.on('click', () => {
    $('#nome').valnome;
    $('#cognome').val(cognome);
    $('#email').val(email);

    inputs.attr('disabled', true);
    saveButton.hide();
    cancelButton.hide();
    editButton.show();
});

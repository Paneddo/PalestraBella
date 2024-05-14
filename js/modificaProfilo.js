var editButton = document.getElementById('editButton');
var saveButton = document.getElementById('saveButton');
var cancelButton = document.getElementById('cancelButton');

var inputs = document.querySelectorAll(
    'input[type=text], input[type=email], input[type=checkbox]'
);

editButton.addEventListener('click', function () {
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].removeAttribute('disabled');
    }
    saveButton.style.display = 'inline';
    cancelButton.style.display = 'inline';
    editButton.style.display = 'none';
});

cancelButton.addEventListener('click', function () {
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].setAttribute('disabled', true);
    }
    saveButton.style.display = 'none';
    cancelButton.style.display = 'none';
    editButton.style.display = 'inline';
});

saveButton.addEventListener('click', function () {
    var formData = new FormData();
    for (var i = 0; i < inputs.length; i++) {
        formData.append(inputs[i].id, inputs[i].value);
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'aggiornaProfilo.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                // Update success message or handle response
                console.log(xhr.responseText);
            } else {
                // Handle error
                console.error('Error:', xhr.status);
            }
        }
    };
    xhr.send(formData);
});

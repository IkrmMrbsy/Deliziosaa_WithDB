var submitButton = document.querySelector('.submit-btn');

submitButton.addEventListener('click', function () {
    var input = document.querySelector('input');
    var textArea = document.querySelector('textarea');

    console.log(textArea);

    if (input.required) {
        input.classList.add('is-invalid');
    }
    if (textArea.required) {
        textArea.classList.add('is-invalid');
    }
});
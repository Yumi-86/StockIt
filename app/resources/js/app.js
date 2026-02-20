require('./bootstrap');
require('bootstrap');

window.addEventListener('loaded', function () {
    const buttons = document.querySelectorAll('.js-confirm');

    buttons.forEach(button => {
        button.addEventListener('click', function (e) {
            const message = this.dataset.message;

            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });

    const putImage = document.getElementById('putImage');
    const previewImage = document.getElementById('previewImage');
    const removeBtn = document.getElementById('removeImageBtn');

    putImage.addEventListener('change', function (e) {
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
    
            reader.onload = function (event) {
                previewImage.src = event.target.result;
                previewImage.classList.remove('d-none');
                removeBtn.classList.remove('d-none');
            }
        };
        reader.readAsDataURL(file);
    });
    
    removeBtn.addEventListener('click', function () {
        putImage.value = '';
        previewImage.src = '';
        previewImage.classList.add('d-none');
        removeBtn.classList.add('d-none');
    });
});
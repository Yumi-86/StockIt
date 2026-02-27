require('./bootstrap');
require('bootstrap');

window.addEventListener('load', function () {
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

    if (putImage && previewImage && removeBtn) {

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
    }


    const product = document.getElementById('product_id');
    const quantity = document.getElementById('quantity');
    const totalWeight = document.getElementById('total-weight');

    if (product && quantity && totalWeight) {
        function calculateTotal() {
            const selectedOption = product.options[product.selectedIndex];
            const weight = selectedOption ?
                selectedOption.dataset.weight : 0;
            const qty = quantity.value || 0;

            totalWeight.textContent = weight * qty;
        }

        quantity.addEventListener('input', calculateTotal);
        product.addEventListener('change', calculateTotal);
    }

    const IssueQuantity = document.getElementById('issue_quantity');
    const stockAfter = document.getElementById('stock_after_value');

    if (IssueQuantity && stockAfter) {

        IssueQuantity.addEventListener('input', function (e) {
            const before = parseInt(IssueQuantity.dataset.issue, 10);
            const issue = parseInt(e.target.value, 10) || 0;
            const after = before - issue;
            const warning = document.getElementById('issue_warning');
            const danger = document.getElementById('issue_danger')

            if (e.target.value !== '') {
                stockAfter.textContent = after;

                if (before > issue) {
                    warning.classList.add('d-none');
                    stockAfter.classList.remove('text-danger');
                    danger.classList.add('d-none');
                } else if (before == issue) {
                    stockAfter.classList.remove('text-danger');
                    danger.classList.add('d-none');
                    warning.classList.remove('d-none');
                } else if (before < issue) {
                    warning.classList.add('d-none');
                    stockAfter.classList.add('text-danger');
                    danger.classList.remove('d-none');
                }
            }
        });
    }

    document.querySelectorAll('.js-product-detail').forEach(button => {
        button.addEventListener('click', async function () {
            
            const productId = this.dataset.productId;

            const response = await fetch(`/products/${productId}`);
            const data = await response.json();

            document.getElementById('modal-code').textContent = data.display_product_code;
            document.getElementById('modal-name').textContent = data.name;
            document.getElementById('modal-category').textContent = data.category.name;
            document.getElementById('modal-weight').textContent = data.weight;
            document.getElementById('modal-img').src = data.image_url;

            $('#productModal').modal('show');
        });
    });
});
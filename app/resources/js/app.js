require('./bootstrap');
require('bootstrap');

window.addEventListener('DOMContentLoaded', function () {
    
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.js-confirm');

        if (!btn) return;

        const message = btn.dataset.message || '本当に実行しますか？';

        if (!confirm(message)) {
            e.preventDefault();
        }
    });

    const putImage = document.getElementById('putImage');
    const previewImage = document.getElementById('previewImage');
    const removeBtn = document.getElementById('removeImageBtn');
    const noImageText = document.getElementById('noImageText');

    if (putImage && previewImage && removeBtn) {

        putImage.addEventListener('change', function (e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                
                reader.onload = function (event) {
                    console.log(event.target.result);
                    previewImage.src = event.target.result;
                    previewImage.classList.remove('d-none');
                    removeBtn.classList.remove('d-none');
                    noImageText.classList.add('d-none')

                }
                reader.readAsDataURL(file);
            };
        });

        removeBtn.addEventListener('click', function () {
            putImage.value = '';
            previewImage.src = '';
            previewImage.classList.add('d-none');
            removeBtn.classList.add('d-none');
            noImageText.classList.remove('d-none');
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

        calculateTotal();
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
            const submitBtn = document.getElementById('submitBtn');

            if (e.target.value !== '') {
                stockAfter.textContent = after;

                if (before > issue) {
                    warning.classList.add('d-none');
                    stockAfter.classList.remove('text-danger');
                    danger.classList.add('d-none');
                    submitBtn.disabled = false;
                } else if (before == issue) {
                    stockAfter.classList.remove('text-danger');
                    danger.classList.add('d-none');
                    warning.classList.remove('d-none');
                    submitBtn.disabled = false;
                } else if (before < issue) {
                    warning.classList.add('d-none');
                    stockAfter.classList.add('text-danger');
                    danger.classList.remove('d-none');
                    submitBtn.disabled = true;
                }
            }
        });
    }

    document.addEventListener('click', async function (e) {
        const button = e.target.closest('.js-product-detail');

        if (!button) return;

        const productId = button.dataset.productId;
        const modalImg = document.getElementById('modal-img');
        const editLink = document.getElementById('editLink');

        const response = await fetch(`/products/${productId}`);
        const data = await response.json();

        document.getElementById('modal-code').textContent = data.display_product_code;
        document.getElementById('modal-name').textContent = data.name;
        document.getElementById('modal-category').textContent = data.category.name;
        document.getElementById('modal-weight').textContent = data.weight;
        modalImg.src = data.image_url ?? window.noImageUrl;

        if (editLink) {
            editLink.href = `/products/${productId}/edit`;
        }

        $('#productModal').modal('show');
    });

    let page = 1;
    let loading = false;

    async function handleScroll() {
        if (loading) return;

        if (window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 200) {

            loading = true;
            page++;

            const loadingEl = document.getElementById('loading');
            loadingEl.classList.remove('d-none');
            loadingEl.classList.add('d-block');

            const params = new URLSearchParams(window.location.search);
            params.set('page', page);

            const response = await fetch(`?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const html = await response.text();

            if (html.trim() === '') {
                window.removeEventListener('scroll', handleScroll);
                loadingEl.classList.add('d-none');
                loadingEl.classList.remove('d-block');
                document.getElementById('endOfList').classList.remove('d-none');
                return;
            }

            const list = document.getElementById('list');

            if (list) {
                list.insertAdjacentHTML('beforeend', html);
            }

            loadingEl.classList.add('d-none');
            loading = false;
        }
    }
    window.addEventListener('scroll', handleScroll);

    const scrollBtn = document.getElementById('scrollTopBtn');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 300) {
            scrollBtn.style.display = 'flex';
        } else {
            scrollBtn.style.display = 'none';
        }
    });

    scrollBtn.addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth',
        });
    });

});
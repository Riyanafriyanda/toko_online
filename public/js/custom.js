document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.item-check');
    const qtyInputs = document.querySelectorAll('.qty-input');
    const totalEl = document.getElementById('total');

    function formatRupiah(number) {
        return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function hitungTotal() {
        let total = 0;
        checkboxes.forEach((checkbox, idx) => {
            if (checkbox.checked) {
                const qtyInput = qtyInputs[idx];
                const harga = parseInt(qtyInput.getAttribute('data-harga')) || 0;
                const qty = parseInt(qtyInput.value) || 0;
                total += harga * qty;
            }
        });
        totalEl.textContent = formatRupiah(total);
    }

    // Checkbox & qty input listener
    checkboxes.forEach(cb => cb.addEventListener('change', hitungTotal));
    qtyInputs.forEach(qty => qty.addEventListener('input', hitungTotal));

    // Tombol plus dan minus
    document.querySelectorAll('.plus-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const qtyInput = this.closest('.keranjang-item').querySelector('.qty-input');
            let currentQty = parseInt(qtyInput.value) || 1;
            if (currentQty < 9999) {
                qtyInput.value = currentQty + 1;
                hitungTotal();
            }
        });
    });

    document.querySelectorAll('.minus-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const qtyInput = this.closest('.keranjang-item').querySelector('.qty-input');
            let currentQty = parseInt(qtyInput.value) || 1;
            if (currentQty > 1) {
                qtyInput.value = currentQty - 1;
                hitungTotal();
            }
        });
    });

    // Hapus item
    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const itemDiv = this.closest('.keranjang-item');
            const itemId = itemDiv.getAttribute('data-id');

            fetch(`/cart/remove/${itemId}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        "Content-Type": "application/json"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        itemDiv.remove();

                        const cartCountEl = document.getElementById('cart-count');
                        if (data.totalQty > 0) {
                            if (cartCountEl) {
                                cartCountEl.textContent = data.totalQty;
                                cartCountEl.classList.remove('hidden');
                            }
                        } else {
                            if (cartCountEl) cartCountEl.remove();
                        }

                        hitungTotal();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: data.message
                        });
                    }
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menghapus produk.'
                    });
                });
            });
         });
    hitungTotal();
});
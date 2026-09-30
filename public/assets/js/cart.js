/* Cart page: AJAX quantity update and remove, DOM totals update */
(function () {
  // CSRF token for Laravel
  var csrfEl = document.querySelector('meta[name="csrf-token"]');
  var CSRF_TOKEN = csrfEl ? csrfEl.getAttribute('content') : '';
  function showNotify(message, type) {
    if (typeof Swal !== 'undefined') {
      var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 2000, timerProgressBar: true });
      Toast.fire({ icon: type === 'error' ? 'error' : 'success', title: message || '' });
      return;
    }
    // no-op fallback
  }

  function formatMoney(val) {
    return '$' + Number(val).toFixed(2);
  }

  function updateTotals(cartTotal) {
    var totalEl = document.querySelector('.cart-total');
    if (totalEl) { totalEl.textContent = 'Total: ' + formatMoney(cartTotal); }
  }

  function bindQtyForms() {
    var forms = document.querySelectorAll('.qty-form');
    Array.prototype.forEach.call(forms, function (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        var productId = form.querySelector('input[name="product_id"]').value;
        var qtyInput = form.querySelector('input[name="qty"]');
        var qtyVal = parseInt(qtyInput.value || '1', 10);
        var url = form.getAttribute('action');
        var fd = new FormData();
        fd.set('product_id', productId);
        fd.set('qty', String(qtyVal));
        fetch(url, { method: 'POST', headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN, 'X-Requested-With': 'XMLHttpRequest' }, body: fd })
          .then(function (r) { return r.json(); })
          .then(function (data) {
            if (data && data.success) {
              showNotify('Cart updated');
              // update item subtotal
              var itemEl = form.closest('.cart-item');
              if (itemEl) {
                var subtotalEl = itemEl.querySelector('.item-subtotal');
                if (subtotalEl) subtotalEl.textContent = formatMoney(data.item_subtotal);
              }
              updateTotals(data.cart_total);
            } else { showNotify('Failed to update cart', 'error'); }
          }).catch(function () { showNotify('Network error', 'error'); });
      });
    });
  }

  function bindRemoveForms() {
    var forms = document.querySelectorAll('form[action*="/cart/remove"]');
    Array.prototype.forEach.call(forms, function (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        var productId = form.querySelector('input[name="product_id"]').value;
        var url = form.getAttribute('action');
        var fd = new FormData();
        fd.set('product_id', productId);
        fetch(url, { method: 'POST', headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN, 'X-Requested-With': 'XMLHttpRequest' }, body: fd })
          .then(function (r) { return r.json(); })
          .then(function (data) {
            if (data && data.success) {
              showNotify('Item removed');
              var itemEl = form.closest('.cart-item');
              if (itemEl) { itemEl.parentNode.removeChild(itemEl); }
              updateTotals(data.cart_total);
            } else { showNotify('Failed to remove item', 'error'); }
          }).catch(function () { showNotify('Network error', 'error'); });
      });
    });
  }

  function init() { bindQtyForms(); bindRemoveForms(); }
  if (document.readyState === 'loading') { document.addEventListener('DOMContentLoaded', init); } else { init(); }
})();
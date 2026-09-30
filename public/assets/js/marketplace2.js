/* Marketplace interactions: add-to-cart via AJAX, apparel modal, notifications */
(function () {
  var modal = document.getElementById('apparel-modal');
  var notify = document.getElementById('notify');
  var modalClose = modal ? modal.querySelector('.modal-close') : null;
  var modalCancel = modal ? modal.querySelector('.modal-cancel') : null;
  var apparelForm = document.getElementById('apparel-form');
  var placementsSelect = document.getElementById('apparel-placements');
  var sizeEl = document.getElementById('apparel-size');
  var colorEl = document.getElementById('apparel-color');
  var colorOtherGroup = document.getElementById('color-other-group');
  var colorOtherEl = document.getElementById('apparel-color-other');
  var colorSwatch = document.getElementById('color-swatch');
  var cartBarEl = document.getElementById('cart-cta-bar');
  var filterPills = document.querySelectorAll('.filter-pill');

  // CSRF token for Laravel
  var csrfEl = document.querySelector('meta[name="csrf-token"]');
  var CSRF_TOKEN = csrfEl ? csrfEl.getAttribute('content') : '';

  var pendingActionUrl = null;
  var pendingProductId = null;
  var pendingQty = 1;
  var pendingSelectSize = false;
  var pendingSelectColor = false;
  var pendingSelectPlacement = false;
  var pendingAllowDesignUpload = false;

  function showModal() {
    if (!modal) return;
    modal.setAttribute('aria-hidden', 'false');
    modal.classList.add('open');
  }
  function hideModal() {
    if (!modal || !apparelForm) return;
    modal.setAttribute('aria-hidden', 'true');
    modal.classList.remove('open');
    apparelForm.reset();
    if (placementsSelect) {
      // clear selections
      Array.prototype.forEach.call(placementsSelect.options, function (opt) { opt.selected = false; });
    }
    // Reset visibility of all groups
    ['group-select-size', 'group-select-color', 'group-select-placement', 'design-upload-group'].forEach(function(id) {
        var el = document.getElementById(id);
        if (el) el.style.display = 'none';
    });
    
    pendingActionUrl = null;
    pendingProductId = null;
    pendingQty = 1;
    pendingSelectSize = false;
    pendingSelectColor = false;
    pendingSelectPlacement = false;
    pendingAllowDesignUpload = false;
  }
  function showNotify(message, type) {
    // Use SweetAlert toast if available
    if (typeof Swal !== 'undefined') {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true
      });
      Toast.fire({ icon: type === 'error' ? 'error' : 'success', title: message || '' });
      return;
    }
    if (!notify) return;
    notify.textContent = message || '';
    notify.className = 'notify ' + (type === 'error' ? 'notify-error' : 'notify-success');
    notify.style.display = 'block';
    setTimeout(function () { notify.style.display = 'none'; }, 2500);
  }

  function toggleCartBar(cartCount) {
    if (!cartBarEl) return;
    var count = typeof cartCount === 'number' ? cartCount : null;
    if (count === null) {
      // Fallback: infer from DOM quantities
      var total = 0;
      var counts = document.querySelectorAll('.qty-count');
      Array.prototype.forEach.call(counts, function (el) {
        var v = parseInt(el.getAttribute('data-qty') || el.textContent || '0', 10);
        if (!isNaN(v)) total += v;
      });
      count = total;
    }
    cartBarEl.style.display = count > 0 ? 'flex' : 'none';
  }

  function handleAddClick(card) {
    var productId = card ? card.getAttribute('data-product-id') : null;
    
    // Read new granular customization attributes
    var selectSizeAttr = card ? card.getAttribute('data-select-size') : '0';
    var selectColorAttr = card ? card.getAttribute('data-select-color') : '0';
    var selectPlacementAttr = card ? card.getAttribute('data-select-design-placement') : '0';
    var uploadDesignAttr = card ? card.getAttribute('data-upload-design') : '0';

    var needSize = (selectSizeAttr === '1');
    var needColor = (selectColorAttr === '1');
    var needPlacement = (selectPlacementAttr === '1');
    var allowDesignUpload = (uploadDesignAttr === '1') || (uploadDesignAttr && typeof uploadDesignAttr === 'string' && uploadDesignAttr.toLowerCase() === 'true');

    var actions = card ? card.querySelector('.product-actions') : null;
    var addUrl = actions ? actions.getAttribute('data-add-url') : '';

    // Check if any customization is needed
    if (productId && (needSize || needColor || needPlacement || allowDesignUpload)) {
      pendingActionUrl = addUrl;
      pendingProductId = productId;
      pendingQty = 1;
      
      pendingSelectSize = needSize;
      pendingSelectColor = needColor;
      pendingSelectPlacement = needPlacement;
      pendingAllowDesignUpload = allowDesignUpload;

      // Update visibility of form groups in modal
      var sizeGroup = document.getElementById('group-select-size');
      if (sizeGroup) sizeGroup.style.display = needSize ? 'block' : 'none';

      var colorGroup = document.getElementById('group-select-color');
      if (colorGroup) colorGroup.style.display = needColor ? 'block' : 'none';

      var placementGroup = document.getElementById('group-select-placement');
      if (placementGroup) placementGroup.style.display = needPlacement ? 'block' : 'none';

      var uploadGroup = document.getElementById('design-upload-group');
      if (uploadGroup) uploadGroup.style.display = allowDesignUpload ? 'block' : 'none';

      // Clear file input if not allowed
      var fileInput = document.getElementById('apparel-design');
      if (!allowDesignUpload && fileInput) {
        try { fileInput.value = ''; } catch (e) {}
      }
      
      showModal();
      return;
    }
    var fd = new FormData();
    fd.set('product_id', productId || '');
    fd.set('qty', '1');
    fetch(addUrl, { method: 'POST', headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN, 'X-Requested-With': 'XMLHttpRequest' }, body: fd })
      .then(function (r) { return r.json(); })
      .then(function (data) {
        if (data && data.success) {
          showNotify('Added to cart');
          setCardQty(card, data.item.qty);
          toggleCartBar(data.cart_count);
        } else { showNotify('Failed to add to cart', 'error'); }
      }).catch(function () { showNotify('Network error', 'error'); });
  }

  function handleMinusClick(card) {
    var productId = card ? card.getAttribute('data-product-id') : null;
    var actions = card ? card.querySelector('.product-actions') : null;
    var updateUrl = actions ? actions.getAttribute('data-update-url') : '';
    var removeUrl = actions ? actions.getAttribute('data-remove-url') : '';
    var currentQty = getCardQty(card);
    var newQty = currentQty - 1;
    if (newQty <= 0) {
      var fdRemove = new FormData();
      fdRemove.set('product_id', productId || '');
      fetch(removeUrl, { method: 'POST', headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN, 'X-Requested-With': 'XMLHttpRequest' }, body: fdRemove })
        .then(function (r) { return r.json(); })
        .then(function (data) {
          if (data && data.success) {
            showNotify('Item removed');
            setCardQty(card, 0);
            toggleCartBar(data.cart_count);
          } else { showNotify('Failed to remove item', 'error'); }
        }).catch(function () { showNotify('Network error', 'error'); });
      return;
    }
    var fd = new FormData();
    fd.set('product_id', productId || '');
    fd.set('qty', String(newQty));
    fetch(updateUrl, { method: 'POST', headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN, 'X-Requested-With': 'XMLHttpRequest' }, body: fd })
      .then(function (r) { return r.json(); })
      .then(function (data) {
        if (data && data.success) {
          showNotify('Cart updated');
          setCardQty(card, newQty);
          toggleCartBar(data.cart_count);
        } else { showNotify('Failed to update cart', 'error'); }
      }).catch(function () { showNotify('Network error', 'error'); });
  }

  function handlePlusClick(card) {
    var productId = card ? card.getAttribute('data-product-id') : null;
    var actions = card ? card.querySelector('.product-actions') : null;
    var updateUrl = actions ? actions.getAttribute('data-update-url') : '';
    var currentQty = getCardQty(card);
    var newQty = currentQty + 1;
    var fd = new FormData();
    fd.set('product_id', productId || '');
    fd.set('qty', String(newQty));
    fetch(updateUrl, { method: 'POST', headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN, 'X-Requested-With': 'XMLHttpRequest' }, body: fd })
      .then(function (r) { return r.json(); })
      .then(function (data) {
        if (data && data.success) {
          showNotify('Cart updated');
          setCardQty(card, newQty);
        } else { showNotify('Failed to update cart', 'error'); }
      }).catch(function () { showNotify('Network error', 'error'); });
  }

  function getCardQty(card) {
    var countEl = card ? card.querySelector('.qty-count') : null;
    var val = countEl ? parseInt(countEl.getAttribute('data-qty') || countEl.textContent || '0', 10) : 0;
    return isNaN(val) ? 0 : val;
  }
  function setCardQty(card, qty) {
    var addEl = card ? card.querySelector('.action-add') : null;
    var controlsEl = card ? card.querySelector('.qty-controls') : null;
    var countEl = card ? card.querySelector('.qty-count') : null;
    if (!addEl || !controlsEl || !countEl) return;
    if (qty && qty > 0) {
      addEl.style.display = 'none';
      controlsEl.style.display = 'flex';
      countEl.setAttribute('data-qty', String(qty));
      countEl.textContent = String(qty);
    } else {
      addEl.style.display = 'flex';
      controlsEl.style.display = 'none';
      countEl.setAttribute('data-qty', '0');
      countEl.textContent = '0';
    }
  }

  function bindActions() {
    var cards = document.querySelectorAll('.product-card');
    Array.prototype.forEach.call(cards, function (card) {
      var addBtn = card.querySelector('.btn-add');
      var minusBtn = card.querySelector('.btn-minus');
      var plusBtn = card.querySelector('.btn-plus');
      if (addBtn) addBtn.addEventListener('click', function () { handleAddClick(card); });
      if (minusBtn) minusBtn.addEventListener('click', function () { handleMinusClick(card); });
      if (plusBtn) plusBtn.addEventListener('click', function () { handlePlusClick(card); });
    });
  }

  function applyFilter(filter) {
    var cards = document.querySelectorAll('.product-card');
    Array.prototype.forEach.call(cards, function (card) {
      var cat = (card.getAttribute('data-category') || '').toLowerCase();
      var visible = (filter === 'all') || (cat === filter);
      card.style.display = visible ? '' : 'none';
    });
  }

  function bindFilters() {
    if (!filterPills || filterPills.length === 0) return;
    Array.prototype.forEach.call(filterPills, function (pill) {
      pill.addEventListener('click', function () {
        var selected = pill.getAttribute('data-filter') || 'all';
        Array.prototype.forEach.call(filterPills, function (p) {
          p.classList.remove('active');
          p.setAttribute('aria-selected', 'false');
        });
        pill.classList.add('active');
        pill.setAttribute('aria-selected', 'true');
        applyFilter(selected);
      });
    });
    // Ensure default filter is applied
    applyFilter('all');
  }

  function bindModal() {
    if (modalClose) modalClose.addEventListener('click', hideModal);
    if (modalCancel) modalCancel.addEventListener('click', hideModal);

    if (apparelForm) {
      apparelForm.addEventListener('submit', function (e) {
        e.preventDefault();
        if (!pendingActionUrl || !pendingProductId) { hideModal(); return; }
        
        var selectedPlacements = [];
        var rawColor = colorEl && colorEl.value ? colorEl.value : '';
        var colorVal = rawColor;
        if (rawColor === 'other') {
          colorVal = colorOtherEl && colorOtherEl.value ? colorOtherEl.value.trim() : '';
        }
        var sizeVal = sizeEl && sizeEl.value ? sizeEl.value : '';

        // Validation based on enabled fields
        if (pendingSelectColor && !colorVal) {
          showNotify('Please select a color', 'error');
          return;
        }
        if (pendingSelectSize && !sizeVal) {
          showNotify('Please select a size', 'error');
          return;
        }
        if (pendingSelectPlacement && placementsSelect) {
          Array.prototype.forEach.call(placementsSelect.selectedOptions, function (opt) {
            selectedPlacements.push(opt.value);
          });
          if (selectedPlacements.length === 0) {
            showNotify('Please select at least one placement', 'error');
            return;
          }
        }

        var fd = new FormData();
        fd.set('product_id', pendingProductId);
        fd.set('qty', String(pendingQty));
        
        // Add fields to FormData if enabled
        if (pendingSelectColor) {
           fd.set('color', colorVal);
        }
        if (pendingSelectSize && sizeVal) {
           fd.set('size', sizeVal);
        }
        if (pendingSelectPlacement) {
           selectedPlacements.forEach(function (p) { fd.append('placements[]', p); });
        }

        var fileInput = document.getElementById('apparel-design');
        var backInput = document.getElementById('apparel-back-design');
        if (fileInput && fileInput.files && fileInput.files[0]) {
          fd.set('design_file', fileInput.files[0]);
        }
        if (backInput && backInput.files && backInput.files[0]) {
          fd.set('back_design', backInput.files[0]);
        }

        fetch(pendingActionUrl || '', {
          method: 'POST',
          headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN, 'X-Requested-With': 'XMLHttpRequest' },
          body: fd
        }).then(function (r) { return r.json(); }).then(function (data) {
          if (data && data.success) {
            showNotify('Added to cart with customization');
            var card = document.querySelector('.product-card[data-product-id="' + pendingProductId + '"]');
            if (card) { setCardQty(card, data.item && data.item.qty ? data.item.qty : pendingQty); }
            toggleCartBar(data.cart_count);
          } else {
            showNotify('Failed to add to cart', 'error');
          }
          hideModal();
        }).catch(function () {
          showNotify('Network error', 'error');
          hideModal();
        });
      });
    }
  }

  // Update color swatch to reflect selected color
  function updateColorSwatch() {
    if (!colorEl || !colorSwatch) return;
    var map = { black: '#000000', white: '#ffffff', red: '#ef4444', blue: '#3b82f6', green: '#22c55e' };
    var val = colorEl.value || '';
    if (colorOtherGroup) {
      colorOtherGroup.style.display = (val === 'other') ? 'block' : 'none';
      if (val !== 'other' && colorOtherEl) {
        try { colorOtherEl.value = ''; } catch (e) {}
      }
    }
    var hex = map[val] || '#e5e7eb';
    colorSwatch.style.backgroundColor = hex;
    colorSwatch.style.borderColor = (val === 'white' ? '#cbd5e1' : hex);
  }

  function init() {
    bindActions();
    bindModal();
    bindFilters();
    bindImageThumbnails();
    if (colorEl) {
      colorEl.addEventListener('change', updateColorSwatch);
      updateColorSwatch();
    }
    // Ensure initial bar state matches DOM/cart
    toggleCartBar(null);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  function bindImageThumbnails() {
    var cards = document.querySelectorAll('.product-card');
    Array.prototype.forEach.call(cards, function (card) {
      var mainImg = card.querySelector('.product-image-main img');
      var thumbs = card.querySelectorAll('.product-thumbnail');
      if (!mainImg || !thumbs.length) {
        return;
      }
      Array.prototype.forEach.call(thumbs, function (thumb) {
        thumb.addEventListener('click', function () {
          var src = thumb.getAttribute('data-src');
          if (src) {
            mainImg.src = src;
          }
          Array.prototype.forEach.call(thumbs, function (t) {
            t.classList.remove('is-active');
          });
          thumb.classList.add('is-active');
        });
      });
    });
  }
})();

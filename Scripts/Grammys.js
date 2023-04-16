// Auto Change Value Total

$(document).ready(function(){
  $('.quantity').on('change', function() {
    // Get the new quantity value
    var newQty = $(this).val();
    
    // Get the price and calculate the new subtotal
    var price = $(this).parent().find('.price').text().replace('$', '');
    var newSubtotal = price * newQty;
    
    // Update the subtotal for the current item
    $(this).parent().parent().find('.sub-total').text('$' + newSubtotal + '.00');
    
    // Calculate the new total
    var total = 0;
    $('.sub-total').each(function() {
      var subTotal = $(this).text().replace('$', '').replace('.00', '');
      total += parseFloat(subTotal);
    });
    
    // Update the total
    $('#total').find('strong').text('$' + total + '.00');
  });
});


// Search function and others

const searchInput = document.getElementById('search-input');
const searchIcon = document.getElementById('search-icon');

searchInput.addEventListener('input', () => {
  if (searchInput.value) {
    searchIcon.style.display = 'none';
  } else {
    searchIcon.style.display = 'block';
  }
});

function toggleChecker() {
  const toggle = document.querySelector('#toggle');
  const searchContainer = document.querySelector('.search-container');
  const loginOrCart = document.querySelector('.login-or-cart');
  const navBar = document.querySelector('.navbar');
  const padding = '10px 15px 40px 15px';
  const originalPadding = '10px 15px 70px 15px';

  if (window.innerWidth <= 767 && toggle) {
    if (toggle.checked) {
      searchContainer.style.display = 'none';
      loginOrCart.style.display = 'none';
      navBar.style.padding = padding;
      // Change padding value
    } else {
      searchContainer.style.display = 'block';
      loginOrCart.style.display = 'flex';
      navBar.style.padding = originalPadding;
    }
  }
  
  if (toggle) {
    toggle.addEventListener('click', toggleChecker);
  }
}






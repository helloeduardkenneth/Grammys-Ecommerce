function sortProductsByCategory(category) {
    // Send an AJAX request to fetch the products filtered by category
    $.ajax({
      type: 'GET',
      url: 'filter-products-by-category.php',
      data: {
        category: category
      },
      success: function(response) {
        // Replace the current product container with the filtered products
        $('.product-container').html(response);
      }
    });
  }

  $('.product-link').on('click', function(e) {
    e.preventDefault();
    var category = $(this).data('filter');
    sortProductsByCategory(category);
  });
  
  
  


    // Sort Price (Low - High & High - Low)

    function sortProductsByPrice() {
        // get the selected option value from the dropdown
        const sortByPrice = document.getElementById("sort-by-price-select").value;
        
        // get all the product items
        const productItems = document.querySelectorAll(".product-item");
      
        // convert NodeList to array so we can sort
        const productItemsArray = Array.from(productItems);
      
        // sort the array by price in ascending or descending order
        if (sortByPrice === "low-to-high") {
          productItemsArray.sort((a, b) => a.dataset.price - b.dataset.price);
        } else if (sortByPrice === "high-to-low") {
          productItemsArray.sort((a, b) => b.dataset.price - a.dataset.price);
        }
      
        // remove existing product items
        const productItemsContainer = document.querySelector(".product-container");
        productItemsContainer.innerHTML = "";
      
        // append the sorted product items to the container
        productItemsArray.forEach((item) => {
          productItemsContainer.appendChild(item);
        });
      }
      
      // attach event listener to the sort button
      const sortButton = document.getElementById("sort-by-price-btn");
      sortButton.addEventListener("click", sortProductsByPrice);



      
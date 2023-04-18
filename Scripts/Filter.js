function FilterProduct() {
    const field = document.querySelector('.product-container');
    const li = Array.from(field.children);
    const indicator = document.querySelector('.product-links').children;
  
    this.run = function() {
      for(let i = 0; i < indicator.length; i++) {
        indicator[i].onclick = function() {
          const displayItems = this.getAttribute('data-filter');
          for(let x = 0; x < indicator.length; x++) {
            indicator[x].classList.remove('active');
          }
          this.classList.add('active');
          for(let z = 0; z < li.length; z++) {
            if((li[z].getAttribute('data-category') == displayItems) || displayItems == "All") {
              li[z].classList.add('active');
              li[z].style.transform = "scale(1)";
              setTimeout(() => {
                li[z].style.display = "block";
              }, 500);
            } else {
              li[z].classList.remove('active');
              li[z].style.transform = "scale(0)";
              setTimeout(() => {
                li[z].style.display = "none";
              }, 500);
            }
          }
        };
      }
    }
  }
  
  new FilterProduct().run();
  


    // Sort Price (Low - High & High - Low)

    function sortProductsByPrice() {
        // get the selected option value from the dropdown
        const sortByPrice = document.getElementById("sort-by-price-select").value;
    
        // get all the product items
        const productItems = document.querySelectorAll(".box");
    
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
    



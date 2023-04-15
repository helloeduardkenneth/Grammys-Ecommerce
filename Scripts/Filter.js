	// Filter Product Item

    // Define a function named FilterProduct
    function FilterProduct() {
        // Select the element with the class 'product-items'
        const field = document.querySelector('.product-items');
        // Convert the children of the 'product-items' element into an array
        const li = Array.from(field.children);
        // Select the children of the element with the class 'product-links'
        const indicator = document.querySelector('.product-links').children;

        // Define a method named 'run' inside the FilterProduct function
        this.run = function() {
            // Loop through the children of the 'product-links' element
            for(let i=0; i<indicator.length; i++)
            {
                // Add a click event listener to each child
                indicator[i].onclick = function () {
                    // Loop through all the children of the 'product-links' element
                    for(let x=0; x<indicator.length; x++)
                    {
                        // Remove the 'active' class from each child
                        indicator[x].classList.remove('active');
                    }
                    // Add the 'active' class to the clicked child
                    this.classList.add('active');
                    // Get the value of the 'data-filter' attribute of the clicked child
                    const displayItems = this.getAttribute('data-filter');

                    // Loop through all the children of the 'product-items' element
                    for(let z=0; z<li.length; z++)
                    {
                        // Apply a CSS transform to each child element to scale it down
                        li[z].style.transform = "scale(0)";
                        // Use a setTimeout to hide each child element after 500ms
                        setTimeout(()=>{
                            li[z].style.display = "none";
                        }, 500);

                        // If the 'data-category' attribute of the child matches the value of 'displayItems' or 'All'
                        if ((li[z].getAttribute('data-category') == displayItems) || displayItems == "All")
                        {
                            // Apply a CSS transform to scale up each child element
                            li[z].style.transform = "scale(1)";
                            // Use a setTimeout to show each child element after 500ms
                            setTimeout(()=>{
                                li[z].style.display = "flex";
                            }, 500);
                        }
                    }
                };
            }
        }
    }
    // Create an instance of the FilterProduct function and call its 'run' method
    new FilterProduct().run();


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



      
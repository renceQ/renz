<!DOCTYPE html>
<html>
<head>
  <?= $this->include('include/link') ?>
    <?= $this->include('include/header') ?>
    <style>
        .category-buttons {
            display: flex;
            justify-content: center;
            padding: 20px 0;
        }

        .category-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .category-button {
            background-color: #fff;
            color: #555;
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .category-button:hover {
            background-color: #ff0000;
            color: #fff;
        }

        .product-list {
            display: flex;
            flex-wrap: wrap;
        }

        .product-list-item {
            width: calc(33.33% - 10px);
            margin-right: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd; /* Add a border for clarity */
            padding: 10px;
            text-align: center;
        }

        .product-button {
            background-color: #009933;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .product-button:hover {
            background-color: #007722;
        }
    </style>
</head>
<body>
    <div class="category-container">
        <div class="category-buttons">
            <button id="womenButton" class="category-button">Women's</button>
            <button id="accessoriesButton" class="category-button">Accessories</button>
            <button id="mensButton" class="category-button">Men's</button>
        </div>

        <div id="productContainer" class="product-list"></div>
    </div>

    <script>
        const womenButton = document.getElementById('womenButton');
        const accessoriesButton = document.getElementById('accessoriesButton');
        const mensButton = document.getElementById('mensButton');

        const productContainer = document.getElementById('productContainer');

        function hideOtherContainers() {
            productContainer.innerHTML = '';
        }

        womenButton.addEventListener('click', () => {
            hideOtherContainers();
            loadAndDisplayCategory(2, productContainer);
        });

        accessoriesButton.addEventListener('click', () => {
            hideOtherContainers();
            loadAndDisplayCategory(3, productContainer);
        });

        mensButton.addEventListener('click', () => {
            hideOtherContainers();
            loadAndDisplayCategory(4, productContainer);
        });

        function loadAndDisplayCategory(categoryId, container) {
            // Use AJAX to fetch records based on categoryId and update the container
            fetch(`/get-products-by-category/${categoryId}`)
                .then(response => response.json())
                .then(products => {
                    // Loop through the products and add them to the list
                    products.forEach(product => {
                        const productDiv = document.createElement('div');
                        productDiv.classList.add('product-list-item');
                        productDiv.innerHTML = `
                            <p>Product Name: ${product.product_name}</p>
                            <p>Price: ${product.price}</p>
                            <img src="${product.image_url}" alt="Product Image" width="150" height="180" />
                            <button class="product-button">Add to Cart</button>
                        `;
                        container.appendChild(productDiv);
                    });
                })
                .catch(error => {
                    console.error(error);
                    container.innerHTML = 'Failed to load products.';
                });
        }
    </script>
</body>
</html>

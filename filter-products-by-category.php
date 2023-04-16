<?php
// Database connection
$db_name = 'mysql:host=localhost;dbname=mbaloyo';
$user_name = 'root';
$user_password = '';

/* Attempt to connect to MySQL database */
$link = new PDO($db_name, $user_name, $user_password);

// Get category filter
$category_filter = isset($_POST['category_filter']) ? $_POST['category_filter'] : '';

// Get sort filter
$sort_filter = isset($_POST['sort_filter']) ? $_POST['sort_filter'] : '';

// Query to fetch products based on the category filter
$query = "SELECT * FROM products";

if (!empty($category_filter)) {
    $query .= " WHERE category = '$category_filter'";
}

// Add sort filter to the query
if (!empty($sort_filter)) {
    if ($sort_filter == 'low-to-high') {
        $query .= " ORDER BY price ASC";
    } elseif ($sort_filter == 'high-to-low') {
        $query .= " ORDER BY price DESC";
    }
}

// Prepare and execute the query
$stmt = $link->prepare($query);
$stmt->execute();

// Fetch products
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Loop through the products and generate HTML
if (!empty($products)) {
    foreach ($products as $product) {
        echo '<form action="" method="POST">';
        echo '<input type="hidden" name="id" value="' . $product['id'] . '">';
        echo '<input type="hidden" name="name" value="' . $product['name'] . '">';
        echo '<input type="hidden" name="price" value="' . $product['price'] . '">';
        echo '<input type="hidden" name="thumbnail" value="' . $product['thumbnail'] . '">';

        echo '<ul class="product-items">';
        echo '<a href="ProductView.php?pid=' . $product['id'] . '">';
        echo '<li class="product-item" data-category="' . $product['category'] . '" data-price="' . $product['price'] . '">';
        echo '<img src="uploaded_thumbnail/' . $product['thumbnail'] . '" alt="">';
        echo '<div class="product-title-price">';
        echo '<h1 class="product-name">' . $product['name'] . '</h1>';
        echo '<h2 ><span>$</span>' . $product['price'] . '.00</h2>';
        echo '</div>';
        echo '<a class="product-btn" href="ProductView.php?pid=' . $product['id'] . '">View product</a>';
        echo '</li>';
        echo '</a>';
        echo '</ul>';
        echo '</form>';
    }
} else {
    echo '<p class="text-center">No products found!</p>';
}

// Close database connection
$link = null;
?>


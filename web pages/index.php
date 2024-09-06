<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .product-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            padding: 15px;
        }
        .product-card img {
            width: 250px; /* Adjust the width for better visibility */
            height: 250px; /* Adjust the height for consistent sizing */
            object-fit: contain; /* Adjust to 'contain' to show the full image */
            margin-bottom: 10px;
        }
        .product-card .btn {
            margin-top: 10px;
        }
        .product-description {
            color: #555;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .rating {
            color: #ffd700;
            margin-bottom: 10px;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 15px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .buttons-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MyShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-success text-white" href="login.php">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-secondary text-white" href="combined_hard.php">Go to Training App</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <!-- Product 1 -->
        <div class="col-md-4">
            <div class="product-card">
                <img src="images/iphone13.jpeg" alt="Apple iPhone 13">
                <h5>Apple iPhone 13</h5>
                <p class="product-description">The iPhone 13 delivers powerful performance with its A15 Bionic chip, stunning photos with its advanced dual-camera system, and all-day battery life in a sleek, durable design.</p>
                <div class="rating">★★★★☆</div>
                <p>$799.99</p>
                <button class="btn btn-primary">Add to Cart</button>
            </div>
        </div>

        <!-- Product 2 -->
        <div class="col-md-4">
            <div class="product-card">
                <img src="images/galaxy-s21.jpeg" alt="Samsung Galaxy S21">
                <h5>Samsung Galaxy S21</h5>
                <p class="product-description">Experience the next generation of mobile technology with the Galaxy S21. Featuring a stunning Dynamic AMOLED 2X display, 8K video recording, and pro-grade cameras for exceptional photos and videos.</p>
                <div class="rating">★★★★★</div>
                <p>$699.99</p>
                <button class="btn btn-primary">Add to Cart</button>
            </div>
        </div>

        <!-- Product 3 -->
        <div class="col-md-4">
            <div class="product-card">
                <img src="images/pixel-6.jpeg" alt="Google Pixel 6">
                <h5>Google Pixel 6</h5>
                <p class="product-description">Discover the Google Pixel 6 with its revolutionary Google Tensor processor, excellent low-light photography, and pure Android experience. The ideal phone for photography enthusiasts and tech-savvy users.</p>
                <div class="rating">★★★★☆</div>
                <p>$599.99</p>
                <button class="btn btn-primary">Add to Cart</button>
            </div>
        </div>
    </div>
    
    <!-- Sign Up and Sign In Buttons -->
    <div class="buttons-container">
        <a href="combined_hard.php" class="btn btn-secondary">Sign Up</a>
        <a href="login.php" class="btn btn-success">Sign In</a>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; 2024 MyShop. All rights reserved.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

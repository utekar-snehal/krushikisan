<?php
include('connect.php');
session_start();

if (isset($_GET['category'])) {
    $_SESSION['selected_category'] = $_GET['category'];
} else {
    $_SESSION['selected_category'] = 'All';
}

if (isset($_POST['selected_product'])) {
    $selectedProductName = $_POST['selected_product'];
    $selectedProductImage = $_POST['selected_product_image'];
    $selectedProductPrice = $_POST['selected_product_price'];
    $selectedProductinfo = $_POST['selected_product_info'];

    $_SESSION['selected_product'] = $selectedProductName;
    $_SESSION['selected_product_image'] = $selectedProductImage;
    $_SESSION['selected_product_price'] = $selectedProductPrice;
    $_SESSION['selected_product_info'] = $selectedProductinfo;

    header("Location: checkoutpage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KRUSHIKISAN Crops Store</title>
    <style>
        img {
            height: 200%;
            width: 200%;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0; 
        }

        header {
            background-color: #232f3e;
            color: white;
            padding: 10px;
            text-align: center;
            height:120px;
        }
        header h1{
            margin-top:50px;
        }

        nav {
            background-color: #333;
            overflow: hidden;
            text-align: center;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        nav a.active {
            background-color: #ddd;
            color: black;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-around;
            margin-left:10%;
            margin-right:10%;
        }

        .product-box {
            width: 300px;
            height: auto;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            border-radius: 5%;
        }

        .product-box:hover {
            transform: scale(1.02);
            background-color: #ECECEC;
        }

        .product-box img {
            max-width: 100%;
            height: 200px;
        }

        main {
            margin-top: 5%;
            margin-bottom:10%;
        }
        main input{
            width:40%;
            height:40px;
            border: 3px solid grey;
            border-radius:5%;
            margin-bottom:5%;
            text-align:left;
            margin-left:25%;
            font-size:15px;
        }
        main form button,.search{
            width:10%;
            height:40px;
            border: 3px solid grey;
            border-radius:5%;
            margin-bottom:5%;
            text-align:center;
            font-size:15px;
        }
       .product-box button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        }
        button:hover{
            transform: scale(1.02);
        }

    </style>
</head>
<body>
    <header>
        <h1>KRUSHIKISAN Retail Store</h1>
    </header>

    <nav>
        <a href="?category=All" <?php echo ($_SESSION['selected_category'] == 'All') ? 'class="active"' : ''; ?>>All</a>
        <a href="?category=Grains" <?php echo ($_SESSION['selected_category'] == 'Grains') ? 'class="active"' : ''; ?>>Grains</a>
        <a href="?category=Vegetable" <?php echo ($_SESSION['selected_category'] == 'Vegetable') ? 'class="active"' : ''; ?>>Vegetable</a>
        <a href="?category=Fruits" <?php echo ($_SESSION['selected_category'] == 'Fruits') ? 'class="active"' : ''; ?>>Fruits</a>
        <a href="?category=Fertilizers" <?php echo ($_SESSION['selected_category'] == 'Fertilizers') ? 'class="active"' : ''; ?>>Fertilizers</a>
    </nav>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
            <input type="text" name="s" placeholder=" Q Search Your Product Here .....">
            <button class="search" id="" >Search</button>
        </form>
        <section class="product-container">
            <?php   
                $search = isset($_GET['s']) ? $_GET['s'] : '';

                if ($_SESSION['selected_category'] != 'All') {
                    $selectedCategory = $_SESSION['selected_category'];
                    $sqlCommodities = "SELECT * FROM products WHERE Product_Category = '$selectedCategory'";
                } else {
                    $sqlCommodities = "SELECT * FROM products WHERE Product_Category <> 'Fertilizers'";
                }
                 
                if(!empty($search)){
                $sqlCommodities .= "AND Product_Name Like '%$search%'";
                $resultCommodities = $conn->query($sqlCommodities);
                }
                else{
                $sqlCommodities.= " ORDER BY RAND()";
                $resultCommodities = $conn->query($sqlCommodities);
                }

                if ($resultCommodities->num_rows > 0) {
                    while ($row = $resultCommodities->fetch_assoc()) {
                        echo '<form method="POST">';
                        echo '<div class="product-box">';
                        $image = "products/$row[Product_Img]";
                        echo "<img src='$image'>";
                        echo '<h3>' . $row["Product_Name"] . '</h3>';
                        echo '<h5>(' . $row["Product_Category"] . ')</h5>';
                        echo '<p>&#8377;' . $row["Product_Price"] .'/kg</p>';
                        echo '<input type="hidden" name="selected_product" value="' . $row["Product_Name"] . '">';
                        echo '<input type="hidden" name="selected_product_image" value="' . $image . '">';
                        echo '<input type="hidden" name="selected_product_price" value="' . $row["Product_Price"] .'/kg">';
                        echo '<input type="hidden" name="selected_product_info" value="' . $row["Product_Info"] . '">';
                        echo '<button type="submit">Buy Now.</button>';
                        echo '</div>';
                        echo '</form>';
                    }
                }else{
                    echo "$search is currntly not available";
                }
            ?>
        </section>
    </main>

    <script>
        var categoryLinks = document.querySelectorAll('nav a');
        categoryLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                categoryLinks.forEach(function (otherLink) {
                    otherLink.classList.remove('active');
                });
                link.classList.add('active');
            });
        });
    </script>
</body>
</html>

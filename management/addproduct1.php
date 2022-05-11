<?php
include 'config.php';
include 'connection.php';

$productSaved = FALSE;

if (isset($_POST['submit'])) {
    /*
     * Read posted values.
     */
    $productName = isset($_POST['name']) ? $_POST['name'] : '';
    $productPrice = isset($_POST['price']) ? $_POST['price'] : 0;
    $productDescription = isset($_POST['description']) ? $_POST['description'] : '';

    if (empty($productName)) {
        $errors[] = 'Vui lòng nhập tên sản phẩm';
    }

    if ($productPrice == 0) {
        $errors[] = 'Vui lòng nhập giá sản phẩm';
    }

    if (empty($productDescription)) {
        $errors[] = 'Vui lòng nhập mô tả sản phẩm';
    }

    if (!isset($errors)) {
        
        $sql = 'INSERT INTO product (
                    ProductName,
                    Price,
                    ProductNote
                ) VALUES (
                    ?, ?, ?
                )';
        
        $statement = $connection->prepare($sql);
        $statement->bind_param('sis', $productName, $productPrice, $productDescription);
        $statement->execute();

        $lastInsertId = $connection->insert_id;
        $statement->close();

        
        $connection->close();

        $productSaved = TRUE;
        $productName = $productQuantity = $productDescription = NULL;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
        <meta charset="UTF-8" />
        <!-- The above 3 meta tags must come first in the head -->

        <title>Save product details</title>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
        <style type="text/css">
            body {
                padding: 30px;
            }

            .form-container {
                margin-left: 80px;
            }

            .form-container .messages {
                margin-bottom: 15px;
            }

            .form-container input[type="text"],
            .form-container input[type="number"] {
                display: block;
                margin-bottom: 15px;
                width: 150px;
            }


            .form-container label {
                display: inline-block;
                float: left;
                width: 100px;
            }

            .form-container button {
                display: block;
                padding: 5px 10px;
                background-color: #8daf15;
                color: #fff;
                border: none;
            }

            .form-container .link-to-product-details {
                margin-top: 20px;
                display: inline-block;
            }
        </style>

    </head>
    <body>

        <div class="form-container">
            <h2>Add a product</h2>

            <div class="messages">
                <?php
                if (isset($errors)) {
                    echo implode('<br/>', $errors);
                } elseif ($productSaved) {
                    echo 'Thêm sản phẩm mới thành công';
                }
                ?>
            </div>

            <form action="addproduct1.php" method="post" enctype="multipart/form-data">
                <label for="name">Tên sản phẩm: </label>
                <input type="text" id="name" name="name" value="<?php echo isset($productName) ? $productName : ''; ?>">

                <label for="price">Giá: </label>
                <input type="text" id="price" name="price" min="0" value="<?php echo isset($productPrice) ? $productPrice : '0'; ?>">

                <label for="description">Mô tả: </label>
                <input type="text" id="description" name="description" value="<?php echo isset($productDescription) ? $productDescription : ''; ?>">


                <button type="submit" id="submit" name="submit" class="button">
                    Thêm
                </button>
            </form>

            <?php
            if ($productSaved) {
                ?>
                <a href="getProduct.php?id=<?php echo $lastInsertId; ?>" class="link-to-product-details">
                    Click me to see the saved product details in <b>getProduct.php</b> (product id: <b><?php echo $lastInsertId; ?></b>)
                </a>
                <?php
            }
            ?>
        </div>

    </body>
</html>
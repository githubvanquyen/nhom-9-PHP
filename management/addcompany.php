<?php
include 'config.php';
include 'connection.php';

$companySaved = FALSE;

if (isset($_POST['submit'])) {
    /*
     * Read posted values.
     */
    $companyName = isset($_POST['name']) ? $_POST['name'] : '';
    $companyDescription = isset($_POST['description']) ? $_POST['description'] : '';

    if (empty($companyName)) {
        $errors[] = 'Vui lòng nhập tên công ty';
    }

    if (empty($companyDescription)) {
        $errors[] = 'Vui lòng nhập mô tả công ty';
    }

    if (!isset($errors)) {
        
        $sql = 'INSERT INTO company (
                    CompanyName,
                    CompanyDetail
                ) VALUES (
                    ?, ?
                )';
        
        $statement = $connection->prepare($sql);
        $statement->bind_param('ss', $companyName, $companyDescription);
        $statement->execute();

        $lastInsertId = $connection->insert_id;
        $statement->close();
        
        $connection->close();

        $companySaved = TRUE;
        $companyName = $companyDescription = NULL;
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
            <h2>Add a company</h2>

            <div class="messages">
                <?php
                if (isset($errors)) {
                    echo implode('<br/>', $errors);
                } elseif ($companySaved) {
                    echo 'Thêm sản phẩm mới thành công';
                }
                ?>
            </div>

            <form action="addcompany.php" method="post" enctype="multipart/form-data">
                <label for="name">Tên công ty: </label>
                <input type="text" id="name" name="name" value="<?php echo isset($companyName) ? $companyName : ''; ?>">

                <label for="description">Mô tả: </label>
                <textarea name="description" id="description"><?php echo isset($companyDescription) ? $companyDescription : ''; ?></textarea>

                <button type="submit" id="submit" name="submit" class="button">
                    Thêm
                </button>
            </form>
        </div>
    </body>
</html>
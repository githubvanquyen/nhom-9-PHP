<?php
include 'config.php';
include 'connection.php';

$productImageSaved = FALSE;

if (isset($_POST['submit'])) {
    /*
     * Read posted values.
     */
    $productImageName = isset($_POST['name']) ? $_POST['name'] : '';
    $title = 0;
    if (empty($productImageName)) {
        $errors[] = 'vui lòng chọn tên sản phẩm';
    }

    /*
     * Create "uploads" directory if it doesn't exist.
     */
    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0777, true);
    }

    /*
     * List of file names to be filled in by the upload script 
     * below and to be saved in the db table "products_images" afterwards.
     */
    $filenamesToSave = [];
    $file = '';
    $allowedMimeTypes = explode(',', UPLOAD_ALLOWED_MIME_TYPES);

    /*
     * Upload files.
     */
    if (!empty($_FILES)) {
        if (isset($_FILES['file']['error'])) {
            foreach ($_FILES['file']['error'] as $uploadedFileKey => $uploadedFileError) {
                if ($uploadedFileError === UPLOAD_ERR_NO_FILE) {
                    $errors[] = 'You did not provide any files.';
                } elseif ($uploadedFileError === UPLOAD_ERR_OK) {
                    $uploadedFileName = basename($_FILES['file']['name'][$uploadedFileKey]);

                    if ($_FILES['file']['size'][$uploadedFileKey] <= UPLOAD_MAX_FILE_SIZE) {
                        $uploadedFileType = $_FILES['file']['type'][$uploadedFileKey];
                        $uploadedFileTempName = $_FILES['file']['tmp_name'][$uploadedFileKey];

                        $uploadedFilePath = rtrim(UPLOAD_DIR, '/') . '/' . $uploadedFileName;

                        if (in_array($uploadedFileType, $allowedMimeTypes)) {
                            if (!move_uploaded_file($uploadedFileTempName, $uploadedFilePath)) {
                                $errors[] = 'The file "' . $uploadedFileName . '" could not be uploaded.';
                            } else {
                                $filenamesToSave[] = $uploadedFilePath;
                            }
                        } else {
                            $errors[] = 'The extension of the file "' . $uploadedFileName . '" is not valid. Allowed extensions: JPG, JPEG, PNG, or GIF.';
                        }
                    } else {
                        $errors[] = 'The size of the file "' . $uploadedFileName . '" must be of max. ' . (UPLOAD_MAX_FILE_SIZE / 1024) . ' KB';
                    }
                }
            }
        }
    }
    
    $target_dir = "../assets/product/";
    $target_file = $target_dir . basename($_FILES["filebanner"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["filebanner"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // // Check if file already exists
    // if (file_exists($target_file)) {
    // echo "Sorry, file already exists.";
    // $uploadOk = 0;
    // }

    // Check file size
    if ($_FILES["filebanner"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["filebanner"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["filebanner"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }

    /*
     * Save product and images.
     */
    if (!isset($errors)) {
        foreach ($filenamesToSave as $filename) {
            $sql = 'INSERT INTO productimage (
                        ProductID,
                        image,
                        title
                    ) VALUES (
                        ?, ?, ?
                    )';

            $statement = $connection->prepare($sql);

            $statement->bind_param('isi',$productImageName , $filename, $title);

            $statement->execute();

            $statement->close();
        }
    }
    $title = 1;
    if($uploadOk == 1){
        $sql = 'INSERT INTO productimage (
            ProductID,
            image,
            title
        ) VALUES (
            ?, ?, ?
        )';

        $statement = $connection->prepare($sql);

        $statement->bind_param('isi',$productImageName , $target_file, $title);

        $statement->execute();

        $statement->close();
    }
    
    $connection->close();

    $productImageSaved = TRUE;
    $productImageName = NULL;
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

            .form-container input[type="file"] {
                margin-bottom: 15px;
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
                } elseif ($productImageSaved) {
                    echo 'Thêm ảnh sản phẩm thành công';
                }
                ?>
            </div>

            <form action="addproductimage.php" method="post" enctype="multipart/form-data">
                <label for="name">Tên sản phẩm: </label>
                <select name="name" id="name">
                    <?php
                        include 'connection.php';
                        $sql = "select * from  product";
                        $result = mysqli_query($connection, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($data = mysqli_fetch_assoc($result)){
                                echo '<option value="'.$data["ProductID"].'">'.$data["ProductName"].'</option>';
                            }
                        }
                    ?>
                </select>

                <label for="filebanner">ảnh bìa sản phẩm:</label>
                <input type="file" id="filebanner" name="filebanner">

                <label for="file">ảnh sản phẩm:</label>
                <input type="file" id="file" name="file[]" multiple>

                <button type="submit" id="submit" name="submit" class="button">
                    Submit
                </button>
            </form>

            
        </div>

    </body>
</html>
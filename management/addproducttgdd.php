<?php

    require_once("connection.php");
    if(!empty($_POST['productname']) && !empty($_POST['productprice']) && !empty($_POST['note']) && !empty($_POST['productcolor']) && !empty($_POST['productcapacity']) && !empty($_POST['productscreen']) && !empty($_POST['productos']) 
        && !empty($_POST['productcam']) && !empty($_POST['productchip']) && !empty($_POST['productpin']) 
        && !empty($_POST['productcompany']))
    {
        //insert product
       $productname =  $_POST['productname'] ;
        $productprice = $_POST['productprice'];
        $note = $_POST['note'];
        $productcolor = $_POST['productcolor'];
        $productcapacity  = $_POST['productcapacity'];
        $productscreen  = $_POST['productscreen'];
        $productos  = $_POST['productos'];
        $productcam  = $_POST['productcam'];
        $productchip  = $_POST['productchip'];
        $productpin  = $_POST['productpin'];
        $productcompany  = $_POST['productcompany'];
        $sql ="INSERT INTO product (ProductName,Price,ProductNote) VALUES('$productname','$productprice','$note')";
        $sq= mysqli_query($connection,$sql);

        $sql = "SELECT  MAX(ProductID) FROM product";
        $result = $connection->query($sql);

        //lay product id
        while($row = mysqli_fetch_array($result)){
            $ProductID= $row['MAX(ProductID)'];
     
        }
            echo "max: ".$ProductID;


            //insert productdetail
            $sql ="INSERT INTO productdetail (ProductID,ColorID,CapacityID,ProductScreen,ProductOS,ProductCam,ProductChip,ProductPin,CompanyID) VALUES('$ProductID','$productcolor','$productcapacity','$productscreen','$productos','$productcam','$productchip','$productpin','$productcompany')";
            $sq= mysqli_query($connection,$sql);


            //insert image
            for($i=0;$i<sizeof($_FILES['file']['name']);$i++)
            {
                $filename ="uploads/".$_FILES['file']['name'][$i];
                $sql ="INSERT INTO productimage (ProductID ,image ) VALUES('$ProductID','$filename')";
                $sq= mysqli_query($connection,$sql);
            }
            echo "da them vao database";


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
            .form-container input[type="number"],
            .form-container select,
            .form-container option{
                display: block;
                margin-bottom: 15px;
                width: 150px;
            }

            .form-container textarea{
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
             
            </div>

            <form action="addproducttgdd.php" method="post" enctype="multipart/form-data">

                <label for="name">Name</label>
                <input type="text" id="name" name="productname" >

                <label for="price">Price</label>
                <input type="text" id="price" name="productprice" >

                <label for="note">Note</label>
                <textarea id="note" name="note"></textarea>

                <label for="color">Color</label>
                <select name="productcolor" id="color">
                    <?php
                        $sql = "select * from  color";
                        $result = mysqli_query($connection, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($data = mysqli_fetch_assoc($result)){
                                echo '<option value="'.$data["ColorID"].'">'.$data["ColorName"].'</option>';
                            }
                        }
                    ?>
                </select>

                <label for="capacity">Capacity</label>
                <select name="productcapacity" id="capacity">
                    <?php
                        $sql = "select * from  capacity";
                        $result = mysqli_query($connection, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($data = mysqli_fetch_assoc($result)){
                                echo '<option value="'.$data["CapacityID"].'">'.$data["CapacityName"].'</option>';
                            }
                        }
                    ?>
                </select>

                <label for="screen">Screen</label>
                <input type="text" id="screen" name="productscreen" >


                <label for="os">OS</label>
                <input type="text" id="os" name="productos" >


                <label for="cam">Camera</label>
                <input type="text" id="cam" name="productcam" >

                <label for="chip">Chip</label>
                <input type="text" id="chip" name="productchip" >

                <label for="pin">Pin</label>
                <input type="text" id="pin" name="productpin" >

                <label for="company">Company</label>
                <select name="productcolor" id="color">
                    <?php
                        $sql = "select * from  company";
                        $result = mysqli_query($connection, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($data = mysqli_fetch_assoc($result)){
                                echo '<option value="'.$data["CompanyID"].'">'.$data["CompanyName"].'</option>';
                            }
                        }
                    ?>
                </select>


                <label for="file">Images</label>
                <input type="file" id="file" name="file[]" multiple>

                <button type="submit" id="submit" name="submit" class="button">
                    Submit
                </button>
            </form>

            
        </div>

    </body>
</html>
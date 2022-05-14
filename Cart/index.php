<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../components/banner/style.css">
    <link rel="stylesheet" href="../components/footer/style1.css">
</head>
<body>
    <?php include_once("../components/banner/index.php");?>
    <div class="cart__container">
        <div class="cart__header">Danh sách sản phẩm</div>
        <div class="cart__title">
            <div style="padding: 0px 80px 0px 140px">Sản Phẩm</div>
            <div>Loại Hàng</div>
            <div>Đơn Giá</div>
            <div>Thao Tác</div>
        </div>
        <div class="cart__item">
            <input type="checkbox">
            <div class="cart__product">
                <img src="../assets//detailProduct/iphone-13-pro-max-1.jpg" width="100px">
                <div>Iphone 13 Pro Max</div>
            </div>
            <div>
                Phân loại hàng: <br>
                128 GB<br>
                màu trắng<br>
            </div>
            <div>
                33.900.000đ
            </div>
            <button class="btn__delcart">Xóa khỏi giỏ hàng</button>
        </div>
        <div class="cart__item">
            <input type="checkbox">
            <div class="cart__product">
                <img src="../assets//detailProduct/iphone-13-pro-max-1.jpg" width="100px">
                <div>Iphone 13 Pro Max</div>
            </div>
            <div>
                Phân loại hàng: <br>
                128 GB<br>
                màu trắng<br>
            </div>
            <div>
                33.900.000đ
            </div>
            <button class="btn__delcart">Xóa khỏi giỏ hàng</button>
        </div>
        <div class="cart__footer">
            <button class="btn__order">Mua hàng</button>
        </div>
    </div>
    <?php include "../components/footer/index.php";?>
</body>
</html>
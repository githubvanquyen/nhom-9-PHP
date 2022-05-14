<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../components/banner_user/style.css">
    <link rel="stylesheet" href="../components/footer/style1.css">
</head>
<body>
    <?php include_once("../components/banner/index.php");
    if(isset($_GET['q'])){
        require_once("../connect_db.php");
        $query = "select * from productdetail 
        INNER JOIN product on productdetail.ProductID = product.ProductID
        INNER JOIN capacity on productdetail.CapacityID = capacity.CapacityID
        INNER JOIN color on productdetail.ColorID = color.ColorID
        INNER JOIN company on productdetail.CompanyID = company.CompanyID
        where productdetail.ProductID = '".$_GET['q']."'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0){
            $data = mysqli_fetch_assoc($result);
            $price = "";
            $dem = 0;
            for($i = strlen($data["Price"]) - 1; $i >= 0; $i--){
                if($i % 3 == 2 && $dem < 2){
                    $price = $price . $data["Price"][$i].'.';
                    $dem ++;
                }else{
                    $price = $price . $data["Price"][$i];
                }
            }
            $price = strrev($price);
        }

        $sql = "select image from productimage
        where ProductID = '".$_GET['q']."'";
        $resultimage = mysqli_query($con, $sql);
        if(mysqli_num_rows($resultimage) > 0){
            $n = mysqli_num_rows($resultimage);
            $index = 0;
            $image = array(20);
            while ($row = mysqli_fetch_row($resultimage)){
                $image[$index] = $row[0];
                $index++;
            } 
        }
    }
    ?>
    <div class="banner__mobilenav-func">
        <input type="text" placeholder="Bạn tìm gì..." class="moblie_search">
        <ul>
            <li><a href="../Cart/index.html">Giỏ hàng</a></li>
            <li><a href="../login/index.html">Đăng nhập</a></li>
            <li><a href="../register/index.html">Đăng kí</a></li>
            <li><a href="#">Phản hồi</a></li>
            <li><a href="#">Danh mục sản phẩm</a></li>
        </ul>
    </div>
    <div class="product__title">
        <h3><?= $data["ProductName"];?></h3>
        <span>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
        </span>
        <span class="rate-total"> 125 lượt đánh giá</span>
    </div>
    <div class="container">
        <div class="product__image">
            <div class="image__list">
                <div class="common prev"><i class="fa-solid fa-angle-left"></i></div>
                <img src="<?= $image[2];?>" alt="" width="90%" class="imgproduct">
                <div class="common next"><i class="fa-solid fa-angle-right"></i></div>
            </div>
            <div class="product__desc">
                <div class="description__info">
                    <i class="fa-solid fa-arrow-rotate-left"></i>
                    <div>Hư gì đổi nấy <strong>tháng</strong> tại siêu thị toàn quốc ( miễn phí tháng đầu)</div>
                </div>
                <div class="description__info">
                    <i class="fa-solid fa-file-shield"></i>
                    <div>bảo hành <strong>chính hãng điện thoại 1 năm</strong> tại các trung tâm bảo hành chính hãng</div>
                </div>
                <div class="description__info">
                    <i class="fa-solid fa-box-archive"></i>
                    <div>Bộ sản phầm gồm: Hộp, Sách hướng dẫn, Cây lấy sim, Cáp sạc</div>
                </div>
            </div>
            <div>
                <img src=<?= $image[1];?> alt="" width="90%">
            </div>
            <div style="font-size: 18px; line-height: 22px;"><?= $data["ProductNote"];?></div>
        </div>
        <div class="product__info">
            <div>
                <?php
                    $sql = "select CapacityName from productdetail 
                    INNER JOIN capacity on productdetail.CapacityID= capacity.CapacityID";
                    $result = mysqli_query($con, $sql);
                    if(mysqli_fetch_row($result) > 0){
                        while( $row = mysqli_fetch_assoc($result)){
                            echo "<button>".$row["CapacityName"]."</button>";
                        }
                    }
                ?>
            </div>
            <div>
                <?php
                    $sql = "select ColorName from productdetail 
                    INNER JOIN color on productdetail.ColorID= Color.ColorID";
                    $result = mysqli_query($con, $sql);
                    if(mysqli_fetch_row($result) > 0){
                        while( $row = mysqli_fetch_assoc($result)){
                            echo "<button>".$row["ColorName"]."</button>";
                        }
                    }
                ?>
            </div>
            <div class="product__price">
                <span><?= $price;?>đ</span>
                <del>48.990.000đ</del>
            </div>
            <div class="product__promo">
                <div class="promo__header">
                    <h4>Khuyến mãi</h4>
                    <p>Giá và khuyến mãi dự kiến áp dụng đến 30/5</p>
                </div>
                <div style="padding: 8px 12px;">
                    <p>Giảm giá 50% gói bảo hành mở rộng thêm 1 năm</p>
                    <p>Giảm đến 1,500,000đ khi tham gia thu cũ đổi mới (không áp dụng kèm giảm giá qua VNPAY)</p>
                    <p>Giảm 50% giá gói cước 1 năm cho sim VinaPhone trả sau</p>
                </div>
            </div>
            <div class="user__address">
                <p>Chọn địa chỉ đế biết thời gian giao hàng:</p>
                <div class="address__form">
                    <select class="city">
                        <option value="HN">Hà Nội</option>
                        <option value="HCM">Hồ Chí Minh</option>
                    </select>
                    <select>
                        <option value="">Quận / Huyện</option>
                        <option value="BTN">Bắc Từ Liêm</option>
                        <option value="NTN">Nam Từ Liêm</option>
                        <option value="HD">Hà Đông</option>
                        <option value="HBT">Hai Ba Trưng</option>
                        <option value="LB">Long Biên</option>
                    </select>
                    <select>
                        <option value="">Phường / Xã</option>
                        <option value="CD">Cầu diễn</option>
                        <option value="PD">Phú diễn</option>
                        <option value="abc">abc</option>
                    </select>
                </div>
            </div>
            <div class="btn__action">
                <button class="add__cart">Thêm vào giỏ</button>
                <button class="buy__now">Mua ngay</button>
            </div>
            <div class="product___config">
                <h3>Cấu hình Điện thoại iPhone 13 Pro Max 128GB</h3>
                <table>
                    <tbody>
                        <tr class="bg-color">
                            <td>Màn hình:</td>
                            <td><?= $data["ProductScreen"];?></td>
                        </tr>
                        <tr>
                            <td>Hệ điều hành:</td>
                            <td><?= $data["ProductOS"];?></td>
                        </tr>
                        <tr class="bg-color">
                            <td>Camera sau:</td>
                            <td><?= $data["ProductCam"]?></td>
                        </tr>
                        <tr>
                            <td>Camera trước:</td>
                            <td>camera 12 MP</td>
                        </tr>
                        <tr class="bg-color">
                            <td>Chip:</td>
                            <td><?= $data["ProductChip"]?></td>
                        </tr>
                        <tr>
                            <td>RAM:</td>
                            <td>6 GB</td>
                        </tr>
                        <tr class="bg-color">
                            <td>Bộ nhớ trong:</td>
                            <td>128 GB</td>
                        </tr>
                        <tr>
                            <td>SIM:</td>
                            <td>1 Nano SIM & 1 eSIMHỗ trợ 5G</td>
                        </tr>
                        <tr class="bg-color">
                            <td>Pin,Sạc:</td>
                            <td><?= $data["ProductPin"]?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include "../components/footer/index.php";?>
    <script>
        
        const images = [
            <?php
            for($i = 2; $i< $n; $i++){
                echo "\"".$image[$i]."\",";
            }
        ?>
        ];
        let i = 0;
        const prev = document.querySelector('.prev');
        const next = document.querySelector('.next');
        console.log(next);
        const imagePro = document.querySelector('.imgproduct');
        console.log(imagePro);
        prev.addEventListener('click',()=>{
            i--;
            if(i < 0){
                i = images.length -1;
            }
            imagePro.src = images[i];
        })
        next.addEventListener('click',()=>{
            i++;
            if(i > images.length - 1){
                i = 0;
            }
            imagePro.src = images[i];
        })
    </script>
</body>
</html>
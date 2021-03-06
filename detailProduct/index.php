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
        <input type="text" placeholder="B???n t??m g??..." class="moblie_search">
        <ul>
            <li><a href="../Cart/index.html">Gi??? h??ng</a></li>
            <li><a href="../login/index.html">????ng nh???p</a></li>
            <li><a href="../register/index.html">????ng k??</a></li>
            <li><a href="#">Ph???n h???i</a></li>
            <li><a href="#">Danh m???c s???n ph???m</a></li>
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
        <span class="rate-total"> 125 l?????t ????nh gi??</span>
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
                    <div>H?? g?? ?????i n???y <strong>th??ng</strong> t???i si??u th??? to??n qu???c ( mi???n ph?? th??ng ?????u)</div>
                </div>
                <div class="description__info">
                    <i class="fa-solid fa-file-shield"></i>
                    <div>b???o h??nh <strong>ch??nh h??ng ??i???n tho???i 1 n??m</strong> t???i c??c trung t??m b???o h??nh ch??nh h??ng</div>
                </div>
                <div class="description__info">
                    <i class="fa-solid fa-box-archive"></i>
                    <div>B??? s???n ph???m g???m: H???p, S??ch h?????ng d???n, C??y l???y sim, C??p s???c</div>
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
                <span><?= $price;?>??</span>
                <del>48.990.000??</del>
            </div>
            <div class="product__promo">
                <div class="promo__header">
                    <h4>Khuy???n m??i</h4>
                    <p>Gi?? v?? khuy???n m??i d??? ki???n ??p d???ng ?????n 30/5</p>
                </div>
                <div style="padding: 8px 12px;">
                    <p>Gi???m gi?? 50% g??i b???o h??nh m??? r???ng th??m 1 n??m</p>
                    <p>Gi???m ?????n 1,500,000?? khi tham gia thu c?? ?????i m???i (kh??ng ??p d???ng k??m gi???m gi?? qua VNPAY)</p>
                    <p>Gi???m 50% gi?? g??i c?????c 1 n??m cho sim VinaPhone tr??? sau</p>
                </div>
            </div>
            <div class="user__address">
                <p>Ch???n ?????a ch??? ????? bi???t th???i gian giao h??ng:</p>
                <div class="address__form">
                    <select class="city">
                        <option value="HN">H?? N???i</option>
                        <option value="HCM">H??? Ch?? Minh</option>
                    </select>
                    <select>
                        <option value="">Qu???n / Huy???n</option>
                        <option value="BTN">B???c T??? Li??m</option>
                        <option value="NTN">Nam T??? Li??m</option>
                        <option value="HD">H?? ????ng</option>
                        <option value="HBT">Hai Ba Tr??ng</option>
                        <option value="LB">Long Bi??n</option>
                    </select>
                    <select>
                        <option value="">Ph?????ng / X??</option>
                        <option value="CD">C???u di???n</option>
                        <option value="PD">Ph?? di???n</option>
                        <option value="abc">abc</option>
                    </select>
                </div>
            </div>
            <div class="btn__action">
                <button class="add__cart">Th??m v??o gi???</button>
                <button class="buy__now">Mua ngay</button>
            </div>
            <div class="product___config">
                <h3>C???u h??nh ??i???n tho???i iPhone 13 Pro Max 128GB</h3>
                <table>
                    <tbody>
                        <tr class="bg-color">
                            <td>M??n h??nh:</td>
                            <td><?= $data["ProductScreen"];?></td>
                        </tr>
                        <tr>
                            <td>H??? ??i???u h??nh:</td>
                            <td><?= $data["ProductOS"];?></td>
                        </tr>
                        <tr class="bg-color">
                            <td>Camera sau:</td>
                            <td><?= $data["ProductCam"]?></td>
                        </tr>
                        <tr>
                            <td>Camera tr?????c:</td>
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
                            <td>B??? nh??? trong:</td>
                            <td>128 GB</td>
                        </tr>
                        <tr>
                            <td>SIM:</td>
                            <td>1 Nano SIM & 1 eSIMH??? tr??? 5G</td>
                        </tr>
                        <tr class="bg-color">
                            <td>Pin,S???c:</td>
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
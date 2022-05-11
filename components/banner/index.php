<div class="banner">
    <div class="banner__img">
        <a href="../home"><img src="../assets/image/logo.png" alt="logo"></a>
    </div>
    <div class="banner__nav">
        <div class="banner__nav-search">
            <input type="text" placeholder="Bạn tìm gì...">
            
        </div>
        <div class="btn_navmobile">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="banner__nav-func">
            <ul>
                <li><a href="../Cart/index.php"><i class="fa-solid fa-cart-shopping" style="color: #fff;"></i>Giỏ hàng</a></li>
                <li><a href="../login/index.php">Đăng nhập</a></li>
                <li><a href="../register/index.php">Đăng kí</a></li>
                <li><a href="#">Phản hồi</a></li>
            </ul>
        </div>  
    </div>
    </div>
    <div class="banner__mobilenav-func">
        <input type="text" placeholder="Bạn tìm gì..." class="moblie_search">
        <ul>
            <li><a href="../Cart/index.php">Giỏ hàng</a></li>
            <li><a href="../login/index.php">Đăng nhập</a></li>
            <li><a href="../register/index.php">Đăng kí</a></li>
            <li><a href="#">Phản hồi</a></li>
            <li><a href="#">Danh mục sản phẩm</a></li>
        </ul>
    </div>
<script>
    const btnNavmobile = document.querySelector('.btn_navmobile');
    const bannerMobilenav = document.querySelector('.banner__mobilenav-func');
    const container = document.querySelector('.container');
    btnNavmobile.addEventListener('click',()=>{
        if(bannerMobilenav.classList.contains('show')){
            bannerMobilenav.classList.remove('show');
            container.setAttribute('style','margin-top: 70px')
        }else{
            bannerMobilenav.classList.add('show');
            container.setAttribute('style','margin-top: 0px')
        }
    })
</script>

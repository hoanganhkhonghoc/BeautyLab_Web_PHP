<section class="booking-section v2">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 offset-xl-4 col-lg-9 offset-lg-3">
                <div class="section-title text-center">
                    <br>
                    <h3 class="color-ff fw-500">Đăng nhập ngay</h3>
                </div>

                <div class="booking-wrapper mt-45">
                    <form action="index.php?c=index&a=xl_login" method="post" class="clearfix">

                        <div class="login_home email">
                            <input type="email" name="email" placeholder="Email" required <?php if (isset($_SESSION['err_email'])) {
                                                                                                echo "style='border: 2px solid red;'";
                                                                                            } ?> value="<?php if (isset($_SESSION['login_email'])) {
                                                    echo $_SESSION['login_email'];
                                                } ?>" />
                        </div>

                        <div class="login_home pass">
                            <input type="password" name="pass" placeholder="Mật khẩu" required style="<?php if (isset($_SESSION['err_pass'])) {
                                                                                                            echo 'border: 2px solid red;';
                                                                                                        } ?>" />
                        </div>

                        <div class="login_home error">
                            <span><?php if (isset($_SESSION['err_login'])) {
                                        echo $_SESSION['err_login'];
                                    } ?></span>
                        </div>

                        <div class="login_home regis">
                            Bạn chưa có tài khoản ??
                            <a href="index.php?c=index&a=register">Đăng ký ngay</a>
                        </div>

                        <br><br>
                        <button type="submit" name="submit">Đăng nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
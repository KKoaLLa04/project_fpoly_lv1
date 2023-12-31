<?php
get_headerLogin('', 'Login');
global $config;
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
?>
<div class="limiter">

    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <!-- <img src="" alt="IMG"> -->
            </div>

            <form class="login100-form validate-form" action="" method="POST">
                <span class="login100-form-title">
                    Member Login
                </span>
                <?php getMsg($msg, $msg_type) ?>
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="email" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="pass" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn text-white " name="btn-login">
                        <!-- <a href="" class="login100-form-btn text-white "
                        name="btn-login"> -->
                        Login
                        <!-- </a> -->
                    </button>
                </div>

                <div class="text-center p-t-12">
                    <p class=" text-danger font-italic "><?= isset($_SESSION['error']) ? ($_SESSION['error']) : false ?>
                    </p>

                </div>

                <div class="text-center p-t-12">
                    <span class="txt1">
                        Forgot
                    </span>
                    <a class="txt2" href="<?= $config['baseUrl'] ?>?role=client&mod=login&action=fogot">
                        Username / Password?
                    </a>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="<?= $config['baseUrl'] ?>?role=client&mod=login">
                        Hệ thống bắn đề thi online trực tuyến!
                        <!-- <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> -->
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php get_footerLogin() ?>
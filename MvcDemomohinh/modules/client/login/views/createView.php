<?php 
    get_headerLogin('','Login');
    global $config;
?>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login">


            <form class="login100-form validate-form" action="" method="POST">
                <span class="login100-form-title">
                    Create Account
                </span>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="email" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    <p><?php isset($_SESSION['error']) ? $_SESSION['error'] : false?></p>
                </div>

                <span>

                </span>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="name" placeholder="Name">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <!-- <i class="fa fa-envelope" aria-hidden="true"></i> -->
                        <i class="fa fa-solid fa-user" aria-hidden="true"></i>
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
                    <button type="submit" class="login100-form-btn text-white " name="btn-create">
                        <!-- <a href="" class="login100-form-btn text-white "
                        name="btn-login"> -->
                        Create
                        <!-- </a> -->
                    </button>
                </div>
                <div class="text-center p-t-136">
                    <a class="txt5 text-white" href="<?= $config['baseUrl'] ?>?role=client&mod=login">
                        Login
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php get_footerLogin() ?>
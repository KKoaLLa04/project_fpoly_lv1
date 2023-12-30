<?php
get_header('', 'Trang chủ');
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$pass = getFlashData('pass');
// echo "<pre>";
// print_r($errors);
// echo "</pre>";
?>


<div class="container-xl px-4 mt-4">


    <hr class="mt-0 mb-4">
    <?php getMsg($msg, $msg_type) ?>

    <div class="row">
        <div class="col">
            <!-- Account details card-->
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius:5px;" class="mb-4">
                <div class="card-header">Đổi mật khẩu</div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- Form Row-->
                        <div class="mb-3">
                            <!-- Form Group (first name)-->
                            <label class="small mb-1" for="inputFullName">Mật khẩu hiện tại</label>
                            <input name="password_old" class="form-control" id="password_old" type="text"
                                placeholder="Mật khẩu cũ" value="<?=!empty($pass)?$pass:false?>">
                            <span
                                class="text-danger "><?=!empty($errors['password']) ? $errors['password'] :false?></span>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Mật khẩu mới</label>
                            <input name="password_new" class="form-control" id="password_new" type="text"
                                placeholder="Mật khẩu mới">
                            <span
                                class="text-danger"><?=!empty($errors['password_new']) ? $errors['password_new'] :false?></span>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputImage">Xác nhận mật khẩu mới</label>
                            <input name="confirm_password" class="form-control" type="text"
                                placeholder="Xác nhận mật khẩu mới">
                            <span
                                class="text-danger"><?=!empty($errors['confirm_password']) ? $errors['confirm_password'] :false?></span>
                        </div>

                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit" name="update">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<?php get_footer() ?>
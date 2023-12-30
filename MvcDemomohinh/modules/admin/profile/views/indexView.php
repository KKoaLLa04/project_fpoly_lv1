<?php
get_header('', 'Profile');
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
?>


<div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <?php getMsg($msg, $msg_type) ?>

    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius:5px;" class="mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img style="height: 370px;" class="img-account-profile rounded-circle mb-2"
                        src="../../../assets/media/users/300_21.jpg" alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius:5px;" class="mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- Form Row-->
                        <div class="mb-3">
                            <!-- Form Group (first name)-->
                            <label class="small mb-1" for="inputFullName">Full name</label>
                            <input name="fullName" class="form-control" id="inputFullName" type="text"
                                placeholder="Enter your first name" value="<?=$data['infomation']['name']?> ">
                            <span class="text-danger"><?=!empty($errors['name']) ?$errors['name'] :false?></span>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input name="email" class="form-control" id="inputEmailAddress" type="email"
                                placeholder="Enter your email address" value="<?=$data['infomation']['email']?>">
                            <span class="text-danger"><?=!empty($errors['email']) ? $errors['email'] :false?></span>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputImage">Update image</label>
                            <input name="image" class="form-control" type="file">
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
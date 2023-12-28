<?php
get_header('', 'Tạo đề thi mới');
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
?>

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Tạo đề thi mới</h5>
            <!--end::Page Title-->
        </div>
        <!--end::Info-->
    </div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">

        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Form thông tin đề thi mới</h3>
            </div>
            <!--begin::Form-->
            <?php getMsg($msg, $msg_type) ?>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group" id="add-file">
                                <label>FIle đề thi (nén nếu là folder)</label>
                                <input type="file" name="file_exam[]" multiple class="form-control" id="file" />
                                <span
                                    style="color: red;"><?= !empty($errors['file_name']) ? $errors['file_name'] : false ?></span>
                            </div>
                        </div>

                        <!-- Thêm file -->
                        <div class="col-2 ">
                            <div class="form-group">
                                <i class="btn btn-primary mr-2" onclick="appendInput()">Thêm file</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="subject_id" value="<?=$data['subject_id']?>">
                    <input type="hidden" name="spring_block_id" value="<?=$data['spring_block_id']?>">
                    <button type="submit" class="btn btn-primary mr-2" value="<?=$_GET['id']?>">Thêm mới</button>
                    <a href="?role=admin&mod=subject_media&id=<?=$_GET['id']?>" class="btn btn-default">Thêm mới</a>
                    <button type="reset" class="btn btn-secondary">Làm lại</button>
                    <a href="?role=admin&mod=subject_media&id=<?=$_GET['id']?>" class="btn btn-default">Quay về</a>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
<script src="assets/exel/script.js"></script>
<script src="assets/exel/xlsx/xlsx.full.min.js"></script>
<?php get_footer() ?>
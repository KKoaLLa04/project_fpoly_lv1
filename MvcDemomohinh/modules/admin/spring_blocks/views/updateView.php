<?php get_header('', 'Chỉnh sửa') ?>

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Chỉnh sửa kỳ thi</h5>
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
                <h3 class="card-title">Form chỉnh sửa kỳ thi</h3>
            </div>
            <!--begin::Form-->
            <form method="POST" action="">
                <div class="card-body">
                <div class="row">
                            <?php
                            if (isset($_GET['mess']) && $_GET['mess'] == 'success') {
                            ?>
                                <div class="alert alert-success" role="alert">
                                    Thay đổi thông tin ca thi thành công.
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    <div class="form-group">
                        <label>Tên kỳ thi</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập vào tên kỳ thi" value="<?php echo (!empty($data['spring_bocks_update']['name']) ? $data['spring_bocks_update']['name'] : "") ?>"/>
                        <!-- <span class="form-text text-muted">We'll never share your email with anyone else.</span> -->
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Thay đổi</button>
                    <button type="reset" class="btn btn-secondary">Làm lại</button>
                    <a href="?role=admin&mod=spring_blocks" class="btn btn-default">Quay về</a>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
<?php get_footer() ?>
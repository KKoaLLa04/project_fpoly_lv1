<?php get_header('', 'Cập nhật môn học') ?>

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Cập nhật môn học</h5>
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
                <h3 class="card-title">Form thông tin môn học</h3>
            </div>
            <!--begin::Form-->
            <form method="POST" action="">
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên môn học</label>
                        <input type="text" name="name" class="form-control"  value="<?= !empty($data['subject']['name']) ? $data['subject']['name'] : false ?>" />
                    </div>
                    <div class="form-group">
                        <label>Mã môn học</label>
                        <input type="text" name="mon_code" class="form-control" value="<?= !empty($data['subject']['mon_code']) ? $data['subject']['mon_code'] : false ?>" />
                    </div>
                </div>
                <div class="card-footer">
                    <button type="update" class="btn btn-primary mr-2">Cập nhật</button>
                    <button type="reset" class="btn btn-secondary">Làm lại</button>
                    <a href="?role=admin&mod=subject" class="btn btn-default">Quay về</a>
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
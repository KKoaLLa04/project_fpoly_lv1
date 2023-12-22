<?php get_header('', 'Thay đổi danh sách thi') ?>

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Thay đổi danh sách thi</h5>
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
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Thông tin ca thi
                        <span class="d-block text-muted pt-2 font-size-sm">Thay đổi danh sách thi</span>
                    </h3>
                </div>

            </div>

            <div class="card-body">
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
                        <div class="row gx-5 gy-5">

                            <div class="p-4 col-lg-6 col-sm-12">
                                <?php
                                if (!empty($data['examination_update']['start_date'])) {
                                    $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $data['examination_update']['start_date']);
                                    $start_date = $datetime->format('Y-m-d');
                                }
                                ?>
                                <label for="">Ngày bắt đầu</label>
                                <input type="date" class="form-control" name="start_date" required value="<?php echo (!empty($start_date) ? $start_date : "") ?>">
                            </div>
                            <div class="p-4 col-lg-6 col-sm-12">
                                <label for="">Ca thi</label>
                                <input type="number" min="1" max="6" class="form-control" placeholder="Nhập ca thi" name="order_ex" value="<?php echo (!empty($data['examination_update']['order_ex']) ? $data['examination_update']['order_ex'] : "") ?>" required>
                            </div>
                            <div class="p-4 col-lg-6 col-sm-12">
                                <label for="">Phòng</label>
                                <input type="text" class="form-control" placeholder="Nhập phòng" name="room_code" value="<?php echo (!empty($data['examination_update']['room_code']) ? $data['examination_update']['room_code'] : "") ?>" required>
                            </div>
                            <div class="p-4 col-lg-6 col-sm-12">
                                <label for="">Lớp</label>
                                <input type="text" class="form-control" placeholder="Nhập lớp" name="class_code" value="<?php echo (!empty($data['examination_update']['class_code']) ? $data['examination_update']['class_code'] : "") ?>" required>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id">
                        <button type="submit" class="btn btn-primary mr-2">Thay đổi</button>
                        <button type="reset" class="btn btn-secondary">Làm lại</button>
                        <a href="?role=admin&mod=upload_file" class="btn btn-default">Quay về</a>
                    </div>
                </form>
                <!--end: Search Form-->


            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
<?php get_footer() ?>
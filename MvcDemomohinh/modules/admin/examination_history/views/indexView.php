<?php get_header('', 'Lịch sử tải đề') ?>

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Lịch sử tải đề</h5>
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
                    <h3 class="card-label">Lịch sử tải đề
                        <span class="d-block text-muted pt-2 font-size-sm">Lịch sử tải đề</span>
                    </h3>
                </div>

            </div>
            <div class="card-body">
            <div class="row">
                    <?php
                    $msg = getFlashData('msg');
                    $msg_type = getFlashData('msg_type');

                    getMsg($msg, $msg_type);
                    ?>
                </div>
                <!--begin: Search Form-->
                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end: Search Form-->
                <!--begin: Datatable-->
                <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Tên Giáo Viên</th>
                    <th>Ca thi</th>
                    <th>Phòng thi</th>
                    <th>Lớp</th>
                    <th>Môn</th>
                    <th>Thời gian thi</th>
                    <th>Thời gian tải đề</th>
                </tr>
                <?php if (!empty($data['exam_history'])) :
                    foreach ($data['exam_history'] as $key => $history) : ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $history['user_name'] ?></td>
                            <td><?= $history['order_ex'] ?></td>
                            <td><?= $history['room_code'] ?></td>
                            <td><?= $history['class_code'] ?></td>
                            <td><?= $history['name'] ?></td>
                            <td><?= $history['start_date'] ?></td>
                            <td><?=$history['time_download_examination']?></td>
                        </tr>
                <?php endforeach;
                endif ?>
            </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
<?php get_footer() ?>
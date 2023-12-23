<?php get_header('', 'Lịch thi') ?>

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Lịch thi</h5>
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
                    <h3 class="card-label">Lịch thi
                        <span class="d-block text-muted pt-2 font-size-sm">Lịch thi</span>
                    </h3>
                </div>

            </div>
            <div class="card-body">
                <!--begin: Search Form-->
                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Search..."
                                            id="kt_datatable_search_query" />
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
                    <thead>
                        <tr>
                            <th width="2%">#</th>
                            <th>Ngày</th>
                            <th>Ca - Phòng</th>
                            <th>Môn</th>
                            <th>Lớp</th>
                            <th>GT 1</th>
                            <th>GT 2</th>
                            <th>Thời gian phát đề</th>
                            <th>Tải đề</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data['exam_calender'])) :
                            foreach ($data['exam_calender'] as $key => $item) :
                        ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $item['start_date'] ?></td>
                            <td>Ca <?= $item['order_ex'] . ' - ' . $item['room_code'] ?></td>
                            <td><?= $item['subject_name'] ?></td>
                            <td><?= $item['class_code'] ?></td>
                            <td><?= $item['teacher_code_1'] ?></td>
                            <td><?= $item['teacher_code_2'] ?></td>
                            <th>7h15:00:00 - 9h15:00:00</th>
                            <th><a href="#" class="btn btn-primary w-100">Tải xuống</a></th>
                        </tr>
                        <?php endforeach;
                        endif ?>
                    </tbody>
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
<?php get_header('', 'Quản lý môn học') ?>

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Upload file kế hoạch thi</h5>
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
                    <h3 class="card-label">Upload file
                        <span class="d-block text-muted pt-2 font-size-sm">Upload file kế hoạch thi</span>
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <!-- <form action="" method="post" enctype="multipart/form-data" onsubmit="processFile()"> -->
                <label for="upload">File upload</label>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <input type="file" id="file" class="form-control" placeholder="File uppload" name="file">
                        </div>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-info w-100" onclick="processFile()">Xác nhận</button>
                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<script>
    const fileElement = document.getElementById('file');
    const dataJsonElement = document.getElementById('data_json')

    function processFile() {
        const file = fileElement.files[0];
        file.arrayBuffer().then((file_array_buffer) => {
            const workbook = XLSX.read(file_array_buffer);
            var index = 4;
            const info_master = [];
            while (true) {
                const info = {
                    ngay_thi: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'B' + index) ?
                        workbook.Sheets["Campus TVB"]['B' + index].w : '',
                    ca_thi: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'C' + index) ?
                        workbook.Sheets["Campus TVB"]['C' + index].w : '',
                    phong_thi: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'E' +
                        index) ? workbook.Sheets["Campus TVB"]['E' + index].w : '',
                    ten_mon: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'G' + index) ?
                        workbook.Sheets["Campus TVB"]['G' + index].w : '',
                    ma_mon: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'H' + index) ?
                        workbook.Sheets["Campus TVB"]['H' + index].w : '',
                    gt_1: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'O' + index) ?
                        workbook.Sheets["Campus TVB"]['O' + index].w : '',
                    gt_2: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'P' + index) ?
                        workbook.Sheets["Campus TVB"]['P' + index].w : '',
                }

                if (info.ngay_thi === '' || info.ngay_thi.length === 0) {
                    break;
                }
                info_master.push(info);

                index++

            }

            console.log(info_master);
            dataJsonElement.value = info_master;
            return info_master
            // console.log(workbook.Sheets["Campus TVB"]['G1373'].w);
            // Object.keys(workbook.Sheets["Campus TVB"]).forEach((key) => {
            //     if (!key.includes('!') && workbook.Sheets["Campus TVB"][key].w) {
            //         const str_target = workbook.Sheets["Campus TVB"][key].w.trim().replaceAll('  ', ' ');
            //         console.log(str_target);
            //     }

            // });
        });
    }
</script>
<!--end::Entry-->
<?php get_footer() ?>
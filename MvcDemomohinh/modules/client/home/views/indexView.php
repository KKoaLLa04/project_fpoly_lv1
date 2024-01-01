<?php
get_header('', 'Home');
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
?>
<!-- Page Content  -->
<div id="content" class="p-4 p-md-5 pt-5">
    <h2 class="mb-4">Sidebar #03</h2>
    <div class="p-3 mb-2 bg-primary text-white">Danh sách ca thi hôm nay</div>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Ngày</th>
            <th>Ca-Phòng</th>
            <th>Môn</th>
            <th>Lớp</th>
            <th>Giám thị</th>
            <th>Thời gian phát đề</th>
            <th>Tải đề thi</th>
        </tr>
        <tr>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
        </tr>
    </table>
</div>
<?=get_footer('')?>
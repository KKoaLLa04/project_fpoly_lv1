<?php
get_header('', 'Home');
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
?>
<!-- Page Content  -->
<div id="content" class="p-4 p-md-5 pt-5">
    <h2 class="mb-4">Sidebar #03</h2>
    <div class="p-3 mb-2 bg-primary text-white">Danh sách lịch sử tải đề</div>
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
</div>
<?=get_footer('')?>
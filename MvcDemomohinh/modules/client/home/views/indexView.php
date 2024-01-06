<?php
get_header('', 'Home');
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');

?>
<!-- Page Content  -->
<div id="content" class="p-4 p-md-5 pt-5">
    <h2 class="mb-4">Sidebar</h2>
    <div class="p-3 mb-1 bg-warning text-white">Danh sách ca thi hôm nay</div>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Ngày</th>
            <th>Ca-Phòng</th>
            <th>Môn</th>
            <th>Lớp</th>
            <th>Giám thị</th>
            <th>Thời gian phát đề</th>

        </tr>
        <?php
            $stt = 0;
            foreach($data['examination_teacher_bydate'] as $key => $value){
                $stt++;
                $gio = time(); //Thời gian hiện tại
                $now = date('H:i', $gio); //Thời gian hiện tại 
                $time_to_start = $value['start_date'];
                $timeStr = strtotime($time_to_start);
                // truoc 15p 
                $timeStrBefore = $timeStr - 15 * 60;
                $timeFormatBefore = date('H:i', $timeStrBefore);
                
                // sau 15p
                $timeStrAfter = $timeStr + 15 * 60;
                $timeFormatAfter = date('H:i', $timeStrAfter);
                


                ?>

        <tr>
            <td><?=$stt?></td>
            <td><?=substr($value['start_date'],0,10)?></td>
            <td><?=$value['order_ex']."-".$value['room_code']?></td>
            <td><?=$value['name']?></td>
            <td><?=$value['class_code']?></td>
            <td><?=$value['teacher_code_1']."-".$value['teacher_code_2']?></td>
            <td><?=substr($value['start_date'],10)?></td>
            <td> <?php if ($now > $timeFormatBefore && $now < $timeFormatAfter) : ?>
                <a href="?role=client&mod=home&action=down&examid=<?=$value['id'] ?>&exammedia=<?=$value['media_id'] ?>&file=<?=$value['name_exam'] ?>"
                    class="btn btn-primary w-100">Tải
                    xuống</a>
                <?php else : ?>
                <p style="color: red;">Không trong thời gian tải đề</p>
                <?php endif ?>
            </td>

        </tr>

        <?php
                
                }
                // echo $timeFormatBefore;
                // echo "<br>";
                
                // echo $now;
                // echo "<br>";

                // echo $timeFormatAfter;
                // echo "<br>";
            ?>
    </table>
    <br>
    <br>
    <br>
    <div class="p-3 mb-2 bg-primary text-white">Danh sách ca thi</div>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Ngày</th>
            <th>Ca-Phòng</th>
            <th>Môn</th>
            <th>Lớp</th>
            <th>Giám thị</th>
            <th>Thời gian phát đề</th>

        </tr>
        <?php
            $stt = 0;
            foreach($data['examination_teacher'] as $key => $value){
                $stt++;
                ?>

        <tr>
            <td><?=$stt?></td>
            <td><?=substr($value['start_date'],0,10)?></td>
            <td><?=$value['order_ex']."-".$value['room_code']?></td>
            <td><?=$value['name']?></td>
            <td><?=$value['class_code']?></td>
            <td><?=$value['teacher_code_1']."-".$value['teacher_code_2']?></td>
            <td><?=substr($value['start_date'],10)?></td>


        </tr>

        <?php
                
                }
            ?>
    </table>
</div>
<?=get_footer('')?>
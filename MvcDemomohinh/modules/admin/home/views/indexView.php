<?php
get_header('', 'Trang chủ');
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

getMsg($msg, $msg_type);
?>
<?php get_footer() ?>
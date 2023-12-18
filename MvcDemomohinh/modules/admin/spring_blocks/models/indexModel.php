<?php

function get_lists_spring_blocks()
{
    $sql = "SELECT * FROM spring_blocks ORDER BY id DESC";
    return getRaw($sql);
}

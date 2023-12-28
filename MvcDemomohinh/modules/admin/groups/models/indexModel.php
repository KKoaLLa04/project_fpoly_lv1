<?php

function get_lists_groups()
{
    $sql = "SELECT * FROM groups ORDER BY id ASC";
    return getRaw($sql);
}

function get_lists_modules()
{
    $sql = "SELECT * FROM modules";
    return getRaw($sql);
}

function get_groups_detail($id)
{
    $sql = "SELECT * FROM groups WHERE id=$id";
    return firstRaw($sql);
}

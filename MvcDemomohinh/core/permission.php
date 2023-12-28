<?php

function checkPermission($permissionData, $module, $role = 'Xem')
{
    if (!empty($permissionData)) {
        if (!empty($permissionData[$module])) {
            $moduleDetail = $permissionData[$module];

            foreach ($moduleDetail as $item) {
                if ($role == $item) {
                    return true;
                }
            }
        }
    }

    return false;
}

function getCurrentLogin($id = null)
{
    if (empty($id)) {
        if (!empty($_SESSION['login_information'])) {
            $id = $_SESSION['login_information']['id'];
        }
    }
    $sql = "SELECT * FROM users INNER JOIN groups ON groups.id=users.group_id WHERE users.id = $id";
    $data = firstRaw($sql);
    return $data;
}


function permissionData()
{
    $users = getCurrentLogin();

    $group_id = $users['group_id'];

    $sql = "SELECT * FROM groups WHERE id=$group_id";
    $data = firstRaw($sql);

    $permissionJson = $data['permission'];
    $permissionArr = json_decode($permissionJson, true);
    return $permissionArr;
}

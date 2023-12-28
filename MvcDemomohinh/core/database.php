<?php

function query($sql, $data = [], $statementStatus = false)
{
    global $conn;
    $query = false;

    try {
        $statement = $conn->prepare($sql);
        if (empty($data)) {
            $query = $statement->execute();
        } else {
            $query = $statement->execute($data);
        }
    } catch (Exception $exception) {
        // require_once './modules/errors/database.php';
        echo $exception->getMessage() . '<br/>';
        echo $exception->getFile() . ' - ' . $exception->getLine();
        die();
    }

    if ($statementStatus && $query) {
        return $statement;
    }
    return $query;
}


function insert($table, $dataInsert)
{

    $keyArr = array_keys($dataInsert);
    $fieldStr = implode(', ', $keyArr);
    $valueStr = ':' . implode(', :', $keyArr);

    $sql = 'INSERT INTO `' . $table . '`(' . $fieldStr . ') VALUES(' . $valueStr . ')';

    return query($sql, $dataInsert);
}

function insertLastId($table, $dataInsert)
{

    $keyArr = array_keys($dataInsert);
    $fieldStr = implode(', ', $keyArr);
    $valueStr = ':' . implode(', :', $keyArr);

    $sql = 'INSERT INTO `' . $table . '`(' . $fieldStr . ') VALUES(' . $valueStr . ')';

    return query($sql, $dataInsert, false);
}

function update($table, $dataUpdate, $condition = '')
{

    $updateStr = '';
    foreach ($dataUpdate as $key => $value) {
        $updateStr .= $key . '=:' . $key . ', ';
    }

    $updateStr = rtrim($updateStr, ', ');

    if (!empty($condition)) {
        $sql = 'UPDATE `' . $table . '` SET ' . $updateStr . ' WHERE ' . $condition;
    } else {
        $sql = 'UPDATE `' . $table . '` SET ' . $updateStr;
    }
    return query($sql, $dataUpdate);
}

function delete($table, $condition = '')
{
    if (!empty($condition)) {
        $sql = "DELETE FROM `$table` WHERE $condition";
    } else {
        $sql = "DELETE FROM `$table`";
    }

    return query($sql);
}

function deleteItemInArr($table, $condition = [])
{
    if (!empty($condition)) {
        foreach ($condition as $key => $item) {
            $sql = "DELETE FROM `$table` WHERE $key = $item";
            query($sql);
        }
    } else {
        $sql = "DELETE FROM `$table`";
        return query($sql);
    }
}

//Lấy dữ liệu từ câu lệnh SQL - Lấy tất cả
function getRaw($sql)
{
    $statement = query($sql, [], true);
    if (is_object($statement)) {
        $dataFetch = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $dataFetch;
    }

    return false;
}

//Lấy dữ liệu từ câu lệnh SQL - Lấy 1 bản ghi
function firstRaw($sql)
{
    $statement = query($sql, [], true);
    if (is_object($statement)) {
        $dataFetch = $statement->fetch(PDO::FETCH_ASSOC);
        return $dataFetch;
    }

    return false;
}

function getRows($sql)
{
    $statement = query($sql, [], true);
    if (!empty($statement)) {
        return $statement->rowCount();
    }
    return false;
}

function lastInsertId($table, $dataInsert)
{
    global $conn;
    if (!empty($table) && !empty($dataInsert)) {
        $keyArr = array_keys($dataInsert);
        $fieldStr = implode(', ', $keyArr);
        $valueStr = ':' . implode(', :', $keyArr);

        $sql = 'INSERT INTO `' . $table . '`(' . $fieldStr . ') VALUES(' . $valueStr . ')';

        $statement = $conn->prepare($sql);
        $statement->execute($dataInsert);

        $last_id = $conn->lastInsertId();

        return $last_id;
    }

    return false;
}

// get count check lesson
function getCheckCount()
{
    $sql = "SELECT * FROM lesson WHERE status = 0";
    $data = getRows($sql);
    return $data;
}

// get count check contact
function checkContact()
{
    $sql = "SELECT * FROM contact WHERE status = 0";
    $data = getRows($sql);
    return $data;
}


// get count check bill
function checkBill()
{
    $sql = "SELECT * FROM bill WHERE status = 0";
    $data = getRows($sql);
    return $data;
}

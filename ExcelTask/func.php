<?php


function get_objects(): array
{
    global $pdo;
    $res = $pdo->query("SELECT * FROM tbl_excel");
    return $res->fetchAll();
}
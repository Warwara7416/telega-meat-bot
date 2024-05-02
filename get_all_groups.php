<?php
ini_set('errore_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

ini_set("xdebug.var_display_max_children", '-1');
ini_set("xdebug.var_display_max_data", '-1');
ini_set("xdebug.var_display_max_depth", '-1');

function get_all_groups() {
  require_once("api/config.php");

  $connect = new mysqli(HOST, USER, PASSWORD, DATABASE);

  if ($connect->connect_error) {
    exit("Ошибка подключения к Базе Данных: " . $connect->connect_error);
  }
  
  // 
  // Установка кодировки
  // 

  $connect->set_charset("utf8");

  $all_groups = "SELECT DISTINCT `user_group` FROM `user_data`";
  $data = mysqli_query($connect, $all_groups);

  $groups = [];

  while ($row = mysqli_fetch_row($data)) {
    $groups[] = $row;
  }
  mysqli_close($connect);

  $json = json_encode($groups);

  return($json);
}

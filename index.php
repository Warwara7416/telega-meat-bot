<?php

ini_set('errore_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

ini_set("xdebug.var_display_max_children", '-1');
ini_set("xdebug.var_display_max_data", '-1');
ini_set("xdebug.var_display_max_depth", '-1');

// 
// Нужно для просмотра всех доступных на данный момент update
// 
// https://api.telegram.org/bot[токен бота]/getUpdates
// 

// 
// Уникальный токен бота
// 

require_once("api/config.php");
require("functions/id_telegram_check.php");
require("functions/id_telegram_add.php");
require("functions/id_last_update.php");
require("functions/phone_number_check.php");
require("functions/send_button.php");
require("functions/rewrite_id_last_update.php");
require("functions/phone_number_update.php");
require("functions/get_all_update_data.php");
// require("functions/write_log_file.php");





// 
//Соединение с Базой Данных
// 

$connect = new mysqli(HOST, USER, PASSWORD, DATABASE);

if ($connect->connect_error) {
  exit("Ошибка подключения к Базе Данных: " . $connect->connect_error);
}

// 
// Установка кодировки
// 

$connect->set_charset("utf8");

// 
// Получаем из БД id последнего update
// 

// $id_last_update = id_last_update($connect);


set_time_limit(20);
while (true == true) {

  // 
  // Получаем из БД id последнего update
  // 

  $id_last_update = id_last_update($connect);

  $getQuery = array(
    "offset" 	=> $id_last_update
  );

  $jsonData = get_all_update_data($getQuery);

  $arrays_length = count($jsonData['result']);
  
  // $data = file_get_contents('php://input');
  // $data = json_decode($data, true);

  var_dump($jsonData);

  $i = 0;
  
  if ($arrays_length > 1) {
    $i++;
  }

  // 
  // Получаем id пользователя после ввода команды /start.
  // 

  if ($jsonData["result"][$i]["message"]["text"] == '/start') {
    $id_user = $jsonData["result"][$i]["message"]["from"]["id"];

    echo "Попал в условие старт";

    // 
    // Проверяем, есть ли пользователь в БД.
    // 

    $id_telegram_check = id_telegram_check($connect, $id_user);

    // 
    // При отсутствии добавляем
    // 

    if ($id_telegram_check == 0) {
      id_telegram_add($connect, $id_user);
    }

    // 
    // Проверяем, записан ли номер телефона на id_telegram
    // 

    $phone_number_check = phone_number_check($connect, $id_user);
    $phone_number_check = $phone_number_check[0];

    if (is_null($phone_number_check) == true) {
      echo "В условии null";

      // 
      // Отправляем пользователю кнопку, которая позволит получить номер телефона
      // 

      send_button($id_user);
    }
  }

  $id_user = $jsonData["result"][$i]["message"]["from"]["id"];

  // 
  // Проверяем, получили ли мы номер от пользователя
  // 

  if (isset($jsonData["result"][$i]["message"]["contact"]["phone_number"]) and is_null($phone_number_check) == true) {
    echo "В добавлении номера";
    $phone_number = $jsonData["result"][$i]["message"]["contact"]["phone_number"];
    $id_user = $jsonData["result"][$i]["message"]["contact"]["user_id"];

    phone_number_update($connect, $id_user, $phone_number);
  }

  // 
  // Берем id последнего update и заносим в БД 
  // 

  // $rewrite_id_last_update = $jsonData["result"][$i]["update_id"];
  // rewrite_id_last_update($connect, $rewrite_id_last_update);

  // if ($i < $arrays_length - 1) {
  //   $i++;
  // }
}

mysqli_close($connect);

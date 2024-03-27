<?php

ini_set('errore_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define("BOT_TOKEN", "7045081537:AAH6I5RSroBYcxSO-rDtPR3N6r-7mOERd2s");

// $user_id = -1002110196820;
$user_id = 971603947;

$getQuery = array(
  "chat_id" 	=> $user_id,
  "text"  	  => "Отправляет текст без <b>HTML</b>-говна"
);

$ch = curl_init("https://api.telegram.org/bot". BOT_TOKEN ."/sendMessage?" . http_build_query($getQuery));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);

$resultQuery = curl_exec($ch);
curl_close($ch);

// Кнопка
$getQuery = array(
  "chat_id" 	=> $user_id,
  "text"  	  => "Отдать свой номер в персональное рабство",
  "reply_markup" => json_encode(
    array(
      'inline-keyboard' => array(
        array(
          array(
            'text' => 'Отправь номер телефона',
            'request_contact' => true
          )
        )
      ),
      'one_time_keyboard' => true,
      'resize_keyboard'   => true
    )
  )
);

$ch = curl_init("https://api.telegram.org/bot". BOT_TOKEN ."/getUpdates");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);

$resultQuery = curl_exec($ch);
curl_close($ch);

$jsonData = json_decode($resultQuery, true);

$arrays = count($jsonData);
echo $arrays;

for($i = 0; $i <= $arrays + 1; $i++) {
  var_dump($jsonData["result"][13]["message"]["contact"]);
}



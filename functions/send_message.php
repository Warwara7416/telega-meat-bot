<?php

function send_message($connect, $first_value, $message) {
  $getQuery = array(
    "chat_id" 	=> $first_value,
    "text"      => $message,
  );


  $ch = curl_init("https://api.telegram.org/bot". BOT_TOKEN ."/sendMessage?" . http_build_query($getQuery));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_HEADER, false);
  $resultQuery = curl_exec($ch);
  curl_close($ch);

  $jsonData = json_decode($resultQuery, true);
  // var_dump($jsonData);
}

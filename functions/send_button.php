<?php

function send_button($id_user) {
  $getQuery = array(
    "chat_id" 	=> $id_user,
    "text"      => "Дать согласие на обработку персональных данных",
    "reply_markup" => json_encode(
      array(
        'keyboard' => array(
          array(
            array(
              'text' => 'Отправь номер телефона',
              'request_contact' => true
            )
          )
        ),
        'one_time_keyboard' => true
      )
    )
  );


  $ch = curl_init("https://api.telegram.org/bot". BOT_TOKEN ."/sendMessage?" . http_build_query($getQuery));
  echo "<br>";
  echo "https://api.telegram.org/bot". BOT_TOKEN ."/sendMessage?" . http_build_query($getQuery);
  echo "<br>";
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_HEADER, false);
  $resultQuery = curl_exec($ch);
  curl_close($ch);
  // Нужно сделать проверку на forbidden и в случае чего менять пользователя

  $jsonData = json_decode($resultQuery, true);
}

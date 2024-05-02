<?php

require("functions/find_id_telegram.php");
require("functions/send_message.php");
require("api/connect.php");

// 
// Уникальный токен бота
// 

define("BOT_TOKEN", "7045081537:AAH6I5RSroBYcxSO-rDtPR3N6r-7mOERd2s");


if(isset($_POST['message-for-users']) and isset($_POST['group-or-number'])) {
  $message      = htmlspecialchars($_POST['message-for-users']);
  $destination  = htmlspecialchars($_POST['group-or-number']);

  $id_telegram = find_id_telegram($connect, $destination);

  while ($id_telegram) {
    $first_value = array_shift($id_telegram);

    send_message($connect, $first_value, $message);
  }
}

header("Location: http://localhost/pigeon-mail-bot/index.php");
exit;

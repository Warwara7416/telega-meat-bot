<?php

function find_id_telegram($connect, $destination) {
  $stmt = mysqli_stmt_init($connect);
  mysqli_stmt_prepare($stmt, "SELECT `id_telegram` 
                              FROM `user_data` 
                              WHERE `phone_number` = ?
                              OR	`user_group` = ?");
  
  mysqli_stmt_bind_param($stmt, "ss", $destination, $destination);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $data);

  $id_telegram = [];

  for ($i = 0; mysqli_stmt_fetch($stmt); $i++) {
    $id_telegram[] = $data;
  }

  if(!empty($id_telegram)) {
    return $id_telegram;
  }
}

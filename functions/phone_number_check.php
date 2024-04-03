<?php

function phone_number_check ($connect, $id_user) {
  $stmt = mysqli_stmt_init($connect);
  mysqli_stmt_prepare($stmt, "SELECT `phone_number`
                              FROM   `user_data`
                              WHERE  `id_telegram` = ?");
  
  mysqli_stmt_bind_param($stmt, "i", $id_user);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $phone_number_check);
  $phone_number_check = mysqli_stmt_fetch($stmt);
  $phone_number_check = $phone_number_check;

  return $phone_number_check;
}

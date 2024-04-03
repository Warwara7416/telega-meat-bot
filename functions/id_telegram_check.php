<?php

function id_telegram_check ($connect, $id_user) {
  $stmt = mysqli_stmt_init($connect);
  mysqli_stmt_prepare($stmt, "SELECT COUNT(1)
                              FROM  `user_data`
                              WHERE `id_telegram` = ?");
  
  mysqli_stmt_bind_param($stmt, "i", $id_user);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $id_telegram_check);
  mysqli_stmt_fetch($stmt);

  return $id_telegram_check;
}

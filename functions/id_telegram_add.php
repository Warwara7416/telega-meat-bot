<?php

function id_telegram_add ($connect, $id_user) {
  $stmt = mysqli_stmt_init($connect);
  mysqli_stmt_prepare($stmt, "INSERT 
                              INTO `user_data`(`id_telegram`) 
                              VALUES (?)");

  mysqli_stmt_bind_param($stmt, "i", $id_user);
  mysqli_stmt_execute($stmt);

  echo "Пользователь добавлен в БД";
}

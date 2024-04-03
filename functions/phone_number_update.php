<?php

function phone_number_update ($connect, $id_user, $phone_number) {
  $stmt = mysqli_stmt_init($connect);
  mysqli_stmt_prepare($stmt, "UPDATE  `user_data` 
                              SET     `phone_number` = ?
                              WHERE   `id_telegram`  = ?");
  
  mysqli_stmt_bind_param($stmt, "ii", $phone_number, $id_user);
  mysqli_stmt_execute($stmt);
}

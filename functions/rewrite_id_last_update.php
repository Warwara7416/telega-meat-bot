<?php

function rewrite_id_last_update ($connect, $rewrite_id_last_update) {
  $stmt = mysqli_stmt_init($connect);
  mysqli_stmt_prepare($stmt, "UPDATE  `last_update` 
                              SET     `id_last_update`=?");
  
  mysqli_stmt_bind_param($stmt, "i", $rewrite_id_last_update);
  mysqli_stmt_execute($stmt);
}

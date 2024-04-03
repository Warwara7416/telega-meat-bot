<?php

function id_last_update($connect) {
  $check_exist = "SELECT `id_last_update` FROM `last_update`";
  $id_last_update = mysqli_query($connect, $check_exist);
  $id_last_update = mysqli_fetch_row($id_last_update);
  $id_last_update = $id_last_update[0];

  return $id_last_update;
}

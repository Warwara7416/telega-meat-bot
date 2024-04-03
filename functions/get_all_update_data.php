<?php

function get_all_update_data($getQuery) {

// 
// Получаем все данные, которые идут после последнего update
// 

$ch = curl_init("https://api.telegram.org/bot". BOT_TOKEN ."/getUpdates?" . http_build_query($getQuery));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);

$resultQuery = curl_exec($ch);
curl_close($ch);

$jsonData = json_decode($resultQuery, true);

return $jsonData;

}

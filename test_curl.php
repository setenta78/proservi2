<?php
  $access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImUyZDY3N2MwNTZiOWE5NTE3OTA5ZmEzN2I2ZTMzMzliZjU5MmIzMjUwNzA1ODE1NDVhZDk2NDRiNGQ4MWZlNGUzYjg2ODAzOTY0ZGJhOGE1In0.eyJhdWQiOiIxIiwianRpIjoiZTJkNjc3YzA1NmI5YTk1MTc5MDlmYTM3YjZlMzMzOWJmNTkyYjMyNTA3MDU4MTU0NWFkOTY0NGI0ZDgxZmU0ZTNiODY4MDM5NjRkYmE4YTUiLCJpYXQiOjE3NTE1NTMyNjEsIm5iZiI6MTc1MTU1MzI2MSwiZXhwIjoxNzUxNjM5NjYxLCJzdWIiOiI2NDc1NiIsInNjb3BlcyI6W119.LF7D9PiXiquv5pmUbBWXKIdsLe0qcHdMgfPKTp2s1MWzXQvSnnPX0-oJj7qa72MRh8hcsR7uq9KCY0w4wRMd3KVS-CXr0sDkIiI8S5Sj7Iy5K9o-ZVOGxKE8bqkv__k_Sp6S2O3Z73mNNjy9QzsS4LD5R1bK7oV5ev-y9KT6dzXVIpits3ePBZfniSrUA3j0decLrXeIf1xp1J7LD3HSRBrY33davHvUTk18dDAhh7iTpd-VrWl1WrnNghGt4RfTP0G2o4znxNo2G2mfJ1GmnrZ15VynLJlVjRKPE4GHZ2vjHEMQ-7g-LVA9kbRzUfmUX7MK9UlaB7sKG5R1vNhLqpCb7SqARWIWyHGtjgmrUlVvCcXr6GDuGLorpEv2tvSGQMaOrfp-8Caq5-Re-HTENo8iqehn1JFuREcH97kgA4zBMUi8DuTS4RQfx9ANTLL8BE7uzPlckCXIsBTVnx8jxJgSkl-vqFzdWyKU7fk66SLyK-1auujtrmKNDVtm4m3yyrrXSTeh6BzSEZnK6CIMYh2eV7UVBElM2S8HNqoeF9oCOZ7U1Zrh4a-m9yYZjiTNVVHhSespcwTrW_bsRTIvgFCGKfEWvqK7oq4GQXooO6XWBFjSwSwlZj3lRQFC0bSySoItzFJgrCd9sXb7z_t8Q9KE-PxyAvnmdS3w-Aj2jE4';

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'http://autentificaticapi.carabineros.cl/api/auth/user');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token, 'Accept: application/json'));
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
  $response = curl_exec($ch);

  if ($response === false) {
      $httpCode = 0;
      $err = curl_error($ch);
  } else {
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      $err = '';
  }

  curl_close($ch);

  echo "URL: http://autentificaticapi.carabineros.cl/api/auth/user\n";
  echo "Código HTTP: $httpCode\n";
  echo "Respuesta: " . htmlspecialchars($response) . "\n";
  echo "Error: $err\n";
  ?>
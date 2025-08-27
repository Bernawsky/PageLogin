<?php
// auth/register.php

// Dados do Supabase
$url = "https://clelwptkauxejfvfrlcn.supabase.co/rest/v1/usuarios";
$apikey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImNsZWx3cHRrYXV4ZWpmdmZybGNuIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTYyODUyNzMsImV4cCI6MjA3MTg2MTI3M30.4mfEwG8ss6hZs_uCe_jdawLLx-XXdDlMqXrBG_gXPBw";

// Dados do formulário
$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // segurança!

$data = [
  'email' => $email,
  'username' => $username,
  'password' => $password
];

$options = [
  'http' => [
    'header'  => "Content-type: application/json\r\n" .
                 "apikey: $apikey\r\n" .
                 "Authorization: Bearer $apikey\r\n",
    'method'  => 'POST',
    'content' => json_encode($data),
  ]
];

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
  echo "Erro ao registrar";
} else {
  header("Location: ../public/home.html");
}
?>
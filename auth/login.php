<?php
// auth/login.php
session_start();

// Dados do Supabase
$url = "https://clelwptkauxejfvfrlcn.supabase.co/rest/v1/usuarios?email=eq." . $_POST['email'];
$apikey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImNsZWx3cHRrYXV4ZWpmdmZybGNuIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTYyODUyNzMsImV4cCI6MjA3MTg2MTI3M30.4mfEwG8ss6hZs_uCe_jdawLLx-XXdDlMqXrBG_gXPBw";

// Configura a requisição
$options = [
  'http' => [
    'header'  => "Content-type: application/json\r\n" .
                 "apikey: $apikey\r\n" .
                 "Authorization: Bearer $apikey\r\n",
    'method'  => 'GET'
  ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
  echo "Erro ao conectar com Supabase.";
  exit;
}

$usuarios = json_decode($result, true);

if (count($usuarios) === 0) {
  echo "Usuário não encontrado.";
  exit;
}

$usuario = $usuarios[0];
$senhaDigitada = $_POST['password'];
$senhaDoBanco = $usuario['password'];

if (password_verify($senhaDigitada, $senhaDoBanco)) {
  // Login válido — cria sessão
  $_SESSION['usuario'] = [
    'id' => $usuario['id'],
    'email' => $usuario['email'],
    'username' => $usuario['username']
  ];
  header("Location: ../public/home.html");
} else {
  echo "Senha incorreta.";
}
?>

<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.html");
  exit;
}
?>
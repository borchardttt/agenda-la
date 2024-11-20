<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'nome_do_banco';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (empty($email) || empty($senha)) {
        $_SESSION['error'] = "Preencha todos os campos.";
        header('Location: login.php');
        exit;
    }

    $sql = "SELECT id, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();


        if (password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: dashboard.php');
            exit;
        } else {
            $_SESSION['error'] = "E-mail ou senha incorretos.";
        }
    } else {
        $_SESSION['error'] = "Usuário não encontrado.";
    }

    $stmt->close();

    header('Location: login.php');
    exit;
}

$conn->close();

header('Location: login.php');
exit;

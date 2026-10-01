<?php
$nome = $_POST['nome'] ?? '';
$matricula = $_POST['matricula'] ?? '';
$email = $_POST['email'] ?? '';
$curso = $_POST['curso'] ?? '';
$periodo = $_POST['periodo'] ?? '';


$erros = [];
if (strlen($nome) < 3) {
    $erros[] = "O nome precisa ter no mínimo 3 caracteres.";
}
if (strlen($matricula) < 5) {
    $erros[] = "A matrícula precisa ter no mínimo 5 caracteres.";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = "Email Inválido.";
}
if ($periodo < 1 || $periodo > 10) {
    $erros[] = "O período precisa estar entre 1 e 10.";
}

if (!empty($erros)) {
    http_response_code(400);
    echo implode("<br>", $erros);
    exit;
}

$dados = $nome . "|" . $matricula . "|" . $email . "|" . $curso . "|" . $periodo . PHP_EOL;
file_put_contents("alunos.txt", $dados, FILE_APPEND);

http_response_code(200);
echo "Aluno Cadastrado com Sucesso!";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php 
        date_default_timezone_set('America/Sao_Paulo');

        $data_atual = date('d/m/Y'); // Formato: DD/MM/AAAA
        $hora_atual = date('H:i:s'); // Formato: HH:MM:SS

        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $text = $_POST['message'];
    ?>
    <div class="box">
        <h1>Comprovante de Envio</h1>
        <div class="box-group" id="return-box">
            <p>Nome: <?php print($name) ?></p>
            <p>Telefone: <?php print($phone) ?></p>
            <p>E-mail: <?php print($email) ?></p>
            <p>Mensagem: <?php print($text) ?></p>
        </div>
        <p>Mensagem enviada no dia <?php print($data_atual . ", às " . $hora_atual) ?></p>

        <a href="/index.html">Voltar à tela inicial</a>
    </div>
</body>
</html>
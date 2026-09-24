<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <?php 
        date_default_timezone_set('America/Sao_Paulo');

        $actualDate = date('Y-m-d'); 
        $name = $_POST['name'];
        $date = $_POST['date'];

        $age = $actualDate - $date;
        $firstName = explode(' ',  trim($name))[0];


    ?>
    <div class="box">
        <h1>Idade Calculada</h1>
        <div class="box-group" id="return-box">
            <p>
                <?php 
                    echo $firstName . " tem " . $age . " anos e é ";
                    if ($age < 18) {
                        echo "menor de idade.";
                    } else {
                        echo "maior de idade.";
                    }
                ?>
            </p>
        </div>
        <a href="../../index.html">Voltar ao menu anterior</a>
    </div>
</body>
</html>
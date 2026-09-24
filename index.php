<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programação 02</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
        <h1>Atividades de Desenvolvimento Web</h1>
        <ol>
            <?php
                $pastas = array_filter(glob('*'), 'is_dir');
                foreach ($pastas as $pasta) {
                    if (str_contains($pasta, "atividade")){
                        echo "<li><a href=\"$pasta/\">$pasta</a></li>";
                    }
                }
            ?>
        </ol>
    </div>
</body>
</html>`

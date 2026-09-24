<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moedas</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div id="form">
        <form method="post" class="box">
            <h2>Conversor de Moedas</h2>
            
            <div class="box-group">
                <label for="name">Valor (R$)</label>
                <input type="number" id="value" name="value" placeholder="Digite o valor em reais" required>
            </div>

            <div class="box-group">
                <label for="currency">Moeda para converter</label>
                <select name="currency" id="currency" required>
                    <option value="dolar">Dólar</option>
                    <option value="euro">Euro</option>
                    <option value="libra">Libra</option>
                </select>
            </div>

            <button class="btn" type="submit">Calcular</button>
        <?php 
        
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $dolar = 5.09;
                $euro = 5.91;
                $libra = 6.87;

                $currency = $_POST["currency"];
                $value = $_POST["value"];

                if ($currency == "dolar") {
                    $calculatedValue = $value / $dolar;
                } elseif ($currency == "euro") {
                    $calculatedValue = $value / $euro;
                } elseif ($currency == "libra") {
                    $calculatedValue = $value / $libra;
                } else {
                    $calculatedValue = 0;
                }
                echo "<div id='return-box'>O valor R$ " . $value . " = " . $calculatedValue . " " . $currency . "</div>";
                
            }
        ?>

        <a href="../../index.html">Voltar ao menu anterior</a>
        </form>

    </div>
</body>
</html>
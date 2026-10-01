<?php
if(!file_exists('alunos.txt')) {
    http_response_code(200);
    echo("Nenhum aluno cadastrado.");
    exit;
}

$linhas = file('alunos.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if(!$linhas) {
    http_response_code(200);
    echo("Nenhum aluno cadastrado.");
    exit;  
}
ob_start();
?>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Matrícula</th>
            <th>E-mail</th>
            <th>Curso</th>
            <th>Período</th>
        </tr>
    </thead>
    <tbody>
<?php
$html = ob_get_clean();

foreach ($linhas as $linha) {
    $campos = explode("|", trim($linha));
    $html .= "<tr>";

    foreach ($campos as $campo) {
        $html .= "<td>$campo</td>";
    }
    $html .= "</tr>";
}

$html .= "</tbody></table>";
http_response_code(200);
echo($html);

?>

<?php

class Livro {
    // Atributos
    public string $titulo;
    public string $autor;
    public int $ano;
    public int $paginas;
    public string $situacao;

    public function __construct(
        string $titulo, string $autor, int $ano, int $paginas, string $situacao
        )
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano = $ano;
        $this->paginas = $paginas;
        $this->situacao = $situacao;
    }

    public function is_old(): bool {
        if (2026 - $this->ano > 20) {
            return true;
        } else {
            return false;
        }
    }

    public function is_big(): bool {
        if ($this->paginas > 400) {
            return true;
        } else {
            return false;
        }
    }
}

session_start();

// 1. Se a sessão ainda não tiver os livros, inicializa com os 3 padrões
if (!isset($_SESSION['livros'])) {
    $_SESSION['livros'] = [
        new Livro("Harry Potter e a Pedra Filosofal", "J. K. Rowling", 1997, 208, "Disponível"),
        new Livro("A Dança dos Dragões", "George R. R. Martin", 2011, 864, "Emprestado"),
        new Livro("O Hobbit", "J. R. R. Tolkien", 1937, 310, "Disponível")
    ];
}

// 2. Verifica se foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_livro = new Livro(
        $_POST['titulo'],
        $_POST['autor'],
        (int) $_POST['ano'],
        (int) $_POST['paginas'],
        $_POST['situacao']
    );

    // Adiciona o novo livro diretamente no array persistido na sessão
    $_SESSION['livros'][] = $novo_livro;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-box">
        <h2>Cadastro de Livros</h2>
        <form method="post" id="form-cadastro" class="form-items">

            <div class="input-label">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" class="campo" required>
            </div>

            <div class="input-label">
                <label for="autor">Autor</label>
                <input type="text" id="autor" name="autor" class="campo" required>
            </div>

            <div class="input-label">
                <label for="ano">Ano</label>
                <input type="number" id="ano" name="ano" class="campo" required>
            </div>

            <div class="input-label">
                <label for="paginas">Páginas</label>
                <input type="number" id="paginas" name="paginas" class="campo" required>
            </div>

            <div class="input-label">
                <label for="situacao">Situação</label>
                <input type="text" id="situacao" name="situacao" class="campo" required>
            </div>

            <div class="btn-duplo">
                <input type="submit" class="btn-cadastrar" value="Cadastrar">
                <!-- <button type="button" id="btn-listar" onclick="">Listar</button> -->
            </div>

            <div id="mensagem">
                
            </div>

        </form>
        <div id="tabela-div">
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano</th>
                        <th>Páginas</th>
                        <th>Situação</th>
                        <th>Antigo</th>
                        <th>Extenso</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($_SESSION['livros'] as $livro): ?>
                    <tr>
                        <td><?= $livro->titulo ?></td>
                        <td><?= $livro->autor ?></td>
                        <td><?= $livro->ano ?></td>
                        <td><?= $livro->paginas ?></td>
                        <td><?= $livro->situacao ?></td>
                        <td><?= $livro->is_old() ? 'Sim' : 'Não' ?></td>
                        <td><?= $livro->is_big() ? 'Sim' : 'Não' ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
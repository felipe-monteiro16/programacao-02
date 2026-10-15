# Lista de Exercícios — Programação Orientada a Objetos (POO)

Esta lista deverá ser desenvolvida utilizando **PHP**, aplicando os conceitos de **Programação Orientada a Objetos (POO)** estudados em sala.

O objetivo não é apenas fazer o programa funcionar, mas demonstrar que você compreendeu e utilizou cada recurso da linguagem.

Para enviar os dados, você deve criar um pequeno formulário em **HTML** que realiza o método **POST** para o arquivo **PHP** que contém seu algoritmo, ou utilizar a maneira que achar mais conveniente.

---

## QUESTÃO 01 — Cadastro de livros

Uma pequena biblioteca deseja controlar seus livros.

Crie uma classe `Livro` contendo, no mínimo:

- Título;
- Autor;
- Ano de publicação;
- Quantidade de páginas;
- Situação do livro.

A classe deverá possuir métodos para:

- Cadastrar/definir os dados do livro;
- Exibir os dados;
- Verificar se o livro é considerado **antigo**;
- Verificar se o livro é considerado **extenso**.

Considere:

- Um livro é antigo quando possui mais de 20 anos desde sua publicação;
- Um livro é extenso quando possui mais de 400 páginas.

Crie pelo menos **3 livros**, com informações diferentes, e apresente o resultado das verificações.

---

## QUESTÃO 02 — Conta bancária

Implemente uma classe `ContaBancaria`.

A conta deverá possuir:

- Número da conta;
- Nome do titular;
- Saldo;
- Tipo da conta.

Implemente métodos para:

- Depositar;
- Sacar;
- Consultar saldo;
- Exibir os dados da conta.

O método de saque deverá impedir:

- Valores negativos ou iguais a zero;
- Saques superiores ao saldo disponível.

Crie pelo menos **2 contas bancárias** e realize diferentes operações sobre elas.

Após realizar algumas operações, tente efetuar um saque superior ao saldo disponível e faça o sistema apresentar uma mensagem adequada.

---

## QUESTÃO 03 — Funcionários e cálculo salarial

Uma empresa possui funcionários administrativos e vendedores.

Crie uma classe `Funcionario` contendo informações como:

- Nome;
- Matrícula;
- Salário-base;
- Cargo.

Crie uma segunda classe que represente um vendedor, utilizando uma estrutura adequada de orientação a objetos.

O vendedor deverá possuir também:

- Percentual de comissão;
- Valor total de vendas.

O sistema deverá calcular o salário final do vendedor considerando o salário-base e a comissão sobre as vendas.

O programa deverá permitir a criação de funcionários diferentes e apresentar seus salários finais.

---

## QUESTÃO 04 — Sistema de notas de alunos

Uma instituição de ensino deseja armazenar as notas de seus alunos.

Crie uma classe `Aluno` contendo:

- Nome;
- Matrícula;
- Curso;
- Pelo menos três notas.

Crie métodos para:

- Calcular a média;
- Verificar aprovação;
- Verificar recuperação;
- Exibir a situação acadêmica.

Utilize as seguintes regras:

- Média maior ou igual a 70 → **Aprovado**;
- Média entre 50 e 69,9 → **Recuperação**;
- Média inferior a 50 → **Reprovado**.

O programa deverá trabalhar com pelo menos **3 alunos**, cada um apresentando uma situação diferente.

### Desafio individual

Crie uma regra adicional definida por você.

Exemplos:

- Frequência mínima;
- Nota mínima em determinada avaliação;
- Prova substitutiva;
- Trabalho com peso diferente.

A nova regra deverá ser implementada no programa e explicada pelo aluno.
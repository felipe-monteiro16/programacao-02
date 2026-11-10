# Atividade 09 - Laravel com React

Página de login simples: o **Laravel** cuida do servidor (rotas, sessão e banco de dados) e o **React** cuida da tela.

Usuário de teste: `aluno@unimontes.br` / senha `123456`.

## Como o projeto foi criado

Seguindo o início rápido dos dois frameworks:

```bash
# 1. Laravel (cria a pasta com toda a estrutura, o .env, a chave e o banco SQLite)
composer create-project laravel/laravel atividade-09

# 2. React dentro do Laravel (o Laravel já vem com o Vite configurado)
cd atividade-09
npm install
npm install react react-dom
npm install --save-dev @vitejs/plugin-react
```

Depois disso foi só ligar o plugin do React no `vite.config.js` e trocar a entrada `resources/js/app.js` por `resources/js/app.jsx`.

## Como rodar

```bash
php artisan migrate --seed   # cria as tabelas e o usuário de teste
npm run build                # gera os arquivos do React em public/build
php artisan serve            # http://localhost:8000
```

Durante o desenvolvimento, `npm run dev` no lugar do `build` atualiza a tela a cada alteração.

## Estrutura de diretórios

| Pasta / arquivo | Função |
|---|---|
| `app/` | Código PHP da aplicação. |
| `app/Http/Controllers/` | Controllers: recebem a requisição e devolvem a resposta. Aqui está o `AuthController.php` (login, logout e usuário logado). |
| `app/Models/` | Models: classes que representam as tabelas do banco. O `User.php` representa a tabela `users`. |
| `app/Providers/` | Classes que configuram serviços quando a aplicação inicia. |
| `bootstrap/` | Arranque do framework. O `app.php` monta a aplicação e diz onde ficam as rotas. A subpasta `cache/` guarda arquivos gerados para acelerar o carregamento. |
| `config/` | Configurações (banco, sessão, autenticação, e-mail...). Leem os valores do `.env`. |
| `database/` | Banco de dados: `migrations/` (criação das tabelas), `seeders/` (dados iniciais, como o usuário de teste), `factories/` (dados falsos para testes) e o arquivo `database.sqlite`. |
| `public/` | Única pasta acessível pelo navegador. Tem o `index.php`, por onde entra toda requisição, e a pasta `build/` com o React já compilado. |
| `resources/` | Arquivos de front-end antes de compilar: `views/` (HTML em Blade), `js/` (React) e `css/`. |
| `routes/` | Definição das URLs. `web.php` tem as rotas do site; `console.php` tem comandos de terminal. |
| `storage/` | Arquivos gerados em tempo de execução: logs, cache, sessões e views compiladas. |
| `tests/` | Testes automatizados (`Feature/` e `Unit/`). |
| `vendor/` | Dependências PHP instaladas pelo Composer (não vai para o Git). |
| `node_modules/` | Dependências JavaScript instaladas pelo npm (não vai para o Git). |
| `.env` | Configurações do ambiente: chave da aplicação, banco, modo debug (não vai para o Git; o modelo é o `.env.example`). |
| `artisan` | Ferramenta de linha de comando do Laravel (`php artisan ...`). |
| `composer.json` | Lista as dependências PHP. |
| `package.json` | Lista as dependências JavaScript e os comandos `dev` e `build`. |
| `vite.config.js` | Configuração do Vite, que compila o React e o CSS. |

## Arquivos escritos para a atividade

| Arquivo | Papel |
|---|---|
| `routes/web.php` | Declara as 4 rotas: `/`, `/usuario`, `/login` e `/logout`. |
| `app/Http/Controllers/AuthController.php` | Lógica do login, do logout e da consulta do usuário logado. |
| `database/seeders/DatabaseSeeder.php` | Cria o usuário de teste. |
| `resources/views/app.blade.php` | HTML único da página, com a `<div id="app">` onde o React é desenhado. |
| `resources/js/app.jsx` | Ponto de entrada do React. |
| `resources/js/api.js` | Funções que fazem as requisições ao Laravel (`fetch`). |
| `resources/js/components/App.jsx` | Decide se mostra o formulário ou o painel. |
| `resources/js/components/FormLogin.jsx` | Formulário de e-mail e senha. |
| `resources/js/components/Painel.jsx` | Tela exibida depois do login. |
| `resources/css/app.css` | Estilos. |

## Fluxo e relacionamento entre os arquivos

### 1. Abrir a página

```
Navegador ── GET / ──> public/index.php ──> bootstrap/app.php ──> routes/web.php
                                                                       │
                                              resources/views/app.blade.php
                                                                       │
                              HTML com <div id="app"> + @vite(app.css, app.jsx)
```

1. Toda requisição entra por `public/index.php`, que carrega o autoload do Composer (`vendor/`) e inicia o Laravel por `bootstrap/app.php`.
2. O `bootstrap/app.php` carrega `routes/web.php`. A rota `/` devolve a view `app.blade.php`.
3. Na view, a diretiva `@vite` consulta `public/build/manifest.json` e insere as tags `<link>` e `<script>` dos arquivos compilados.
4. O navegador baixa o JavaScript. O `app.jsx` desenha o componente `App` dentro da `<div id="app">`.
5. O `App.jsx` chama `buscarUsuario()` (`api.js`), que faz `GET /usuario`. O `AuthController@usuario` responde com o usuário da sessão ou `null`.
6. Sem usuário, o `App` mostra o `FormLogin`; com usuário, mostra o `Painel`.

### 2. Fazer login

```
FormLogin.jsx ──> api.js ── POST /login (JSON) ──> routes/web.php
                                                        │
                                          AuthController@login
                                                        │
                                  Auth::attempt ──> Model User ──> database.sqlite
                                                        │
FormLogin.jsx <── JSON { usuario } ou { message } ──────┘
```

1. Ao enviar o formulário, o `FormLogin.jsx` chama `entrar(email, senha)` do `api.js`.
2. O `api.js` faz o `POST /login` em JSON, enviando o token CSRF que o Laravel gravou no cookie `XSRF-TOKEN` (proteção contra requisições forjadas).
3. O `routes/web.php` encaminha para `AuthController@login`, que valida os campos e chama `Auth::attempt`.
4. O `Auth::attempt` usa o model `User` para buscar o e-mail na tabela `users` e compara a senha com o hash salvo.
5. Se estiver certo, o Laravel grava o usuário na sessão e responde com os dados dele; o `App` troca o formulário pelo `Painel`.
6. Se estiver errado, responde com status 401 e a mensagem, que o `FormLogin` mostra na tela.

O botão **Sair** do `Painel.jsx` segue o mesmo caminho: `sair()` no `api.js` → `POST /logout` → `AuthController@logout` encerra a sessão → o `App` volta a mostrar o formulário.

### 3. Compilação do front-end

```
resources/js/*.jsx + resources/css/app.css ── npm run build (Vite) ──> public/build/
```

O navegador não entende JSX. O Vite, com o plugin do React, transforma os arquivos de `resources/` em JavaScript e CSS comuns dentro de `public/build/`, e gera o `manifest.json` que o `@vite` da view usa para encontrar os nomes finais dos arquivos.

### Resumo

- **Laravel** responde as requisições: entrega o HTML inicial e depois só troca dados em JSON.
- **React** monta a tela no navegador e decide o que mostrar a partir desses dados.
- **Vite** é a ponte entre os dois: compila o React e avisa o Laravel onde estão os arquivos gerados.

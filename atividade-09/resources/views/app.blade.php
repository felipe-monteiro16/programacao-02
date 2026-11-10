<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Endereço base do Laravel, usado pelo React para montar as URLs das requisições --}}
    <meta name="base-url" content="{{ url('/') }}">
    <title>Atividade 09</title>

    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=lato:300,400">
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
</head>
<body>
    {{-- O React assume a partir daqui (resources/js/app.jsx) --}}
    <div id="app"></div>
</body>
</html>

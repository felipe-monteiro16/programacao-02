// Funções que conversam com o Laravel.

const baseUrl = document.querySelector('meta[name="base-url"]').content;

// O Laravel grava o token CSRF no cookie XSRF-TOKEN e exige que ele volte
// no cabeçalho X-XSRF-TOKEN em toda requisição POST.
function tokenCsrf() {
    const cookie = document.cookie
        .split('; ')
        .find((item) => item.startsWith('XSRF-TOKEN='));

    return cookie ? decodeURIComponent(cookie.split('=')[1]) : '';
}

async function requisicao(metodo, caminho, corpo) {
    const resposta = await fetch(`${baseUrl}/${caminho}`, {
        method: metodo,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-XSRF-TOKEN': tokenCsrf(),
        },
        body: corpo ? JSON.stringify(corpo) : undefined,
    });

    const dados = await resposta.json();

    if (!resposta.ok) {
        throw new Error(dados.message ?? 'Não foi possível concluir a operação.');
    }

    return dados;
}

export function buscarUsuario() {
    return requisicao('GET', 'usuario');
}

export function entrar(email, password) {
    return requisicao('POST', 'login', { email, password });
}

export function sair() {
    return requisicao('POST', 'logout');
}

import { useState } from 'react';
import { entrar } from '../api';

export default function FormLogin({ aoEntrar }) {
    const [email, setEmail] = useState('');
    const [senha, setSenha] = useState('');
    const [erro, setErro] = useState('');
    const [enviando, setEnviando] = useState(false);

    async function enviar(evento) {
        evento.preventDefault();
        setErro('');
        setEnviando(true);

        try {
            const dados = await entrar(email, senha);
            aoEntrar(dados.usuario);
        } catch (falha) {
            setErro(falha.message);
            setEnviando(false);
        }
    }

    return (
        <form className="form-items" onSubmit={enviar}>
            <div className="input-label">
                <label htmlFor="email">E-mail</label>
                <input
                    className="campo"
                    id="email"
                    type="email"
                    autoComplete="username"
                    value={email}
                    onChange={(evento) => setEmail(evento.target.value)}
                    required
                />
            </div>

            <div className="input-label">
                <label htmlFor="senha">Senha</label>
                <input
                    className="campo"
                    id="senha"
                    type="password"
                    autoComplete="current-password"
                    value={senha}
                    onChange={(evento) => setSenha(evento.target.value)}
                    required
                />
            </div>

            <button className="btn btn-primario" type="submit" disabled={enviando}>
                {enviando ? 'Entrando...' : 'Entrar'}
            </button>

            {erro && <p className="mensagem mensagem-erro" role="alert">{erro}</p>}

            <p className="texto-mutado">
                Usuário de teste: aluno@unimontes.br<br />
                Senha: 123456
            </p>
        </form>
    );
}

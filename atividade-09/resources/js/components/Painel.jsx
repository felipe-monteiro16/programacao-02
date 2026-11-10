import { useState } from 'react';
import { sair } from '../api';

export default function Painel({ usuario, aoSair }) {
    const [erro, setErro] = useState('');

    async function encerrar() {
        setErro('');

        try {
            await sair();
            aoSair();
        } catch (falha) {
            setErro(falha.message);
        }
    }

    return (
        <div className="form-items">
            <p className="mensagem mensagem-sucesso">Você está logado!</p>

            <table>
                <tbody>
                    <tr>
                        <th>Nome</th>
                        <td>{usuario.name}</td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td>{usuario.email}</td>
                    </tr>
                </tbody>
            </table>

            <button className="btn btn-secundario" type="button" onClick={encerrar}>
                Sair
            </button>

            {erro && <p className="mensagem mensagem-erro" role="alert">{erro}</p>}
        </div>
    );
}

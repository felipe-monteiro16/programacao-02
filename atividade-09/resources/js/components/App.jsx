import { useEffect, useState } from 'react';
import { buscarUsuario } from '../api';
import FormLogin from './FormLogin';
import Painel from './Painel';

export default function App() {
    const [usuario, setUsuario] = useState(null);
    const [carregando, setCarregando] = useState(true);

    // Ao abrir a página, pergunta ao Laravel se já existe alguém logado
    useEffect(() => {
        buscarUsuario()
            .then((dados) => setUsuario(dados.usuario))
            .catch(() => setUsuario(null))
            .finally(() => setCarregando(false));
    }, []);

    return (
        <div className="form-box">
            <h2>Atividade 09</h2>

            {carregando && <p className="texto-mutado">Carregando...</p>}

            {!carregando && !usuario && <FormLogin aoEntrar={setUsuario} />}

            {!carregando && usuario && (
                <Painel usuario={usuario} aoSair={() => setUsuario(null)} />
            )}
        </div>
    );
}

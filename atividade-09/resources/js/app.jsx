import { createRoot } from 'react-dom/client';
import App from './components/App';

// Ponto de entrada do React: desenha o componente App dentro da <div id="app">
createRoot(document.getElementById('app')).render(<App />);

function cadastrarAluno(event) {

    // Comando para impedir recarregamento da página ao finalizar form
    event.preventDefault();

    let nome = form.nome.value;
    let matricula = form.matricula.value;
    let email = form.email.value;
    let curso = form.curso.value;
    let periodo = form.periodo.value;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "cadastrar.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    let dados = "nome=" + encodeURIComponent(nome) +
                "&matricula=" + encodeURIComponent(matricula) +
                "&email=" + encodeURIComponent(email) +
                "&curso=" + encodeURIComponent(curso) +
                "&periodo=" + encodeURIComponent(periodo);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            let mensagem = document.getElementById("mensagem");
            if (xhr.status == 200) {
                listarAlunos(false);
                mensagem.style.color = "green";
                form.reset();
            } else {
                mensagem.style.color = "red";
            }    
            mensagem.innerHTML = xhr.responseText;
        }
    }
    xhr.send(dados)
}


function listarAlunos(discrete=false) {
    
    tabelaAlunos = document.getElementById("tabela-alunos");
    if (tabelaAlunos.style.display === "block" && !discrete) {
        tabelaAlunos.style.display = "none";
        btnListarAlunos.innerText = "Listar Alunos";
        return;
    }
    
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "listar.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            let tabelaAlunos = document.getElementById("tabela-alunos");
            
            if (xhr.status == 200 || xhr.status == 204) {
                tabelaAlunos.innerHTML = xhr.responseText;

                if(!discrete) {
                    tabelaAlunos.style.display = "block";
                    btnListarAlunos.innerText = "Ocultar Alunos";
                }
                
            } else {
                alert("Listagem de Alunos Falhou.")
            }    
        }
    }
    xhr.send();
}

const form = document.getElementById("form-cadastro-aluno");
const btnListarAlunos = document.getElementById("btn-listar-alunos");

btnListarAlunos.addEventListener("click", () => listarAlunos(discrete=false));
form.addEventListener("submit", cadastrarAluno);
form.addEventListener("focusin", function() {
    if (xhr.status == 200) {
        let mensagem = document.getElementById("mensagem");
        mensagem.innerHTML = "";
    }
});

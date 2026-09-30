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
                mensagem.style.color = "green";
                form.reset();
            } else {
                mensagem.style.color = "red";
            }    
            mensagem.innerHTML = xhr.responseText;
        }
    }
    form.addEventListener("focusin", function() {
        if (xhr.status == 200) {
            let mensagem = document.getElementById("mensagem");
            mensagem.innerHTML = "";
        }
    });
    xhr.send(dados)
}

const form = document.getElementById("form-cadastro-aluno");
form.addEventListener("submit", cadastrarAluno);


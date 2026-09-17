EMAIL = "admin@email.com"
PASSWORD = "admin"

function postLogin(){
    event.preventDefault();
    email = document.getElementById("email").value
    password = document.getElementById("password").value
    if (email == "" || password == "") {
        alert("Valores em branco não são permitidos.")
        document.getElementById("login_form").reset()
        return
    }

    if (email == EMAIL && password == PASSWORD) {
        document.getElementById("output_div").className = "success-message"
        document.getElementById("output_div").innerText = "Login realizado com sucesso!"

    } else {
        document.getElementById("output_div").className = "error-message"
        document.getElementById("output_div").innerText = "Credenciais Invalidas."

    }


}
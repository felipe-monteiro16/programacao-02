function addNewTask() {
    const list = document.getElementById("task-list")

    // coleta de input
    const inputElement = document.getElementById("input-txt")
    const tastkText = inputElement.value

    if (tastkText.trim() === "") {
        alert("Por favor, digite uma tarefa!")
        return
    }
    if (list.childElementCount >= 15) {
        alert("Limite de Tarefas excedido.")
        return
    }
    
    // insere item com botao de remover (recurso extra)
    const newItem = document.createElement("li")
    
    const textSpan = document.createElement("span")
    textSpan.innerText = tastkText
    
    const removeBtn = document.createElement("button")
    removeBtn.className = "btn-remove"
    removeBtn.innerText = "X"
    removeBtn.onclick = function() {
        removeTask(this)
    }

    newItem.appendChild(textSpan)
    newItem.appendChild(removeBtn)
    list.appendChild(newItem)

    // limpeza
    inputElement.value = ""
}

// Funcao para remover tarefa (+3 pontos extras)
function removeTask(button) {
    const li = button.parentElement
    li.remove()
}
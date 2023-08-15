// Crea el icono y el boton "copiar", y agrega un registro de evento
function create_copy_button(text_to_copy) {
    const icon = document.createElement("i");
    icon.classList.add("fa", "fa-copy");

    const button = document.createElement("button");
    button.classList.add("copy-response-button");

    button.appendChild(icon);

    button.addEventListener("click", function () {
        navigator.clipboard.writeText(text_to_copy);
    });

    return button;
}

// Agrega el boton de copia al elemento "respuesta" del chat
function initialize_copy_buttons() {
    const responseElements = document.querySelectorAll(
        ".chat-bubble.bg-responseBubble"
    );
    responseElements.forEach((responseElement) => {
        if (!responseElement.querySelector(".copy-response-button")) {
            const responseText = responseElement.textContent.trim();
            const copyButton = create_copy_button(responseText);
            responseElement.appendChild(copyButton);
        }
    });
}

document.addEventListener("DOMContentLoaded", initialize_copy_buttons);

// Inicializa los botones después de que Livewire actualiza el DOM
Livewire.hook("message.processed", () => {
    initialize_copy_buttons();
});

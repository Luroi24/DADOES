<x-app-layout>
    <div class="overflow-auto px-4 sm:px-6 lg:px-8" style="height: calc(100vh - 4.1rem)">
        <div class="w-full h-full py-8 mx-auto sm:px-6 lg:px-8 ">
            <div class="h-full flex overflow-hidden gap-3 sm:rounded-lg">
                <div class="max-w-sm p-6 lg:p-8 bg-white border-2 rounded-lg">
                    <h1 class="mt-8 text-2xl font-medium text-gray-900">
                        ¡Electric sheep!
                    </h1>

                    <p class="mt-6 text-gray-500 leading-relaxed text-justify">
                        <span class="italic font-bold">Do Androids Dream of Electric Sheep?</span> Es una interfaz
                        reimaginada de la célebre harramienta de procesamiento de lenguaje natural "Chat-GPT" creada por
                        OpenAI. El objetivo de esta nueva interfaz es demostrar la habilidad de los desarrolladores por
                        trabajar con herramientas de DevOps para el curso de Softserve "DevOps Crash Course".
                    </p>
                </div>

                <div class="flex-1 flex flex-col border-2 rounded-lg p-6 lg:p-8 gap-4">
                    <div id="chat-messages"
                        class="bg-white border-2 rounded-lg flex flex-col p-4 flex-1 overflow-wrap overflow-y-auto">
                    </div>

                    <div class="bg-white border-2 rounded-lg flex p-4 items-center">

                        <input
                            class="m-0 w-full resize-none border-0 bg-transparent p-0 pr-10 focus:ring-0 focus-visible:ring-0 dark:bg-transparent md:pr-12 pl-3 md:pl-0"
                            placeholder="Type your dream away." type="text" id="message-input"
                            placeholder="Escribe un mensaje..."
                            autofocus>
                        <button class="p-1 h- mr-0 ml-auto mb-0 mt-auto" onclick="sendMessage()">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.0519 14.8285L13.4661 16.2427L17.7088 12L13.4661 7.7574L12.0519 9.17161L13.8804 11H6.34321V13H13.8803L12.0519 14.8285Z"
                                    fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M19.7782 19.7782C24.0739 15.4824 24.0739 8.51759 19.7782 4.22183C15.4824 -0.0739417 8.51759 -0.0739417 4.22183 4.22183C-0.0739417 8.51759 -0.0739417 15.4824 4.22183 19.7782C8.51759 24.0739 15.4824 24.0739 19.7782 19.7782ZM18.364 18.364C21.8787 14.8492 21.8787 9.15076 18.364 5.63604C14.8492 2.12132 9.15076 2.12132 5.63604 5.63604C2.12132 9.15076 2.12132 14.8492 5.63604 18.364C9.15076 21.8787 14.8492 21.8787 18.364 18.364Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendMessage() {
            var message = document.getElementById('message-input').value;
            if (message.trim() !== '') {
                // Agregar el nuevo mensaje al div de mensajes
                var chatMessages = document.getElementById('chat-messages');
                chatMessages.innerHTML += '<p>' + message + '</p>';

                // Almacenar el mensaje en localStorage
                var messages = JSON.parse(localStorage.getItem('chatMessages')) || [];
                messages.push(message);
                localStorage.setItem('chatMessages', JSON.stringify(messages));

                // Limpiar el campo de entrada
                document.getElementById('message-input').value = '';
                
                // Enfocar el input nuevamente
                document.getElementById('message-input').focus();
            }
        }

        // Cargar los mensajes almacenados en localStorage al cargar la página
        window.onload = function() {
            var messages = JSON.parse(localStorage.getItem('chatMessages')) || [];
            var chatMessages = document.getElementById('chat-messages');

            messages.forEach(function(msg) {
                var newMessageDiv = document.createElement('div');
                newMessageDiv.innerHTML = '<p>' + escapeHTML(msg) + '</p>';
                chatMessages.appendChild(newMessageDiv);
            });

            // Hacer scroll hacia abajo para mostrar los mensajes más recientes
            chatMessages.scrollTop = chatMessages.scrollHeight;
        };

        // Función para escapar caracteres especiales en el mensaje
        function escapeHTML(html) {
            return html.replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }
    </script>
</x-app-layout>

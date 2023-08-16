<x-app-layout>
    @livewire('chat')
    <!-- Enlace del icono usado en el botón -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- El script alterna el tema oscuro según las preferencias del usuario o la configuración del sistema -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <script type="application/javascript">
        var chat_scroll = document.getElementById("chat-messages");
        chat_scroll.scrollTop = chat_scroll.scrollHeight;
    </script>
    <!-- El script agrega un botón para copiar la respuesta del chat -->
    <script src="{{ asset('js/copy-response.js') }}" defer></script>
</x-app-layout>
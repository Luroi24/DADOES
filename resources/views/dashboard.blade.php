<x-app-layout>
    @livewire('chat')
    <script type="application/javascript">
        var chat_scroll = document.getElementById("chat-messages");
        chat_scroll.scrollTop = chat_scroll.scrollHeight;
    </script>
</x-app-layout>

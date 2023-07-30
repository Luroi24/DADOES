<div>
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
                    <div id="chat-messages" class="bg-white border-2 rounded-lg flex flex-col p-4 flex-1 overflow-wrap overflow-y-auto">
                        @foreach ($messages as $message)
                            <div class="chat chat-end">
                                <p class="chat-bubble bg-blue-400 bg-opacity-20 mb-3 text-gray-500 dark:text-gray-500 text-right self-end inline-block w-1/2">
                                    {{ $message->content }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-white border-2 rounded-lg flex p-4 items-center">
                        <form class="flex space-x-2 flex-1" wire:submit.prevent="storeData">
                            <textarea
                                class="m-0 w-full resize-none border-0 bg-transparent p-0 pr-10 focus:ring-0 focus-visible:ring-0 dark:bg-transparent md:pr-12 pl-3 md:pl-0 text-gray-500 dark:text-gray-500"
                                placeholder="Type your dream away." id="message-input"
                                autofocus
                                maxlength="8000"
                                wire:model.defer="message"
                                wire:keydown.enter.prevent="submitMessage()"
                            ></textarea>
                            <button class="p-1 h- mr-0 ml-auto mb-0 mt-auto">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="overflow-auto px-4 sm:px-6 lg:px-8" style="height: calc(100vh - 4.1rem)">
        <div class="w-full h-full py-8 mx-auto sm:px-6 lg:px-8 ">
            <div class="h-full flex overflow-hidden gap-3 sm:rounded-lg">
                <div class="max-w-sm p-6 lg:p-8 bg-white dark:border-gray-900 border-2 rounded-lg flex-1 flex flex-col hidden sm:flex dark:bg-gray-700">
                    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                        ¡DADOES!
                    </h1>

                    <p class="mt-6 text-gray-500 leading-relaxed text-justify dark:text-white">
                        <span class="italic font-bold">Do Androids Dream of Electric Sheep?</span> Es una interfaz
                        reimaginada de la célebre herramienta de procesamiento de lenguaje natural "Chat-GPT" creada por
                        OpenAI. El objetivo de esta nueva interfaz es demostrar la habilidad de los desarrolladores para
                        trabajar con herramientas de DevOps para el curso de SoftServe "DevOps Crash Course".
                        Si desea encontrar un mensaje en específico que haya envíado, intente ingresando una palabra clave
                        en el siguiente apartado.
                    </p>
                    <div class="relative mt-2">
                        <input type="search" id="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-search focus:ring-blue-500 focus:border-blue-500" placeholder="Busque un mensaje..." wire:model="search">
                    </div>
                </div>


                <div class="flex-1 flex flex-col border-2 dark:border-gray-900 rounded-lg p-6 lg:p-8 gap-4 bg-frame bg-opacity-90 dark:bg-opacity-80">
                    <div id="chat-messages" class="scrollbar scrollbar-thumb-scrollBar scrollbar-track-gray-400 scrollbar-thumb-rounded-full scrollbar-track-rounded-full bg-white border-2 dark:border-gray-900 rounded-lg flex flex-col p-4 flex-1 overflow-wrap overflow-y-auto dark:bg-gray-700">
                        @forelse ($messages as $message)
                        <div class="chat chat-end">
                            <p class="chat-bubble bg-messageBubble mb-3 text-gray-500 dark:text-black">
                                {{ $message->content }}
                            </p>
                        </div>
                        <div class="chat chat-start">
                            <p class="chat-bubble bg-responseBubble bg-opacity-70 dark:bg-white mb-3 text-gray-700 dark:text-black">
                                {{ $message->response->content }}
                            </p>
                        </div>
                        @empty
                        <div>
                            <p class="mb-3 text-gray-700 dark:text-gray-700">
                                Este mensaje no existe
                            </p>
                        </div>
                        @endforelse
                    </div>

                    <div class="bg-white dark:bg-gray-700 border-2 dark:border-gray-900 rounded-lg flex p-4 items-center">
                        <form class="flex space-x-2 flex-1" wire:submit.prevent="storeData">
                            <textarea class="scrollbar-thin scrollbar-thumb-scrollBar scrollbar-track-gray-400 scrollbar-thumb-rounded-full scrollbar-track-rounded-full m-0 w-full resize-none border-0 dark:border-gray-700 bg-search p-0 pr-10 focus:ring-0 focus-visible:ring-0 dark:bg-gray-700 md:pr-12 pl-3 md:pl-0 text-gray-500 dark:text-white" placeholder="Type your dream away." id="input-message" name="input-message" autofocus maxlength="300" wire:model.defer="message"></textarea>
                            <x-input-error for="message"></x-input-error>
                            <x-input-error for="response"></x-input-error>
                            <button class="p-1 h- mr-0 ml-auto mb-0 mt-auto" wire:loading.attr="disabled">
                                <svg wire:loading.remove wire:target="storeData" class="stroke-slate-700" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.0519 14.8285L13.4661 16.2427L17.7088 12L13.4661 7.7574L12.0519 9.17161L13.8804 11H6.34321V13H13.8803L12.0519 14.8285Z" fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M19.7782 19.7782C24.0739 15.4824 24.0739 8.51759 19.7782 4.22183C15.4824 -0.0739417 8.51759 -0.0739417 4.22183 4.22183C-0.0739417 8.51759 -0.0739417 15.4824 4.22183 19.7782C8.51759 24.0739 15.4824 24.0739 19.7782 19.7782ZM18.364 18.364C21.8787 14.8492 21.8787 9.15076 18.364 5.63604C14.8492 2.12132 9.15076 2.12132 5.63604 5.63604C2.12132 9.15076 2.12132 14.8492 5.63604 18.364C9.15076 21.8787 14.8492 21.8787 18.364 18.364Z" fill="currentColor" />
                                </svg>
                                <svg wire:loading wire:target="storeData" aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
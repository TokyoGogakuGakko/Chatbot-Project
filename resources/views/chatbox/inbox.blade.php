<div x-data="chatbox" class="relative chat-area flex-1 flex flex-col">
    <div class="flex-3">
        <h2 class="text-xl py-1 mb-8 border-b-2 border-gray-200">Chatting with <b>Bot</b></h2>
    </div>
    @if(!is_null($selectedConversationId))
        <div x-show="!(messages?.length > 0)"
             class="absolute inset-0 bg-gray-100/50 z-10 flex items-center justify-center">
            <button @click="startConversation()"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <span x-cloak x-show="isChatting">Stating...</span>
                <span x-show="!isChatting">Start Interview</span>
            </button>
        </div>
        <div id="messages" class="messages flex-1 min-h-[calc(100dvh-220px)] max-h-[calc(100dvh-220px)] overflow-auto">

            {{--  Messages --}}
            <template x-for="message in messages" :key="message.id">
                <div class="message">
                    {{-- Bot Message --}}
                    <template x-if="message.user_type == 'bot'">
                        <div class="message mb-4 flex">
                            {{--                        <div class="flex-2">--}}
                            {{--                            <div class="w-12 h-12 relative">--}}
                            {{--                                <img class="w-12 h-12 rounded-full mx-auto"--}}
                            {{--                                     src="../resources/profile-image.png" alt="chat-user"/>--}}
                            {{--                                <span--}}
                            {{--                                    class="absolute w-4 h-4 bg-gray-400 rounded-full right-0 bottom-0 border-2 border-white"></span>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                            <div class="flex-1 px-2">
                                <div class="inline-block bg-gray-300 rounded-sm p-2 px-6 text-gray-700">
                                    <span x-text="message.message"></span>
                                </div>
                                <div class="pl-4"><small class="text-gray-500"
                                                         x-text="dayjs(message.created_at).format('DD MMM')"></small>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- User Message --}}
                    <template x-if="message.user_type == 'user'">
                        <div class="message me mb-4 flex text-right">
                            <div class="flex-1 px-2">
                                <div class="inline-block bg-blue-600 rounded-sm p-2 px-6 text-white">
                                    <span x-text="message.message"></span>
                                </div>
                                <div class="pr-4"><small class="text-gray-500"
                                                         x-text="dayjs(message.created_at).format('DD MMM')"></small>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>

        <div class="flex-2 pt-4 pb-10">
            <div class="flex-1 text-center mb-3" x-show="isTyping"><span class="text-gray-400">Bot is typing...</span>
            </div>
            <div class="write bg-white shadow flex rounded-lg">
                <div class="flex-3 flex content-center items-center text-center p-4 pr-0">
                    <span class="block text-center text-gray-400 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z"/>
                        </svg>
                    </span>
                </div>
                <div class="flex-1">
                    <textarea x-autosize x-model="message" name="message"
                              class="w-full block outline-none py-4 px-4 bg-transparent" rows="1"
                              placeholder="Type a message..." autofocus></textarea>
                </div>
                <div class="flex-2 w-32 p-2 flex content-center items-center">

                    <div class="flex-1">
                        <button @click="chat" class="bg-blue-400 w-10 h-10 rounded-full inline-block">
                            <span class="inline-block align-text-bottom">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                     stroke-linejoin="round" stroke-width="2"
                                     viewBox="0 0 24 24" class="w-4 h-4 text-white">
                                    <path d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex-3 text-center"><span class="text-gray-400">Please select a chat</span></div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('chatbox', () => ({
                message: '',
                selectedConversationId: @js($selectedConversationId),
                messages: @js($chats),
                isChatting: false,
                isTyping: false,
                init() {
                    this.scrollToBottom();
                },
                startConversation() {
                    this.isChatting = true
                    axios.post('{{route('chat.start')}}', {
                        conversation_id: this.selectedConversationId
                    }).then(response => {
                        this.messages = response.data?.chats
                    }).finally(() => {
                        this.isChatting = false
                    })
                },
                chat() {
                    const message = this.message;
                    const fakeChat = {
                        id: Math.floor(Math.random() * 1000),
                        conversation_id: this.selectedConversationId,
                        created_at: dayjs().toDate(),
                        updated_at: dayjs().toDate(),
                        message,
                        user_type: 'user',
                    }
                    this.messages.push(fakeChat)
                    this.isTyping = true
                    this.message = ''
                    axios.post('{{route('chat.store')}}', {
                        message,
                        conversation_id: (this.selectedConversationId)
                    }).then(response => {
                        this.messages = response.data?.chats
                        this.scrollToBottom()
                    }).catch(err => {
                        this.message = this.messages.pop().message
                        toast('Something went wrong', {type: 'danger'})
                    }).finally(() => {
                        this.isTyping = false
                    })
                },
                scrollToBottom() {
                    setTimeout(() => {
                        document.getElementById('messages').scrollTop = document.getElementById('messages').scrollHeight
                    })
                }
            }))
        })
    </script>
@endpush

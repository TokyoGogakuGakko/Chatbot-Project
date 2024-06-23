@props(['selectedConversationId', 'conversations'])

<div x-data="conversations">
    <template x-for="conversation in conversations" :key="conversation.id">
        <div
            class="entry cursor-pointer transform hover:scale-105 duration-300 transition-transform bg-white mb-4 rounded p-4 flex shadow-md"
            :class="{'border-l-4 border-green-500' : selectedConversationId == conversation.id}"
            @click="window.location = '{{route('chat')}}?conversationId=' + conversation.id"
        >
            <div class="flex-2">
{{--                <div class="w-12 h-12 relative">--}}
{{--                    <img class="w-12 h-12 rounded-full mx-auto" :src="conversation.logo" :alt="conversation.name"/>--}}
{{--                    <span--}}
{{--                        class="absolute w-4 h-4 rounded-full right-0 bottom-0 border-2 border-white"--}}
{{--                        :class="{'bg-gray-400' : selectedConversationId != conversation.id, 'bg-green-500' : selectedConversationId == conversation.id}"--}}
{{--                    ></span>--}}
{{--                </div>--}}
            </div>
            <div class="flex-1 px-2">
                <div class="truncate">
                    <span class="text-gray-800" x-text="conversation.name"></span>
                </div>
                <div>
                    <small class="text-gray-600 line-clamp-1" x-text="conversation.description"></small>
                </div>
            </div>
            <div class="flex-2 text-right">
                <div><small class="text-gray-500">15 April</small></div>
            </div>
        </div>
    </template>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('conversations', () => ({
                conversations: @js($conversations),
                selectedConversationId: @js($selectedConversationId),
                init() {
                    console.log(this.conversations)
                },
            }))
        })
    </script>
@endpush

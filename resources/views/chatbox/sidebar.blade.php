<div class="sidebar hidden lg:flex w-1/3 flex-2 flex-col pr-6">
    <div class="search flex-2 pb-6 px-2">
        <input type="text"
               class="outline-none py-2 block w-full bg-transparent border-b-2 border-gray-200"
               placeholder="Search">
    </div>

    <div class="flex-1 overflow-auto px-2">
        <x-conversations :conversations="$conversations" :selected-conversation-id="$selectedConversationId"  />
    </div>
</div>

<div class="chat-area flex-1 flex flex-col">
    <div class="flex-3">
        <h2 class="text-xl py-1 mb-8 border-b-2 border-gray-200">Chatting with <b>Mercedes
                Yemelyan</b></h2>
    </div>
    @if(!is_null($selectedJobId))
        <div class="messages flex-1 overflow-auto">
            <div class="message mb-4 flex">
                <div class="flex-2">
                    <div class="w-12 h-12 relative">
                        <img class="w-12 h-12 rounded-full mx-auto"
                             src="../resources/profile-image.png" alt="chat-user"/>
                        <span
                            class="absolute w-4 h-4 bg-gray-400 rounded-full right-0 bottom-0 border-2 border-white"></span>
                    </div>
                </div>
                <div class="flex-1 px-2">
                    <div class="inline-block bg-gray-300 rounded-full p-2 px-6 text-gray-700">
                        <span>Hey there. We would like to invite you over to our office for a visit. How about it?</span>
                    </div>
                    <div class="pl-4"><small class="text-gray-500">15 April</small></div>
                </div>
            </div>
            <div class="message mb-4 flex">
                <div class="flex-2">
                    <div class="w-12 h-12 relative">
                        <img class="w-12 h-12 rounded-full mx-auto"
                             src="../resources/profile-image.png" alt="chat-user"/>
                        <span
                            class="absolute w-4 h-4 bg-gray-400 rounded-full right-0 bottom-0 border-2 border-white"></span>
                    </div>
                </div>
                <div class="flex-1 px-2">
                    <div class="inline-block bg-gray-300 rounded-full p-2 px-6 text-gray-700">
                        <span>All travel expenses are covered by us of course :D</span>
                    </div>
                    <div class="pl-4"><small class="text-gray-500">15 April</small></div>
                </div>
            </div>
            <div class="message me mb-4 flex text-right">
                <div class="flex-1 px-2">
                    <div class="inline-block bg-blue-600 rounded-full p-2 px-6 text-white">
                        <span>It's like a dream come true</span>
                    </div>
                    <div class="pr-4"><small class="text-gray-500">15 April</small></div>
                </div>
            </div>
            <div class="message me mb-4 flex text-right">
                <div class="flex-1 px-2">
                    <div class="inline-block bg-blue-600 rounded-full p-2 px-6 text-white">
                        <span>I accept. Thank you very much.</span>
                    </div>
                    <div class="pr-4"><small class="text-gray-500">15 April</small></div>
                </div>
            </div>
            <div class="message mb-4 flex">
                <div class="flex-2">
                    <div class="w-12 h-12 relative">
                        <img class="w-12 h-12 rounded-full mx-auto"
                             src="../resources/profile-image.png" alt="chat-user"/>
                        <span
                            class="absolute w-4 h-4 bg-gray-400 rounded-full right-0 bottom-0 border-2 border-white"></span>
                    </div>
                </div>
                <div class="flex-1 px-2">
                    <div class="inline-block bg-gray-300 rounded-full p-2 px-6 text-gray-700">
                        <span>You are welome. We will stay in touch.</span>
                    </div>
                    <div class="pl-4"><small class="text-gray-500">15 April</small></div>
                </div>
            </div>
        </div>
        <div class="flex-2 pt-4 pb-10">
            <div class="write bg-white shadow flex rounded-lg">
                <div class="flex-3 flex content-center items-center text-center p-4 pr-0">
                                            <span class="block text-center text-gray-400 hover:text-gray-800">
                                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                     stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"
                                                     class="h-6 w-6"><path
                                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </span>
                </div>
                <div class="flex-1">
                                        <textarea name="message"
                                                  class="w-full block outline-none py-4 px-4 bg-transparent" rows="1"
                                                  placeholder="Type a message..." autofocus></textarea>
                </div>
                <div class="flex-2 w-32 p-2 flex content-center items-center">
                    <div class="flex-1 text-center">
                                                <span class="text-gray-400 hover:text-gray-800">
                                                    <span class="inline-block align-text-bottom">
                                                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                             stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"
                                                             class="w-6 h-6"><path
                                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                                    </span>
                                                </span>
                    </div>
                    <div class="flex-1">
                        <button class="bg-blue-400 w-10 h-10 rounded-full inline-block">
                                                    <span class="inline-block align-text-bottom">
                                                        <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                             stroke-linejoin="round" stroke-width="2"
                                                             viewBox="0 0 24 24" class="w-4 h-4 text-white"><path
                                                                d="M5 13l4 4L19 7"></path></svg>
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

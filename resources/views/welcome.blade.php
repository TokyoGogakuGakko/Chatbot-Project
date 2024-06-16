<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voice-to-Voice Chat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<div class="container mx-auto mt-10" x-data="voiceChat">
    <h1 class="text-2xl font-bold text-center mb-6">Voice-to-Voice Chat</h1>
    <div class="flex">
        <div class="w-1/2 pr-4">
            <div id="recordingControls" class="mb-4">
                <button @click="startRecording" :disabled="isRecording"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Start Recording
                </button>
                <button @click="stopRecording" :disabled="!isRecording"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Stop Recording
                </button>
            </div>
            <form @submit.prevent="submitChat" enctype="multipart/form-data" id="chatForm">
                @csrf
                <div class="mb-4">
                    <label for="audioInput" class="block text-gray-700 font-bold mb-2">Upload Audio (optional):</label>
                    <input type="file" class="form-control-file" id="audioInput" name="audioInput" x-ref="audioInput">
                </div>
                <div class="mb-4">
                    <label for="textInput" class="block text-gray-700 font-bold mb-2">Or Type Text:</label>
                    <textarea
                        class="form-control w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:shadow-outline"
                        id="textInput" name="textInput" x-model="textInput"></textarea>
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Send
                </button>
            </form>
        </div>
        <div class="w-1/2 pl-4">
            <div id="chatHistory" class="bg-white p-4 rounded-lg shadow" x-html="chatHistoryHTML"></div>
            <div id="loadingSpinner" class="text-center mt-4" x-show="isLoading" role="status">
                <svg aria-hidden="true"
                     class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                     viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor"/>
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('voiceChat', () => ({
            isRecording: false,
            textInput: '',
            chatHistoryHTML: '',
            isLoading: false,
            mediaRecorder: null,
            audioChunks: [],
            stream: null,
            init() {
                console.log()
            },
            startRecording() {
                navigator.mediaDevices.getUserMedia({audio: true})
                    .then(stream => {
                        this.stream = stream;
                        this.mediaRecorder = new MediaRecorder(stream);
                        this.mediaRecorder.start();
                        this.isRecording = true;

                        this.mediaRecorder.ondataavailable = event => {
                            this.audioChunks.push(event.data);
                        };

                        this.mediaRecorder.onstop = () => {
                            const audioBlob = new Blob(this.audioChunks, {type: 'audio/mpeg'});
                            this.audioChunks = [];
                            const audioFile = new File([audioBlob], 'recording.mp3', {type: 'audio/mpeg'});

                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(audioFile);
                            this.$refs.audioInput.files = dataTransfer.files;
                        };
                    })
                    .catch(err => {
                        console.error('Error accessing microphone:', err);
                    });
            },

            stopRecording() {
                if (this.mediaRecorder && this.mediaRecorder.state !== 'inactive') {
                    this.mediaRecorder.stop();
                    this.stream.getTracks().forEach(track => track.stop());
                }
                this.isRecording = false;
            },

            submitChat() {
                const formData = new FormData(this.$refs.chatForm);

                if (this.$refs.audioInput.files.length > 0 || this.textInput) {
                    this.isLoading = true;

                    fetch('{{ route('chat.store') }}', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            this.updateChatHistory(data);
                            this.textInput = '';
                            this.$refs.audioInput.value = '';
                            this.isLoading = false;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            this.isLoading = false;
                        });
                }
            },

            updateChatHistory(data) {
                const userMessage = data.user_audio_url
                    ? `<div class="bg-blue-100 p-2 rounded mb-2">
                            <strong class="text-gray-800">You:</strong><br>
                            <em>(Voice Recording)</em>:<br>
                            <audio controls src="${data.user_audio_url}"></audio><br>
                            <strong>Transcribed Text:</strong> ${data.user_input}
                           </div>`
                    : `<div class="bg-blue-100 p-2 rounded mb-2">
                            <strong class="text-gray-800">You:</strong> ${this.textInput || '<em>(Voice Recording)</em>'}
                           </div>`;

                const aiResponse = `<div class="bg-green-100 p-2 rounded mb-2">
                                         <strong class="text-gray-800">AI:</strong> ${data.ai_response}
                                         <audio controls src="${data.audio_url}"></audio>
                                        </div>`;

                this.chatHistoryHTML += userMessage + aiResponse;
            }
        }))
    })
</script>


</body>
</html>

class VoiceRecorder {
    constructor() {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            console.log("getUserMedia supported");
        } else {
            console.log("getUserMedia is not supported on your browser!");
        }

        this.mediaRecorder;
        this.stream;
        this.chunks = [];
        this.isRecording = false;

        this.recorderRef = document.querySelector("#recorder");
        this.playerRef = document.querySelector("#player");
        this.startRef = document.querySelector("#start");
        this.stopRef = document.querySelector("#stop");
        this.sendRef = document.querySelector("#send");

        this.startRef.onclick = this.startRecording.bind(this);
        this.stopRef.onclick = this.stopRecording.bind(this);
        this.sendRef.onclick = this.sendRecording.bind(this);

        this.constraints = {
            audio: true,
            video: false
        };
    }

    handleSuccess(stream) {
        this.stream = stream;
        this.stream.oninactive = () => {
            console.log("Stream ended!");

            $('.recording-result').removeClass('d-none');

            $('#start').addClass('d-none');
            $('#stop').addClass('d-none');
            $('#stop').addClass('d-none');
        };
        this.recorderRef.srcObject = this.stream;
        this.mediaRecorder = new MediaRecorder(this.stream);
        console.log(this.mediaRecorder);
        this.mediaRecorder.ondataavailable = this.onMediaRecorderDataAvailable.bind(this);
        this.mediaRecorder.onstop = this.onMediaRecorderStop.bind(this);
        this.recorderRef.play();
        this.mediaRecorder.start();
    }

    handleError(error) {
        console.log("navigator.getUserMedia error: ", error);
    }

    onMediaRecorderDataAvailable(e) {
        this.chunks.push(e.data);
    }

    onMediaRecorderStop(e) {
        const blob = new Blob(this.chunks, { 'type': 'audio/ogg; codecs=opus' });
        const audioURL = window.URL.createObjectURL(blob);
        this.playerRef.src = audioURL;
        this.chunks = [];
        this.stream.getAudioTracks().forEach(track => track.stop());
        this.stream = null;
        this.blob = blob; // Store the blob for sending later
    }

    sendRecording() {
        if (!this.blob) return;

        // Prepare the form data
        const formData = new FormData();
        formData.append('audio', this.blob, 'recording.mp3');
        formData.append('current_date', current_date);
        
        // Get the CSRF token from the meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Send the audio blob using AJAX
        fetch('/complaint-audio', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {

            console.log(data);

            if(data.success == true){
                $('.complain-audio').addClass('d-none');
                $('#send').addClass('d-none');
                $('#cancle').addClass('d-none');
                $('#start').removeClass('d-none');
                $('#stop').addClass('d-none');

                retriveComplainList();

                Swal.fire({
                    title: "Complain Send Success !",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "OK",
                });
            }

        })
        .catch(error => {
            console.error('Error uploading audio:', error);
        });
    }

    startRecording() {
        if (this.isRecording) return;
        $('#stop').removeClass('d-none');
        $('#start').addClass('d-none');
        this.isRecording = true;
        this.playerRef.src = '';
        navigator.mediaDevices
            .getUserMedia(this.constraints)
            .then(this.handleSuccess.bind(this))
            .catch(this.handleError.bind(this));
    }

    stopRecording() {
        if (!this.isRecording) return;
        this.isRecording = false;
        this.recorderRef.pause();
        this.mediaRecorder.stop();
    }
}
window.voiceRecorder = new VoiceRecorder();

$(document).ready(function(){
    $('#cancle').click(function(){

            $('.recording-result').addClass('d-none');

            $('#start').removeClass('d-none');
            $('#stop').addeClass('d-none');
    });
});
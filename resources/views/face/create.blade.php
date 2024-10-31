<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cadastro</title>
    <style>
        h1,
        a {
            font-family: sans-serif;
            color: #333;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        #container {
            position: relative;
            margin: 0px auto;
            width: 500px;
            height: 375px;
            border: 10px #333 solid;
        }

        #videoElement {
            width: 100%;
            height: 100%;
            background-color: #666;
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        #registerButton {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <a href="/dashboard">Voltar</a>
    <h1>Cadastro de face</h1>
    <div id="container">
        <video autoplay="true" id="videoElement"></video>
    </div>
    <button id="registerButton">Cadastrar Rosto</button>

    <script src="/js/face-api.min.js"></script>


    <script>
        const video = document.getElementById('videoElement');
        const container = document.getElementById('container');
        const registerButton = document.getElementById('registerButton');
        let canvas;
        let faceData = null;

        async function loadModels() {
            try {
                await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
                await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
                await faceapi.nets.faceRecognitionNet.loadFromUri('/models');
                console.log("Modelos carregados com sucesso");
            } catch (error) {
                console.error("Erro ao carregar modelos:", error);
                alert(
                    "Erro ao carregar modelos. Verifique se os modelos estão na pasta correta e recarregue a página."
                );
            }
        }

        async function startVideo() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                video.srcObject = stream;
            } catch (error) {
                console.error("Erro ao acessar a câmera:", error);
                alert("Erro ao acessar a câmera. Verifique as permissões e o console para mais detalhes.");
            }
        }

        video.addEventListener('loadedmetadata', () => {
            console.log('Largura do vídeo:', video.videoWidth);
            console.log('Altura do vídeo:', video.videoHeight);
        });

        video.addEventListener('play', async () => {
            canvas = faceapi.createCanvasFromMedia(video);
            container.append(canvas);
            const displaySize = {
                width: video.videoWidth,
                height: video.videoHeight
            };

            if (displaySize.width > 0 && displaySize.height > 0) {
                faceapi.matchDimensions(canvas, displaySize);

                setInterval(async () => {
                    const detections = await faceapi
                        .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
                        .withFaceLandmarks()
                        .withFaceDescriptor();

                    if (detections) {
                        faceData = detections;
                        const resizedDetections = faceapi.resizeResults(detections, displaySize);
                        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
                        faceapi.draw.drawDetections(canvas, resizedDetections);
                        faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
                    }
                }, 100);
            } else {
                console.error('Dimensões inválidas do vídeo:', displaySize);
            }
        });

        registerButton.addEventListener('click', async () => {
            if (!faceData) {
                alert("Nenhum rosto detectado. Tente novamente.");
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch('/face/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        descriptor: faceData
                            .descriptor
                    }),
                });

                if (response.ok) {
                    alert("Rosto cadastrado com sucesso!");
                } else {
                    alert("Erro ao cadastrar o rosto.");
                }
            } catch (error) {
                console.error("Erro ao enviar os dados do rosto:", error);
                alert("Erro ao cadastrar o rosto. Verifique o console para mais detalhes.");
            }
        });


        loadModels().then(startVideo);
    </script>
</body>

</html>

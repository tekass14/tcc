@extends('layouts.app')

@section('body')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="d-flex justify-content-center align-items-center flex-column">
        <h1 class="page-title text-gray-900"> Atualizar Face </h1> <br>
        <!-- Container para vídeo e detecção -->
        <div id="container" class="position-relative">
            <video autoplay="true" id="videoElement" class="rounded shadow"></video>
            <canvas id="detectionCanvas" class="position-absolute"></canvas>
        </div>
        <div class="d-flex mt-4">
            <button id="registerButton" class="btn btn-primary mr-3">Atualizar</button>
            <button onclick="window.history.back()" class="btn btn-primary ml-3">
                Voltar
            </button>
        </div>
    </div>

    <script src="/js/face-api.min.js"></script>

    <script>
        const video = document.getElementById('videoElement');
        const detectionCanvas = document.getElementById('detectionCanvas');
        const container = document.getElementById('container');
        const registerButton = document.getElementById('registerButton');
        let faceData = null;

        async function loadModels() {
            try {
                await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
                await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
                await faceapi.nets.faceRecognitionNet.loadFromUri('/models');
                console.log("Modelos carregados com sucesso");
            } catch (error) {
                console.error("Erro ao carregar modelos:", error);
                alert("Erro ao carregar modelos. Verifique se estão na pasta correta.");
            }
        }

        async function startVideo() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                video.srcObject = stream;

                video.addEventListener('loadedmetadata', () => {
                    setupCanvas();
                    detectFaces();
                });
            } catch (error) {
                console.error("Erro ao acessar a câmera:", error);
                alert("Erro ao acessar a câmera. Verifique as permissões.");
            }
        }

        function setupCanvas() {
            const videoWidth = video.videoWidth;
            const videoHeight = video.videoHeight;

            // Ajustar dimensões do canvas para corresponder ao vídeo
            detectionCanvas.width = videoWidth;
            detectionCanvas.height = videoHeight;

            // Ajustar dimensões do container
            container.style.width = `${videoWidth}px`;
            container.style.height = `${videoHeight}px`;

            // Garantir que o canvas cobre o vídeo completamente
            detectionCanvas.style.width = "100%";
            detectionCanvas.style.height = "100%";
        }

        async function detectFaces() {
            const displaySize = {
                width: video.videoWidth,
                height: video.videoHeight
            };
            faceapi.matchDimensions(detectionCanvas, displaySize);

            setInterval(async () => {
                const detections = await faceapi
                    .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
                    .withFaceLandmarks()
                    .withFaceDescriptor();

                if (detections) {
                    faceData = detections;
                    const resizedDetections = faceapi.resizeResults(detections, displaySize);

                    const ctx = detectionCanvas.getContext('2d');
                    ctx.clearRect(0, 0, detectionCanvas.width, detectionCanvas.height);

                    faceapi.draw.drawDetections(detectionCanvas, resizedDetections);
                    faceapi.draw.drawFaceLandmarks(detectionCanvas, resizedDetections);
                }
            }, 100);
        }

        registerButton.addEventListener('click', async () => {
            if (!faceData) {
                alert("Nenhum rosto detectado. Tente novamente.");
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch('/face/update/ {{ auth()->user()->face_id }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        descriptor: faceData.descriptor
                    }),
                });

                if (response.ok) {
                    alert("Rosto atualizado com sucesso!");
                    window.location.href = "/dashboard";
                } else {
                    alert("Erro ao cadastrar o rosto.");
                }
            } catch (error) {
                console.error("Erro ao enviar os dados do rosto:", error);
                alert("Erro ao cadastrar. Verifique o console.");
            }
        });

        loadModels().then(startVideo);
    </script>

    <style>
        #container {
            position: relative;
            margin: 0 auto;
            border: 2px solid #333;
        }

        video {
            display: block;
            width: 100%;
            height: auto;
            background-color: #666;
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 10;
        }

        .btn-primary {
            font-size: 18px;
            padding: 10px 20px;
        }
    </style>
@endsection

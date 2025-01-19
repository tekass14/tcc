@extends('layouts.guest')

@section('header')
    Login com Face
@endsection

@section('body')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="page my-auto">
        <div class="container py-4">
            <div class="card card-md">
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <h1 class="page-title text-gray-900 mt-4"> Login com Face </h1> <br>
                    <!-- Container para vídeo e detecção -->
                    <div id="container" class="position-relative">
                        <video autoplay="true" id="videoElement" class="rounded shadow"></video>
                        <canvas id="detectionCanvas" class="position-absolute"></canvas>
                    </div>
                    <div class="d-flex mt-4 mb-4">
                        <button id="loginButton" class="btn btn-primary mr-3">Logar</button>
                        <button onclick="window.history.back()" class="btn btn-primary ml-3">
                            Voltar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/face-api.min.js"></script>

    <script>
        const video = document.getElementById('videoElement');
        const detectionCanvas = document.getElementById('detectionCanvas');
        const container = document.getElementById('container');
        const loginButton = document.getElementById('loginButton');
        let faceData = null;

        async function loadModels() {
            try {
                console.log("Iniciando o carregamento dos modelos...");
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
                console.log("Tentando acessar a câmera...");
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                video.srcObject = stream;

                video.addEventListener('loadedmetadata', () => {
                    console.log("Câmera acessada com sucesso. Configurando canvas...");
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

            console.log("Dimensões do vídeo:", videoWidth, "x", videoHeight);

            // Ajustar dimensões do canvas para corresponder ao vídeo
            detectionCanvas.width = videoWidth;
            detectionCanvas.height = videoHeight;

            // Ajustar dimensões do container
            container.style.width = `${videoWidth}px`;
            container.style.height = `${videoHeight}px`;

            // Garantir que o canvas cobre o vídeo completamente
            detectionCanvas.style.width = "100%";
            detectionCanvas.style.height = "100%";

            console.log("Canvas configurado com sucesso.");
        }

        async function detectFaces() {
            console.log("Iniciando detecção de rostos...");
            const displaySize = {
                width: video.videoWidth,
                height: video.videoHeight
            };
            faceapi.matchDimensions(detectionCanvas, displaySize);

            setInterval(async () => {
                try {
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
                    } else {
                        console.log("Nenhum rosto detectado.");
                    }
                } catch (error) {
                    console.error("Erro durante a detecção de rostos:", error);
                }
            }, 100);
        }

        loginButton.addEventListener('click', async () => {
            if (!faceData) {
                alert("Nenhum rosto detectado. Tente novamente.");
                console.log("Tentativa de login sem rosto detectado.");
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                console.log("Enviando dados do rosto para o servidor...");
                const response = await fetch('/face/login', {
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
                    console.log("Login bem-sucedido. Redirecionando para o dashboard...");
                    window.location.href = "/dashboard";
                } else {
                    console.warn("Falha no login. Rosto não reconhecido.");
                    alert("Rosto não reconhecido. Tente novamente.");
                }
            } catch (error) {
                console.error("Erro ao enviar os dados do rosto:", error);
                alert("Erro ao realizar login. Verifique o console para mais detalhes.");
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

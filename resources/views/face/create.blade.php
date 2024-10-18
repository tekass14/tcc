<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro</title>
</head>
<style>
    h1,a{
        font-family: sans-serif;
        color: #333;
    }
    body{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column
        
    }

    #videoElement{
        width: 500px;
        height: 375px;
        background-color: #666;
    }

    #container{
        margin: 0px auto;
        width: 500px;
        height: 375px;
        border: 10px #333 solid;
    }

</style>
<body>

    <a href="/dashboard">Voltar</a>

    <h1>Cadastro de face</h1>
    <div id="container">
        <video autoplay="true" id="videoElement">

        </video>
    </div>

    <script>
        let video = document.querySelector("#videoElement");

        if(navigator.mediaDevices.getUserMedia) {
           navigator.mediaDevices.getUserMedia( {video:true})
            .then(function(stream){
                video.srcObject = stream;
            })
            .catch (function (error){
                console.log("Algo deu errado");
            })
        } else{
            console.log("getUserMedia não suportado!");
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generando Recibo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            padding-top: 100px;
        }

        .progress-container {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .progress-text {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .progress-bar-container {
            width: 100%;
            height: 20px;
            background-color: #e0e0e0;
            border-radius: 10px;
            position: relative;
        }

        .progress-bar {
            width: 0;
            height: 100%;
            background-color: #007bff;
            border-radius: 10px;
            position: absolute;
            transition: width 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="progress-container">
        <p class="progress-text">Generando recibo, espere por favor...</p>
        <div class="progress-bar-container">
            <div class="progress-bar" id="progress-bar"></div>
        </div>
    </div>

    <script>
        // Simula la barra de progreso
        let progress = 0;
        const progressBar = document.getElementById('progress-bar');

        function updateProgressBar() {
            if (progress <= 100) {
                progressBar.style.width = progress + '%';
                progress++;
                setTimeout(updateProgressBar, 50); // Ajusta la velocidad de la barra de progreso
            } else {
                // Redirige automáticamente a la vista del recibo
                window.location.href = '/caja/cobros/' + {{ $id_cobro }} + '/recibo';
            }
        }

        // Inicia la actualización de la barra de progreso
        updateProgressBar();
    </script>
</body>
</html>
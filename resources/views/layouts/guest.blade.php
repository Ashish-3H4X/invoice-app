<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Invoice System' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            /* Light pastel gradient */
            background: linear-gradient(135deg, #f0f4ff, #ffffff, #e3ecff);
            background-size: 300% 300%;
            animation: bgMove 10s infinite ease-in-out;

            font-family: 'Inter', sans-serif;
        }

        @keyframes bgMove {
            0% { background-position: 0% 0%; }
            50% { background-position: 100% 100%; }
            100% { background-position: 0% 0%; }
        }

        .wrapper {
            width: 100%;
            max-width: 420px;
            padding: 30px;
            border-radius: 16px;

            /* Light glassmorphism */
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(200, 200, 200, 0.4);
            backdrop-filter: blur(12px);

            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0px); }
        }
    </style>
</head>

<body>

<div class="wrapper">
    {{ $slot }}
</div>

</body>
</html>

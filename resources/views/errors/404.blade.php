<!DOCTYPE html>
<html lang="nl" style="height:100%;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina niet gevonden — DevAim Labs</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,600,700" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100%;
            background: #0A0C10;
            color: #F1F4F8;
            font-family: 'Space Grotesk', ui-sans-serif, system-ui, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .container {
            text-align: center;
            max-width: 480px;
        }

        .code {
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: #17C7BC;
            margin-bottom: 1rem;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #F1F4F8;
            margin-bottom: 1rem;
            line-height: 1.15;
        }

        p {
            font-size: 0.9rem;
            color: #8D96A6;
            line-height: 1.7;
            margin-bottom: 2.5rem;
        }

        .links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            color: #08201E;
            background: #17C7BC;
            padding: 0.65rem 1.25rem;
            border-radius: 6px;
            transition: opacity 0.2s;
        }
        .btn-primary:hover { opacity: 0.9; }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            color: #17C7BC;
            border: 1px solid rgba(23,199,188,0.3);
            padding: 0.6rem 1.25rem;
            border-radius: 6px;
            transition: border-color 0.2s, background 0.2s;
        }
        .btn-outline:hover {
            border-color: rgba(23,199,188,0.55);
            background: rgba(23,199,188,0.08);
        }
    </style>
</head>
<body>
    <div class="container">
        <p class="code">404</p>
        <h1>Deze pagina bestaat niet (meer).</h1>
        <p>De link klopt niet, of de pagina is verplaatst. Ga terug naar home, of bekijk direct wat we bouwen.</p>

        <div class="links">
            <a href="/" class="btn-primary">← Terug naar home</a>
            <a href="/diensten" class="btn-outline">Bekijk diensten</a>
            <a href="/contact" class="btn-outline">Neem contact op</a>
        </div>
    </div>
</body>
</html>

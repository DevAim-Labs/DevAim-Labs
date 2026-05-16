<!DOCTYPE html>
<html lang="en" style="height:100%;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance — DevAim Labs</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,600,700" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100%;
            background: #141414;
            color: #f0f0f0;
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

        .icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            border: 1px solid rgba(11,133,152,0.3);
            background: rgba(11,133,152,0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            box-shadow:
                0 0 0 1px rgba(11,133,152,0.18),
                0 0 28px rgba(11,133,152,0.10);
        }

        .icon svg {
            width: 28px;
            height: 28px;
            color: #0B8598;
        }

        .eyebrow {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #0B8598;
            margin-bottom: 1rem;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #f0f0f0;
            margin-bottom: 1rem;
            line-height: 1.15;
        }

        p {
            font-size: 0.9rem;
            color: #888888;
            line-height: 1.7;
            margin-bottom: 2.5rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            color: #0B8598;
            border: 1px solid rgba(11,133,152,0.25);
            padding: 0.6rem 1.25rem;
            border-radius: 6px;
            transition: border-color 0.2s, background 0.2s;
        }
        .back-link:hover {
            border-color: rgba(11,133,152,0.5);
            background: rgba(11,133,152,0.06);
        }

        .status-dot {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #555555;
            margin-top: 3rem;
        }
        .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #f59e0b;
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.3; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z"/>
            </svg>
        </div>

        <p class="eyebrow">DevAim Labs</p>
        <h1>Server under<br>maintenance.</h1>
        <p>We're making some improvements behind the scenes.<br>Everything will be back up shortly.</p>

        <a href="/" class="back-link">← Try again</a>

        <div class="status-dot">
            <span class="dot"></span>
            Temporarily unavailable
        </div>
    </div>
</body>
</html>

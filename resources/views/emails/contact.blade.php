<!DOCTYPE html>
<html lang="nl">
<body style="font-family: sans-serif; color: #333; max-width: 600px; margin: 0 auto; padding: 24px;">
    <h2 style="margin-top: 0;">{{ $isCheck ? 'Nieuwe aanvraag gratis website-check' : 'Nieuw contactformulierbericht' }}</h2>
    <p><strong>Van:</strong> {{ filled($data['name'] ?? null) ? $data['name'] : '(geen naam)' }} &lt;{{ $data['email'] }}&gt;</p>
    @if (filled($data['scan_url'] ?? null))
        <p><strong>Website:</strong> {{ $data['scan_url'] }}</p>
    @endif
    @if (filled($data['project_type'] ?? null))
        <p><strong>Type project:</strong> {{ $data['project_type'] }}</p>
    @endif
    @if (filled($data['budget'] ?? null))
        <p><strong>Budget:</strong> {{ $data['budget'] }}</p>
    @endif
    @if (filled($data['locale'] ?? null))
        <p><strong>Taal:</strong> {{ strtoupper($data['locale']) }}</p>
    @endif
    @if (filled($data['message'] ?? null))
        <hr style="border: none; border-top: 1px solid #eee; margin: 16px 0;">
        <p style="white-space: pre-wrap;">{{ $data['message'] }}</p>
    @endif
</body>
</html>

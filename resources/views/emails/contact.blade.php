<!DOCTYPE html>
<html lang="nl">
<body style="font-family: sans-serif; color: #333; max-width: 600px; margin: 0 auto; padding: 24px;">
    <h2 style="margin-top: 0;">Nieuw contactformulierbericht</h2>
    <p><strong>Van:</strong> {{ $data['name'] }} &lt;{{ $data['email'] }}&gt;</p>
    <hr style="border: none; border-top: 1px solid #eee; margin: 16px 0;">
    <p style="white-space: pre-wrap;">{{ $data['message'] }}</p>
</body>
</html>

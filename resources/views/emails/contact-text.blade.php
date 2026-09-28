{{-- Plain-text part: raw output on purpose. {{ }} would HTML-escape
     (O'Brien -> O&#039;Brien) and plain text is never rendered as HTML. --}}{!! $isCheck ? 'Nieuwe aanvraag gratis website-check' : 'Nieuw contactformulierbericht' !!}

Van: {!! filled($data['name'] ?? null) ? $data['name'] : '(geen naam)' !!} <{!! $data['email'] !!}>
@if (filled($data['scan_url'] ?? null))
Website: {!! $data['scan_url'] !!}
@endif
@if (filled($data['project_type'] ?? null))
Type project: {!! $data['project_type'] !!}
@endif
@if (filled($data['budget'] ?? null))
Budget: {!! $data['budget'] !!}
@endif
@if (filled($data['locale'] ?? null))
Taal: {!! strtoupper($data['locale']) !!}
@endif
@if (filled($data['message'] ?? null))

{!! $data['message'] !!}
@endif

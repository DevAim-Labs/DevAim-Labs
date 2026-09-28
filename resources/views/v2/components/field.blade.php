{{--
    Labelled form field with an inline error slot that main.js fills from
    the 422 `errors` JSON. The error element id is referenced through
    aria-describedby so screen readers read it with the field.
--}}
@props([
    'form',                 // unique form prefix, for ids
    'name',
    'label',
    'type' => 'text',
    'as' => 'input',        // input | textarea | select
    'required' => false,
    'optional' => null,     // "(optioneel)" text, when not required
    'hint' => null,
    'placeholder' => null,
    'autocomplete' => null,
    'inputmode' => null,
    'options' => [],        // for select: value => label
    'emptyOption' => null,  // for select: first empty option label
    'value' => null,        // for select: the option selected by default (form.reset() keeps it)
])

@php
    $id = $form.'-'.$name;
    $errorId = $id.'-error';
    $hintId = $hint ? $id.'-hint' : null;
    $describedBy = trim(($hintId ? $hintId.' ' : '').$errorId);
@endphp

<div {{ $attributes->merge(['class' => 'field']) }} data-field="{{ $name }}">
    <label for="{{ $id }}" class="field__label">
        {{ $label }}
        @if (! $required && $optional)
            <span class="field__optional">({{ $optional }})</span>
        @endif
    </label>

    @if ($as === 'textarea')
        <textarea id="{{ $id }}" name="{{ $name }}" rows="5" class="field__control field__control--area"
            @if ($required) required @endif
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            aria-describedby="{{ $describedBy }}"></textarea>
    @elseif ($as === 'select')
        <div class="field__select">
            <select id="{{ $id }}" name="{{ $name }}" class="field__control"
                @if ($required) required @endif
                aria-describedby="{{ $describedBy }}">
                @if ($emptyOption !== null)
                    <option value="">{{ $emptyOption }}</option>
                @endif
                @foreach ($options as $optionValue => $optionLabel)
                    <option value="{{ $optionValue }}" @selected($value !== null && (string) $optionValue === (string) $value)>{{ $optionLabel }}</option>
                @endforeach
            </select>
            <x-v2::icon name="chevron-down" class="field__chevron" />
        </div>
    @else
        <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" class="field__control"
            @if ($required) required @endif
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            @if ($inputmode) inputmode="{{ $inputmode }}" @endif
            @if ($type === 'email' || $type === 'url') autocapitalize="none" autocorrect="off" spellcheck="false" @endif
            aria-describedby="{{ $describedBy }}">
    @endif

    @if ($hint)
        <p id="{{ $hintId }}" class="field__hint">{{ $hint }}</p>
    @endif
    <p id="{{ $errorId }}" class="field__error" data-error-for="{{ $name }}" hidden></p>
</div>

<?php

namespace App\Support;

/**
 * Time trap for the public forms.
 *
 * token() goes into a hidden field when the form is rendered: the render
 * time, HMAC-signed with the APP_KEY so a bot can't forge an older one.
 * verdict() reads it back on submit. A person needs more than a few
 * seconds to fill in a form; a bot that posts straight away, replays an
 * old page or leaves the field out does not pass.
 */
final class FormTimer
{
    public const FIELD = 'form_started';

    public const MIN_SECONDS = 3;

    /** Older pages hit an expired session (419, SESSION_LIFETIME=120) first anyway. */
    public const MAX_SECONDS = 2 * 60 * 60;

    public static function token(): string
    {
        $time = (string) now()->getTimestamp();

        return $time.'.'.self::sign($time);
    }

    /**
     * Null when the form was filled in by a person, otherwise the reason
     * it was not: 'missing', 'invalid', 'too_fast' or 'expired'.
     */
    public static function verdict(mixed $token): ?string
    {
        if (! is_string($token) || $token === '') {
            return 'missing';
        }

        [$time, $signature] = array_pad(explode('.', $token, 2), 2, '');

        if (! ctype_digit($time) || ! hash_equals(self::sign($time), $signature)) {
            return 'invalid';
        }

        $age = now()->getTimestamp() - (int) $time;

        return match (true) {
            $age < self::MIN_SECONDS => 'too_fast',
            $age > self::MAX_SECONDS => 'expired',
            default => null,
        };
    }

    private static function sign(string $time): string
    {
        return hash_hmac('sha256', 'form-timer|'.$time, (string) config('app.key'));
    }
}

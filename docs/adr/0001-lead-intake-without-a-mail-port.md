# 1. Lead intake: no mail port, no form request

Status: accepted (2026-09-29)

## Context

A contact or website-check submission used to be spread over `ContactRequest`
(rules, cleaning, spam check), `ContactController` (hardcoded answers), the
"contact" rate limiter in `AppServiceProvider` (which parsed `scan_url` again)
and `FormTimer`. We deepened this into one module, `App\Support\LeadIntake`.

Two seams were on the table:

1. A mail **port** (an interface such as `LeadNotifier`) with a Resend/Laravel
   adapter, so the module could be tested with an in-memory adapter.
2. Keeping `ContactRequest` as a thin Laravel **adapter** for validation.

## Decision

- **No mail port.** `LeadIntake` sends through Laravel's `Mail` facade. The
  facade already has two adapters: the configured mailer in production and
  `Mail::fake()` in tests (or `Mail::shouldReceive()` to simulate a failure).
  A port of our own would be a one-adapter, hypothetical seam.
- **No form request.** Validation runs inside `LeadIntake::submit()` with
  `Validator::make()->validate()`. The controller is the only HTTP adapter:
  request input in, `{status, message}` out as JSON. A `ValidationException`
  gives the same 422 JSON as the form request did.

## Consequences

- The whole intake (cleaning, validation, spam verdict, rate-limit keys,
  outcome messages, project-type vocabulary) is tested through `LeadIntake`
  without HTTP (`LeadIntakeTest`); `ContactFormTest` keeps the HTTP contract.
- Should mail ever go out through something that is not a Laravel mailer (a
  CRM API, a queue we own), that is the moment to add a port, with a real
  second adapter.

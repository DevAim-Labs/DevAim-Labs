<?php

/**
 * The Organisation: DevAim Labs' own facts, in one place (see CONTEXT.md).
 *
 * Read only through App\Support\Organisation, which derives the display
 * phone, the tel: link, the logo URL and size, and the schema.org node.
 * Plain values only: no url() or asset() here (config:cache runs without
 * a request).
 */
return [
    'name' => 'DevAim Labs',
    'email' => 'contact@devaimlabs.com',

    // E.164, no spaces. Shown as "+31 6 3852 3099".
    'phone' => '+31638523099',

    // Path under public/.
    'logo' => '/brand/devaim-mark-512.png',

    // Dutch Chamber of Commerce (KvK) and VAT (BTW) numbers.
    'kvk' => '42051464',
    'btw' => 'NL005458933B79',

    // Profile URLs of the business (LinkedIn, GitHub, ...), for schema.org sameAs.
    'same_as' => [],

    /*
     * Street address for the schema.org node, or null for a service-area
     * business (country only). Shape: ['street' => ..., 'postal_code' => ...,
     * 'city' => ...].
     * TODO (owner): decide whether the Weena address is public (it is in
     * the privacy statement today). Left out until you do.
     */
    'address' => null,
];

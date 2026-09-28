@extends('v2.layout')

{{--
    Privacy statement (Dutch only). The legal text is copied verbatim from
    resources/views/privacy.blade.php (the old layout); edit it here now.
    E-mail and phone come from the Organisation (`$org`). The address is
    part of the legal text; see config/organisation.php `address`.
--}}

@section('content')
    @include('v2.partials.page-head', [
        'eyebrow' => 'Juridisch',
        'title' => 'Privacyverklaring',
        'meta' => 'Laatst bijgewerkt: 5 september 2026',
    ])

    <div class="section section--page-first">
        <div class="wrap">
            <article class="legal" aria-labelledby="page-title">
                <p>
                    DevAim Labs, gevestigd aan Weena 690, 3012 CN Rotterdam, is verantwoordelijk voor de verwerking
                    van persoonsgegevens zoals weergegeven in deze privacyverklaring.
                </p>

                <h2>Contactgegevens</h2>
                <p>
                    DevAim Labs<br>
                    Weena 690, 3012 CN Rotterdam<br>
                    <a href="https://devaimlabs.com">devaimlabs.com</a><br>
                    <a href="{{ $org['phone_href'] }}">{{ $org['phone_display'] }}</a>
                </p>
                <p>
                    DevAim Labs is de functionaris gegevensbescherming van DevAim Labs en is te bereiken via
                    <a href="mailto:{{ $org['email'] }}">{{ $org['email'] }}</a>.
                </p>

                <h2>Persoonsgegevens die ik verwerk</h2>
                <p>
                    DevAim Labs verwerkt uw persoonsgegevens doordat u gebruik maakt van mijn diensten en/of
                    omdat u deze zelf aan mij verstrekt. Hieronder vindt u een overzicht van de persoonsgegevens
                    die ik verwerk:
                </p>
                <ul>
                    <li>Voor- en achternaam</li>
                    <li>E-mailadres</li>
                </ul>

                <h2>Bijzondere en/of gevoelige persoonsgegevens die ik verwerk</h2>
                <p>
                    Mijn website en/of dienst heeft niet de intentie gegevens te verzamelen over websitebezoekers
                    die jonger zijn dan 16 jaar, tenzij ze toestemming hebben van ouders of voogd. Ik kan echter
                    niet controleren of een bezoeker ouder dan 16 is. Ik raad ouders dan ook aan betrokken te zijn
                    bij de online activiteiten van hun kinderen, om zo te voorkomen dat er gegevens over kinderen
                    verzameld worden zonder ouderlijke toestemming. Als u er van overtuigd bent dat ik zonder die
                    toestemming persoonlijke gegevens heb verzameld over een minderjarige, neem dan contact met
                    mij op via <a href="mailto:{{ $org['email'] }}">{{ $org['email'] }}</a>,
                    dan verwijder ik deze informatie.
                </p>

                <h2>Doeleinden van de verwerking</h2>
                <p>DevAim Labs verwerkt uw persoonsgegevens voor de volgende doelen:</p>
                <ul>
                    <li>U te kunnen bellen of e-mailen indien dit nodig is om mijn dienstverlening uit te kunnen voeren</li>
                </ul>

                <h2>Geautomatiseerde besluitvorming</h2>
                <p>DevAim Labs maakt geen gebruik van geautomatiseerde besluitvorming.</p>

                <h2>Hoe lang ik persoonsgegevens bewaar</h2>
                <p>
                    DevAim Labs bewaart uw persoonsgegevens niet langer dan strikt nodig is om de doelen te
                    realiseren waarvoor uw gegevens worden verzameld. Ik hanteer de volgende bewaartermijn voor
                    persoonsgegevens: <strong>2 weken</strong>.
                </p>

                <h2>Delen van persoonsgegevens met derden</h2>
                <p>
                    DevAim Labs verstrekt uitsluitend gegevens aan derden als dit nodig is voor de uitvoering van
                    mijn overeenkomst met u of om te voldoen aan een wettelijke verplichting.
                </p>

                <h2>Cookies, of vergelijkbare technieken, die ik gebruik</h2>
                <p>
                    DevAim Labs gebruikt alleen technische en functionele cookies, en analytische cookies die geen
                    inbreuk maken op uw privacy. Een cookie is een klein tekstbestand dat bij het eerste bezoek aan
                    deze website wordt opgeslagen op uw computer, tablet of smartphone. De cookies die ik gebruik
                    zijn noodzakelijk voor de technische werking van de website en uw gebruiksgemak. Ze zorgen ervoor
                    dat de website naar behoren werkt en onthouden bijvoorbeeld uw voorkeursinstellingen. Ook kan
                    ik hiermee mijn website optimaliseren. U kunt zich afmelden voor cookies door uw internetbrowser
                    zo in te stellen dat deze geen cookies meer opslaat. Daarnaast kunt u ook alle informatie die
                    eerder is opgeslagen via de instellingen van uw browser verwijderen.
                </p>

                <h2>Gegevens inzien, aanpassen of verwijderen</h2>
                <p>
                    U heeft het recht om uw persoonsgegevens in te zien, te corrigeren of te verwijderen. Daarnaast
                    heeft u het recht om uw eventuele toestemming voor de gegevensverwerking in te trekken of bezwaar
                    te maken tegen de verwerking van uw persoonsgegevens door DevAim Labs, en heeft u het recht op
                    gegevensoverdraagbaarheid. Dat betekent dat u bij mij een verzoek kunt indienen om de
                    persoonsgegevens die ik van u heb in een computerbestand naar u of een andere, door u
                    genoemde organisatie, te sturen.
                </p>
                <p>
                    U kunt een verzoek tot inzage, correctie, verwijdering, gegevensoverdraging van uw
                    persoonsgegevens of verzoek tot intrekking van uw toestemming of bezwaar op de verwerking van uw
                    persoonsgegevens sturen naar <a href="mailto:{{ $org['email'] }}">{{ $org['email'] }}</a>.
                </p>
                <p>
                    Om er zeker van te zijn dat het verzoek tot inzage door u is gedaan, vraag ik u een kopie van
                    uw identiteitsbewijs met het verzoek mee te sturen. Maak in deze kopie uw pasfoto, MRZ (machine
                    readable zone, de strook met nummers onderaan het paspoort), paspoortnummer en
                    Burgerservicenummer (BSN) zwart, ter bescherming van uw privacy. Ik reageer zo snel mogelijk,
                    maar binnen vier weken, op uw verzoek.
                </p>
                <p>
                    DevAim Labs wil u er tevens op wijzen dat u de mogelijkheid heeft om een klacht in te dienen bij
                    de nationale toezichthouder, de Autoriteit Persoonsgegevens. Dat kan via
                    <a href="https://autoriteitpersoonsgegevens.nl/nl/contact-met-de-autoriteit-persoonsgegevens/tip-ons" target="_blank" rel="noopener noreferrer">deze link<span class="sr-only"> {{ $t['a11y']['new_tab'] }}</span></a>.
                </p>

                <h2>Hoe ik persoonsgegevens beveilig</h2>
                <p>
                    DevAim Labs neemt de bescherming van uw gegevens serieus en neemt passende maatregelen om
                    misbruik, verlies, onbevoegde toegang, ongewenste openbaarmaking en ongeoorloofde wijziging
                    tegen te gaan. Als u de indruk heeft dat uw gegevens niet goed beveiligd zijn of er aanwijzingen
                    zijn van misbruik, neem dan contact op via <a href="mailto:{{ $org['email'] }}">{{ $org['email'] }}</a>.
                </p>
            </article>
        </div>
    </div>
@endsection

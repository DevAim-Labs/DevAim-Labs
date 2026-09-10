@extends('layouts.site')

@section('content')
@include('partials.nav')

<section class="pt-32 pb-24 px-6">
    <div class="max-w-3xl mx-auto">
        @if(!empty($breadcrumbs) && count($breadcrumbs) > 1)
        <nav aria-label="Breadcrumb" class="mb-6">
            <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs">
                @foreach($breadcrumbs as $i => $crumb)
                    @if($i > 0)
                        <li aria-hidden="true" style="color: var(--color-text-dim);">/</li>
                    @endif
                    <li>
                        @if($i === count($breadcrumbs) - 1)
                            <span aria-current="page" style="color: var(--color-text-muted);">{{ $crumb['name'] }}</span>
                        @else
                            <a href="{{ $crumb['path'] }}" class="hover:underline" style="color: var(--color-text-dim);">{{ $crumb['name'] }}</a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
        @endif

        <p class="section-eyebrow mb-4">Juridisch</p>
        <h1 class="text-3xl md:text-4xl section-title mb-3">Privacyverklaring</h1>
        <p class="text-sm mb-12" style="color: var(--color-text-dim);">Laatst bijgewerkt: 5 september 2026</p>

        <div class="space-y-10 text-sm leading-relaxed" style="color: var(--color-text-muted);">
            <p>
                DevAim Labs, gevestigd aan Weena 690, 3012 CN Rotterdam, is verantwoordelijk voor de verwerking
                van persoonsgegevens zoals weergegeven in deze privacyverklaring.
            </p>

            <div>
                <h2 class="text-lg font-semibold mb-3" style="color: var(--color-text);">Contactgegevens</h2>
                <p>
                    DevAim Labs<br>
                    Weena 690, 3012 CN Rotterdam<br>
                    <a href="https://devaimlabs.com" class="hover:underline" style="color: var(--color-accent);">devaimlabs.com</a><br>
                    <a href="tel:+31638523099" class="hover:underline" style="color: var(--color-accent);">+31 6385230999</a>
                </p>
                <p class="mt-3">
                    DevAim Labs is de functionaris gegevensbescherming van DevAim Labs en is te bereiken via
                    <a href="mailto:contact@devaimlabs.com" class="hover:underline" style="color: var(--color-accent);">contact@devaimlabs.com</a>.
                </p>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-3" style="color: var(--color-text);">Persoonsgegevens die ik verwerk</h2>
                <p class="mb-3">
                    DevAim Labs verwerkt uw persoonsgegevens doordat u gebruik maakt van mijn diensten en/of
                    omdat u deze zelf aan mij verstrekt. Hieronder vindt u een overzicht van de persoonsgegevens
                    die ik verwerk:
                </p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>Voor- en achternaam</li>
                    <li>E-mailadres</li>
                </ul>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-3" style="color: var(--color-text);">Bijzondere en/of gevoelige persoonsgegevens die ik verwerk</h2>
                <p>
                    Mijn website en/of dienst heeft niet de intentie gegevens te verzamelen over websitebezoekers
                    die jonger zijn dan 16 jaar, tenzij ze toestemming hebben van ouders of voogd. Ik kan echter
                    niet controleren of een bezoeker ouder dan 16 is. Ik raad ouders dan ook aan betrokken te zijn
                    bij de online activiteiten van hun kinderen, om zo te voorkomen dat er gegevens over kinderen
                    verzameld worden zonder ouderlijke toestemming. Als u er van overtuigd bent dat ik zonder die
                    toestemming persoonlijke gegevens heb verzameld over een minderjarige, neem dan contact met
                    mij op via <a href="mailto:contact@devaimlabs.com" class="hover:underline" style="color: var(--color-accent);">contact@devaimlabs.com</a>,
                    dan verwijder ik deze informatie.
                </p>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-3" style="color: var(--color-text);">Doeleinden van de verwerking</h2>
                <p class="mb-3">DevAim Labs verwerkt jouw persoonsgegevens voor de volgende doelen:</p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>U te kunnen bellen of e-mailen indien dit nodig is om mijn dienstverlening uit te kunnen voeren</li>
                </ul>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-3" style="color: var(--color-text);">Geautomatiseerde besluitvorming</h2>
                <p>DevAim Labs maakt geen gebruik van geautomatiseerde besluitvorming.</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-3" style="color: var(--color-text);">Hoe lang ik persoonsgegevens bewaar</h2>
                <p>
                    DevAim Labs bewaart uw persoonsgegevens niet langer dan strikt nodig is om de doelen te
                    realiseren waarvoor uw gegevens worden verzameld. Ik hanteer de volgende bewaartermijn voor
                    persoonsgegevens: <strong style="color: var(--color-text);">2 weken</strong>.
                </p>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-3" style="color: var(--color-text);">Delen van persoonsgegevens met derden</h2>
                <p>
                    DevAim Labs verstrekt uitsluitend gegevens aan derden als dit nodig is voor de uitvoering van
                    mijn overeenkomst met u of om te voldoen aan een wettelijke verplichting.
                </p>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-3" style="color: var(--color-text);">Cookies, of vergelijkbare technieken, die ik gebruik</h2>
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
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-3" style="color: var(--color-text);">Gegevens inzien, aanpassen of verwijderen</h2>
                <p class="mb-3">
                    U heeft het recht om uw persoonsgegevens in te zien, te corrigeren of te verwijderen. Daarnaast
                    heeft u het recht om uw eventuele toestemming voor de gegevensverwerking in te trekken of bezwaar
                    te maken tegen de verwerking van uw persoonsgegevens door DevAim Labs, en heeft u het recht op
                    gegevensoverdraagbaarheid. Dat betekent dat u bij mij een verzoek kunt indienen om de
                    persoonsgegevens die ik van u heb in een computerbestand naar u of een andere, door u
                    genoemde organisatie, te sturen.
                </p>
                <p class="mb-3">
                    U kunt een verzoek tot inzage, correctie, verwijdering, gegevensoverdraging van uw
                    persoonsgegevens of verzoek tot intrekking van uw toestemming of bezwaar op de verwerking van uw
                    persoonsgegevens sturen naar <a href="mailto:contact@devaimlabs.com" class="hover:underline" style="color: var(--color-accent);">contact@devaimlabs.com</a>.
                </p>
                <p class="mb-3">
                    Om er zeker van te zijn dat het verzoek tot inzage door u is gedaan, vraag ik u een kopie van
                    uw identiteitsbewijs met het verzoek mee te sturen. Maak in deze kopie uw pasfoto, MRZ (machine
                    readable zone, de strook met nummers onderaan het paspoort), paspoortnummer en
                    Burgerservicenummer (BSN) zwart, ter bescherming van uw privacy. Ik reageer zo snel mogelijk,
                    maar binnen vier weken, op uw verzoek.
                </p>
                <p>
                    DevAim Labs wil u er tevens op wijzen dat u de mogelijkheid heeft om een klacht in te dienen bij
                    de nationale toezichthouder, de Autoriteit Persoonsgegevens. Dat kan via
                    <a href="https://autoriteitpersoonsgegevens.nl/nl/contact-met-de-autoriteit-persoonsgegevens/tip-ons" target="_blank" rel="noopener noreferrer" class="hover:underline" style="color: var(--color-accent);">deze link</a>.
                </p>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-3" style="color: var(--color-text);">Hoe ik persoonsgegevens beveilig</h2>
                <p>
                    DevAim Labs neemt de bescherming van uw gegevens serieus en neemt passende maatregelen om
                    misbruik, verlies, onbevoegde toegang, ongewenste openbaarmaking en ongeoorloofde wijziging
                    tegen te gaan. Als u de indruk heeft dat uw gegevens niet goed beveiligd zijn of er aanwijzingen
                    zijn van misbruik, neem dan contact op via <a href="mailto:contact@devaimlabs.com" class="hover:underline" style="color: var(--color-accent);">contact@devaimlabs.com</a>.
                </p>
            </div>
        </div>
    </div>
</section>

@include('partials.footer')
@endsection

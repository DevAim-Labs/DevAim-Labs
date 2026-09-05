<section id="diensten-verdieping" data-gsap="section-diensten-verdieping" class="reveal-hidden">
    <div class="section-card">
        <div class="max-w-4xl mx-auto px-6 py-20">
            <p class="section-eyebrow mb-4">Verdieping</p>
            <h2 class="text-3xl md:text-4xl section-title mb-6">
                Adminpanelen en KPI-dashboards, in gewone taal
            </h2>
            <p class="text-[var(--color-text-muted)] leading-relaxed mb-12 max-w-2xl">
                Veel bedrijven werken nog met een mix van Excel bestanden, WhatsApp berichten en losse e-mails
                om bij te houden wat er speelt. Een adminpaneel of KPI-dashboard vervangt dat door één centrale
                plek, waar jij en je team in één oogopslag zien hoe het ervoor staat.
            </p>

            <div class="grid md:grid-cols-2 gap-10 mb-12">
                <div>
                    <h3 class="text-lg font-semibold text-[var(--color-text)] mb-3">Wat is een adminpaneel precies</h3>
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                        Een adminpaneel is een besloten omgeving, alleen voor jou en je team, waarin je de dagelijkse
                        gang van zaken regelt. Denk aan het toevoegen van een nieuwe klant, het bijhouden van
                        bestellingen, of het goedkeuren van een aanvraag. Alles wat nu nog via e-mail of een gedeeld
                        bestand gaat, gebeurt hier op één plek, met een duidelijk overzicht van wie wat heeft gedaan.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-[var(--color-text)] mb-3">Wat is een KPI-dashboard precies</h3>
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                        Een KPI-dashboard laat in één oogopslag zien hoe je bedrijf ervoor staat. In plaats van elke
                        week zelf cijfers te verzamelen uit verschillende systemen, verschijnen de belangrijkste
                        getallen vanzelf op het scherm. Denk aan omzet, aantal bestellingen of openstaande aanvragen.
                        Je ziet meteen wanneer iets aandacht nodig heeft, zonder dat je daar zelf achteraan hoeft te gaan.
                    </p>
                </div>
            </div>

            <h3 class="text-lg font-semibold text-[var(--color-text)] mb-4">Wat je concreet krijgt</h3>
            <ul class="grid sm:grid-cols-2 gap-x-8 gap-y-3 mb-12">
                @foreach ([
                    'Eén centrale plek in plaats van losse Excel bestanden, WhatsApp berichten en e-mails',
                    'Een overzicht dat live meebeweegt, zodat je niet hoeft te wachten op een rapport aan het einde van de week',
                    'Rollen en rechten, zodat iedereen in je team alleen ziet en doet wat voor die persoon bedoeld is',
                    'Aanvragen goedkeuren of afwijzen met één klik, zonder eindeloos heen en weer te mailen',
                    'Rapporten die zichzelf maken, als PDF of Excel bestand, op het moment dat jij dat wilt',
                    'Een melding zodra iets aandacht nodig heeft, zodat je niet zelf continu hoeft te controleren',
                    'Eén overzicht van binnenkomende berichten en aanvragen, zodat niets blijft liggen',
                ] as $benefit)
                    <li class="flex gap-3 text-sm text-[var(--color-text-muted)] leading-relaxed">
                        <span class="text-[var(--color-accent)] shrink-0">✓</span>
                        <span>{{ $benefit }}</span>
                    </li>
                @endforeach
            </ul>

            <h3 class="text-lg font-semibold text-[var(--color-text)] mb-4">Voor wie is dit interessant</h3>
            <div class="grid sm:grid-cols-3 gap-4 mb-12">
                <div class="card-glow p-5 rounded-xl border border-[var(--color-border)] bg-[var(--color-surface-1)]">
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                        Een horecazaak die reserveringen, bestellingen en klantvragen nu nog via losse kanalen
                        regelt. Met een adminpaneel komt alles samen op één scherm.
                    </p>
                </div>
                <div class="card-glow p-5 rounded-xl border border-[var(--color-border)] bg-[var(--color-surface-1)]">
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                        Een opleider of trainingsbureau dat de voortgang van cursisten of medewerkers wil volgen.
                        Een KPI-dashboard laat in één oogopslag zien wie goed op schema ligt en wie extra aandacht
                        nodig heeft.
                    </p>
                </div>
                <div class="card-glow p-5 rounded-xl border border-[var(--color-border)] bg-[var(--color-surface-1)]">
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                        Een bedrijf dat groeit uit zijn Excel bestanden en toe is aan een systeem dat meegroeit.
                    </p>
                </div>
            </div>

            <h3 class="text-lg font-semibold text-[var(--color-text)] mb-3">Hoe we dat bouwen</h3>
            <p class="text-sm text-[var(--color-text-muted)] leading-relaxed mb-10 max-w-2xl">
                We beginnen met een gesprek over hoe jouw team nu werkt en waar het misgaat. Daarna bouwen we een
                adminpaneel of dashboard dat daarbij aansluit, in plaats van andersom. Je krijgt geen kant en klaar
                pakket met functies die je toch niet gebruikt, maar software die precies doet wat jouw bedrijf nodig
                heeft. Meer over onze
                <a href="/werkwijze" class="text-[var(--color-accent)] hover:underline">werkwijze</a>
                lees je op die pagina.
            </p>

            <div class="flex flex-wrap gap-3">
                <a
                    href="/contact"
                    class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-md text-sm font-semibold"
                    data-track="cta_click"
                    data-track-label="Start een project"
                    data-track-location="diensten_verdieping"
                >
                    Start een project
                </a>
                <a
                    href="/klantwerk"
                    class="btn-outline inline-flex items-center gap-2 px-6 py-3 rounded-md text-sm font-medium"
                    data-track="cta_click"
                    data-track-label="Bekijk klantwerk"
                    data-track-location="diensten_verdieping"
                >
                    Bekijk klantwerk →
                </a>
            </div>
        </div>
    </div>
</section>

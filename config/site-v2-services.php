<?php

/**
 * Service detail pages: /diensten/{slug} and /en/services/{slug}.
 *
 * Read through App\Support\ServiceCatalog (never directly from a view).
 *
 * - Dutch copy: formal "u", first person singular ("ik"), written for any
 *   kind of business (not one sector).
 * - The demos are fictional businesses with example data. Every place that
 *   shows one says so ("Voorbeelddata · fictief bedrijf"), outside and
 *   inside the frame.
 * - Real client cases come from resources/data/clients.json (`services` per client).
 *   Only list a case where it is relevant, and the page only repeats what
 *   was built there. No invented results, quotes or numbers.
 * - Prices come from config('site-v2.{locale}.pricing.packages'), picked by
 *   `package`. A null `price_from` renders "Prijs op aanvraag".
 * - Process `time` values are optional; they render only when set.
 *   TODO (owner): add real lead-time indications per step if you want them.
 */

return [

    /*
     * Order of the services (menus, sitemap, route patterns).
     * Keys are stable ids; URLs come from `slugs`.
     */
    'order' => ['websites', 'admin-panels', 'dashboards', 'payments', 'api-integrations'],

    'services' => [

        /* ---------------------------------------------------------------- */
        'websites' => [
            'slugs' => ['nl' => 'websites', 'en' => 'websites'],
            'icon' => 'globe',
            'project_type' => 'website',
            'package' => 'starter',
            'schema_type' => 'Web development',
            'demo' => [
                'src' => '/demo/website.html',
                'image' => '/service-previews/website.webp',
                'width' => 1600,
                'height' => 956,
                // Responsive demo: can run inline from tablet width up.
                'desktop_only' => false,
            ],
            'related' => ['payments', 'api-integrations'],

            'nl' => [
                'meta' => [
                    'title' => 'Website laten maken | Snel, vindbaar en op maat | DevAim Labs',
                    'description' => 'Website laten maken die bezoekers omzet in aanvragen, reserveringen of telefoontjes. Snel, mobielvriendelijk en vindbaar in Google. Bekijk de live demo.',
                ],
                'name' => 'Websites',
                'summary' => 'Een snelle, vindbare website die bezoekers omzet in aanvragen, reserveringen of telefoontjes.',
                'hero' => [
                    'eyebrow' => 'Websites',
                    'title' => 'Website',
                    'title_em' => 'laten maken',
                    'subtitle' => 'Is uw huidige site traag, verouderd of levert hij weinig aanvragen op? Ik bouw een snelle, vindbare website die in één oogopslag laat zien wat u doet, en die het bezoekers makkelijk maakt om contact op te nemen.',
                ],
                'demo' => [
                    'business' => 'Atelier Noord',
                    'url_label' => 'ateliernoord.nl (voorbeeld)',
                    'title' => 'Een webshop voor een fictief kledingmerk',
                    'try' => 'Probeer: filter op kleur of maat, open een artikel, kies een maat en leg het in de winkelmand. Pas daarna het aantal aan en ga naar afrekenen. Dezelfde opbouw werkt ook voor een bedrijfswebsite, een portfolio of een winkel in een andere branche.',
                    'iframe_title' => 'Live voorbeeld: webshop van fictief kledingmerk Atelier Noord',
                    'alt' => 'Schermafbeelding van de voorbeeldwebshop van fictief kledingmerk Atelier Noord, met campagnebeeld en collectie',
                ],
                'deliverables' => [
                    'title' => 'Een complete website, klaar om aanvragen binnen te halen',
                    'intro' => 'Van ontwerp tot livegang. Waar het kan, ziet u het terug in de demo hierboven.',
                    'items' => [
                        ['icon' => 'layout-dashboard', 'title' => 'Ontwerp op maat', 'text' => 'Geen standaardtemplate: opbouw, kleuren en teksten passen bij uw bedrijf en uw klanten.', 'demo' => 'De grote openingstitel en het campagnebeeld bovenaan.'],
                        ['icon' => 'gauge', 'title' => 'Snel op elke telefoon', 'text' => 'Licht gebouwd en getest op mobiel, zodat bezoekers niet afhaken tijdens het laden.', 'demo' => 'Open de demo op uw telefoon: filters en winkelmand passen zich aan.'],
                        ['icon' => 'search', 'title' => 'Vindbaar in Google', 'text' => 'Een nette paginastructuur, snelle laadtijd, metadata en structured data als basis voor SEO.', 'demo' => 'De collectie met categorieën en een duidelijke kop per sectie.'],
                        ['icon' => 'globe', 'title' => 'Uw aanbod goed in beeld', 'text' => 'Producten, diensten of projecten overzichtelijk gepresenteerd, met ruimte voor foto\'s en uitleg.', 'demo' => 'De productkaarten en het snelle-weergavevenster met kleuren en maten.'],
                        ['icon' => 'mail', 'title' => 'Contact en bestellen zonder drempel', 'text' => 'Duidelijke knoppen, een winkelmand of contactformulier, en uw gegevens altijd binnen één klik.', 'demo' => 'De winkelmand rechtsboven en de nieuwsbriefaanmelding onderaan.'],
                        ['icon' => 'shield-check', 'title' => 'Hulp bij hosting en livegang', 'text' => 'Domein, hosting, SSL en de overstap van uw oude site regel ik samen met u.', 'demo' => null],
                    ],
                ],
                'fit' => [
                    'good' => [
                        'U wilt een nieuwe website, of uw huidige site is toe aan vervanging.',
                        'U wilt dat bezoekers sneller contact opnemen, reserveren of een offerte aanvragen.',
                        'U wilt één aanspreekpunt voor ontwerp, bouw en livegang.',
                    ],
                    'bad' => [
                        'U wilt alleen een paar teksten aanpassen in een bestaand thema.',
                        'U zoekt een webshop met duizenden producten: daar is een gespecialiseerd platform vaak de betere keuze.',
                    ],
                ],
                'proof' => [
                    'title' => 'Websites die ik bouwde',
                    'intro' => 'Twee echte projecten. Hieronder staat wat er gebouwd is.',
                ],
                'process' => [
                    'title' => 'Van eerste gesprek tot livegang',
                    'intro' => 'U weet vooraf wat u krijgt, wat het kost en wanneer het klaar is.',
                    'steps' => [
                        ['title' => 'Kennismaking', 'text' => 'We bespreken uw bedrijf, uw klanten en wat de site moet opleveren. Daarna ontvangt u een voorstel met een vaste prijs en planning.', 'time' => null],
                        ['title' => 'Ontwerp', 'text' => 'U ziet eerst een ontwerp van de belangrijkste pagina\'s en kunt bijsturen voordat er gebouwd wordt.', 'time' => null],
                        ['title' => 'Bouw en inhoud', 'text' => 'Ik bouw de site, zet de inhoud erin en test op telefoon, tablet en desktop.', 'time' => null],
                        ['title' => 'Livegang en nazorg', 'text' => 'De site gaat live op uw domein. Daarna blijf ik beschikbaar voor updates en nieuwe wensen.', 'time' => null],
                    ],
                ],
                'pricing' => [
                    'title' => 'Wat kost een website laten maken?',
                    'intro' => 'De prijs hangt af van wat uw site moet kunnen. Na een gratis kennismaking ontvangt u een vaste prijs, zonder verrassingen achteraf.',
                    'drivers' => [
                        'Het aantal pagina\'s en paginatypes',
                        'Of u zelf teksten en foto\'s wilt beheren (CMS)',
                        'Formulieren, reserveren of een koppeling met uw agenda of e-mail',
                        'Of u teksten en beelden aanlevert of daar hulp bij wilt',
                        'Meerdere talen',
                    ],
                    'note' => null,
                ],
                'faq' => [
                    ['q' => 'Wat kost een website laten maken?', 'a' => 'Dat hangt af van het aantal pagina\'s, de functies en of u zelf content wilt beheren. Na een gratis kennismaking ontvangt u een vaste prijs, zodat u vooraf weet waar u aan toe bent.'],
                    ['q' => 'Hoe lang duurt het voordat mijn website live staat?', 'a' => 'Een compacte website kan binnen enkele weken live staan. De planning hangt vooral af van de omvang en van hoe snel teksten en beelden klaar zijn. U krijgt vooraf een planning.'],
                    ['q' => 'Kan ik de teksten daarna zelf aanpassen?', 'a' => 'Ja, als u dat wilt. Ik kan een eenvoudig beheersysteem (CMS) inbouwen, zodat u teksten, foto\'s en bijvoorbeeld openingstijden zelf bijwerkt.'],
                    ['q' => 'Wordt mijn website gevonden in Google?', 'a' => 'Ik bouw met een solide technische basis: snelle laadtijd, een nette paginastructuur, metadata en structured data. Dat is het fundament voor SEO. Een positie in Google kan niemand garanderen, maar een goede basis maakt wel het verschil.'],
                    ['q' => 'Kunt u mijn bestaande website vernieuwen?', 'a' => 'Ja. Ik kijk eerst wat goed werkt en wat beter kan, neem de bruikbare inhoud mee en zorg dat oude links netjes doorverwijzen, zodat u uw vindbaarheid niet kwijtraakt.'],
                    ['q' => 'Regelt u ook hosting en het domein?', 'a' => 'Ik help bij het kiezen en inrichten van hosting, domein en SSL, en bij de overstap van uw huidige site. U blijft eigenaar van uw domein en uw website.'],
                    ['q' => 'Wie is eigenaar van de website?', 'a' => 'U. Na oplevering ontvangt u de volledige broncode en de documentatie die nodig is om alles zelf te beheren of te laten uitbreiden.'],
                ],
                'contact' => [
                    'title' => 'Plan een gratis gesprek over uw website',
                    'intro' => 'Vertel kort wat u zoekt. Ik reageer binnen 1 werkdag met een eerste reactie of een voorstel voor een kennismaking.',
                ],
            ],

            'en' => [
                'meta' => [
                    'title' => 'Custom website development | Fast and findable | DevAim Labs',
                    'description' => 'A custom website that turns visitors into enquiries, bookings or calls. Fast, mobile-friendly and built to be found on Google. Try the live demo.',
                ],
                'name' => 'Websites',
                'summary' => 'A fast, findable website that turns visitors into enquiries, bookings or calls.',
                'hero' => [
                    'eyebrow' => 'Websites',
                    'title' => 'Custom website',
                    'title_em' => 'development',
                    'subtitle' => 'Is your current site slow, dated or bringing in few enquiries? I build a fast, findable website that shows what you do at a glance and makes it easy for visitors to get in touch.',
                ],
                'demo' => [
                    'business' => 'Atelier Noord',
                    'url_label' => 'ateliernoord.nl (example)',
                    'title' => 'A webshop for a fictional clothing brand',
                    'try' => 'Try it: filter by colour or size, open an item, pick a size and add it to the basket. Then change the quantity and go to checkout. The same build works for a company website, a portfolio or a shop in another sector. The demo itself is in Dutch.',
                    'iframe_title' => 'Live example: webshop of the fictional clothing brand Atelier Noord',
                    'alt' => 'Screenshot of the example webshop of the fictional clothing brand Atelier Noord, with its campaign image and collection',
                ],
                'deliverables' => [
                    'title' => 'A complete website, ready to bring in enquiries',
                    'intro' => 'From design to launch. Where possible, you can see it in the demo above.',
                    'items' => [
                        ['icon' => 'layout-dashboard', 'title' => 'Designed for you', 'text' => 'No stock template: structure, colours and copy fit your business and your customers.', 'demo' => 'The large opening headline and the campaign image at the top.'],
                        ['icon' => 'gauge', 'title' => 'Fast on every phone', 'text' => 'Built light and tested on mobile, so visitors don\'t give up while it loads.', 'demo' => 'Open the demo on your phone: filters and basket adapt.'],
                        ['icon' => 'search', 'title' => 'Found on Google', 'text' => 'Clean page structure, fast load times, metadata and structured data as the basis for SEO.', 'demo' => 'The collection with categories and a clear heading per section.'],
                        ['icon' => 'globe', 'title' => 'Your offer, well presented', 'text' => 'Products, services or projects laid out clearly, with room for photos and explanation.', 'demo' => 'The product cards and the quick-view window with colours and sizes.'],
                        ['icon' => 'mail', 'title' => 'Easy to get in touch or order', 'text' => 'Clear buttons, a basket or contact form, and your details always one click away.', 'demo' => 'The basket at the top right and the newsletter sign-up at the bottom.'],
                        ['icon' => 'shield-check', 'title' => 'Help with hosting and launch', 'text' => 'Domain, hosting, SSL and the move from your old site, arranged together with you.', 'demo' => null],
                    ],
                ],
                'fit' => [
                    'good' => [
                        'You want a new website, or your current site needs replacing.',
                        'You want visitors to get in touch, book or request a quote more quickly.',
                        'You want one point of contact for design, build and launch.',
                    ],
                    'bad' => [
                        'You only want to change a few texts in an existing theme.',
                        'You need a shop with thousands of products: a specialised platform is often the better choice.',
                    ],
                ],
                'proof' => [
                    'title' => 'Websites I built',
                    'intro' => 'Two real projects. Below is what was built.',
                ],
                'process' => [
                    'title' => 'From first call to launch',
                    'intro' => 'You know up front what you get, what it costs and when it is ready.',
                    'steps' => [
                        ['title' => 'Intro', 'text' => 'We talk about your business, your customers and what the site needs to achieve. Then you get a proposal with a fixed price and timeline.', 'time' => null],
                        ['title' => 'Design', 'text' => 'You first see a design of the key pages and can steer before anything is built.', 'time' => null],
                        ['title' => 'Build and content', 'text' => 'I build the site, add the content and test it on phone, tablet and desktop.', 'time' => null],
                        ['title' => 'Launch and support', 'text' => 'The site goes live on your domain. After that I stay available for updates and new ideas.', 'time' => null],
                    ],
                ],
                'pricing' => [
                    'title' => 'What does a custom website cost?',
                    'intro' => 'The price depends on what your site needs to do. After a free intro call you get a fixed price, with no surprises afterwards.',
                    'drivers' => [
                        'The number of pages and page types',
                        'Whether you want to manage texts and photos yourself (CMS)',
                        'Forms, bookings or a link with your calendar or email',
                        'Whether you supply texts and images or want help with them',
                        'Multiple languages',
                    ],
                    'note' => null,
                ],
                'faq' => [
                    ['q' => 'What does a custom website cost?', 'a' => 'It depends on the number of pages, the features and whether you want to manage content yourself. After a free intro call you receive a fixed price, so you know where you stand up front.'],
                    ['q' => 'How long until my website is live?', 'a' => 'A compact website can be live within a few weeks. The timeline mostly depends on the scope and on how quickly texts and images are ready. You get a timeline up front.'],
                    ['q' => 'Can I edit the texts myself afterwards?', 'a' => 'Yes, if you want to. I can build in a simple content management system (CMS), so you can update texts, photos and, for example, opening hours yourself.'],
                    ['q' => 'Will my website be found on Google?', 'a' => 'I build on a solid technical basis: fast load times, clean page structure, metadata and structured data. That is the foundation for SEO. Nobody can guarantee a position on Google, but a good basis does make the difference.'],
                    ['q' => 'Can you rebuild my existing website?', 'a' => 'Yes. I first look at what works and what can be better, carry over the useful content and make sure old links redirect properly, so you don\'t lose your search visibility.'],
                    ['q' => 'Do you arrange hosting and the domain?', 'a' => 'I help choose and set up hosting, domain and SSL, and with the move from your current site. You remain the owner of your domain and your website.'],
                    ['q' => 'Who owns the website?', 'a' => 'You do. After delivery you receive the complete source code and the documentation you need to run it yourself or have it extended.'],
                ],
                'contact' => [
                    'title' => 'Book a free call about your website',
                    'intro' => 'Briefly describe what you are looking for. I reply within 1 working day with a first response or a proposal to meet.',
                ],
            ],
        ],

        /* ---------------------------------------------------------------- */
        'admin-panels' => [
            'slugs' => ['nl' => 'adminpanelen', 'en' => 'admin-panels'],
            'icon' => 'layout-dashboard',
            'project_type' => 'adminpaneel',
            'package' => 'maatwerk',
            'schema_type' => 'Custom software development',
            'demo' => [
                'src' => '/demo/adminpaneel.html',
                'image' => '/service-previews/adminpaneel.webp',
                'width' => 1600,
                'height' => 956,
                // Desktop layout (min-width 780px): new tab first on tablets.
                'desktop_only' => true,
            ],
            'related' => ['dashboards', 'api-integrations'],

            'nl' => [
                'meta' => [
                    'title' => 'Adminpaneel laten maken | Maatwerk beheersysteem | DevAim Labs',
                    'description' => 'Adminpaneel laten maken voor uw klanten, planning, orders of voorraad. Eén overzicht met rollen en rechten in plaats van losse Excel-lijsten. Bekijk de demo.',
                ],
                'name' => 'Adminpanelen',
                'summary' => 'Klanten, orders of planning op één plek beheren, in plaats van in losse Excel-lijsten.',
                'hero' => [
                    'eyebrow' => 'Adminpanelen',
                    'title' => 'Adminpaneel',
                    'title_em' => 'laten maken',
                    'subtitle' => 'Houdt u klanten, afspraken of orders bij in losse Excel-lijsten, mailtjes en notities? Ik bouw een adminpaneel op maat waarin u en uw team alles op één plek beheren, zoeken en bijwerken.',
                ],
                'demo' => [
                    'business' => 'Vonkel',
                    'url_label' => 'beheer.vonkel.nl (voorbeeld)',
                    'title' => 'Werkorders, planning en rechten voor een fictief installatiebedrijf',
                    'try' => 'Probeer: druk op Ctrl+K (⌘K) en zoek een klant, filter op status, selecteer een paar regels, of wissel linksonder naar \'Monteur\' en zie wat verdwijnt. Hetzelfde patroon werkt voor klanten, orders, afspraken, dossiers of voorraad.',
                    'iframe_title' => 'Live voorbeeld: adminpaneel met werkorders, detailpaneel en rechtenbeheer van fictief bedrijf Vonkel',
                    'alt' => 'Schermafbeelding van het voorbeeld-adminpaneel met werkorders, detailpaneel en rechtenbeheer van fictief bedrijf Vonkel',
                ],
                'deliverables' => [
                    'title' => 'Eén plek voor uw gegevens en uw team',
                    'intro' => 'Gebouwd rond hoe u werkt, niet andersom. De meeste onderdelen ziet u terug in de demo.',
                    'items' => [
                        ['icon' => 'layout-dashboard', 'title' => 'Alles in één overzicht', 'text' => 'Uw gegevens in één overzichtelijke lijst, in plaats van verspreid over bestanden en inboxen.', 'demo' => 'De werkorderlijst met opgeslagen weergaven.'],
                        ['icon' => 'search', 'title' => 'Zoeken en filteren', 'text' => 'Binnen seconden vinden wat u zoekt, op naam, status, datum of elk ander veld dat voor u telt.', 'demo' => 'Zoekveld, filterchips en Ctrl+K.'],
                        ['icon' => 'check', 'title' => 'Statussen en acties', 'text' => 'Status wijzigen, toewijzen of in één keer meerdere regels bijwerken, en altijd zien wat de stand van zaken is.', 'demo' => 'Klik op een statuslabel, of selecteer regels voor bulkacties.'],
                        ['icon' => 'user', 'title' => 'Detailweergave met historie', 'text' => 'Alle informatie over een klant of order bij elkaar, inclusief notities en eerdere activiteit.', 'demo' => 'Klik op een regel: toewijzen, notities en activiteit.'],
                        ['icon' => 'shield-check', 'title' => 'Rollen en rechten', 'text' => 'Iedereen ziet en doet alleen wat bij zijn rol hoort. Desgewenst met een logboek van wie wat wijzigde.', 'demo' => 'Team en rechten, en \'Bekijk als\' linksonder.'],
                        ['icon' => 'workflow', 'title' => 'Koppelingen met uw systemen', 'text' => 'Gegevens uit uw website, agenda of boekhouding komen automatisch binnen, zonder overtypen.', 'demo' => null],
                    ],
                ],
                'fit' => [
                    'good' => [
                        'U houdt klanten, orders, afspraken of voorraad nu bij in spreadsheets of losse tools.',
                        'Meerdere mensen werken met dezelfde gegevens en u wilt fouten en dubbel werk voorkomen.',
                        'Standaardsoftware past net niet bij hoe uw bedrijf werkt.',
                    ],
                    'bad' => [
                        'Een bestaand pakket doet al vrijwel alles wat u nodig heeft: dan is instellen goedkoper dan bouwen.',
                        'U zoekt alleen een gedeelde spreadsheet voor een paar mensen.',
                    ],
                ],
                'proof' => null,
                'process' => [
                    'title' => 'Eerst zien, dan bouwen',
                    'intro' => 'U ziet al vroeg een werkende versie, zodat het systeem past bij hoe u echt werkt.',
                    'steps' => [
                        ['title' => 'Kennismaking', 'text' => 'We lopen samen door hoe u nu werkt: welke lijsten er zijn, wie wat doet en waar het knelt.', 'time' => null],
                        ['title' => 'Klikbaar prototype', 'text' => 'U ziet eerst een werkende eerste versie met voorbeelddata, zoals de demo hierboven, en stuurt bij.', 'time' => null],
                        ['title' => 'Bouwen in rondes', 'text' => 'Ik bouw in korte rondes. Na elke ronde ziet u een werkende versie en kunnen we prioriteiten schuiven.', 'time' => null],
                        ['title' => 'Live en doorontwikkelen', 'text' => 'Uw bestaande gegevens gaan over, uw team gaat ermee aan de slag en ik blijf beschikbaar voor uitbreidingen.', 'time' => null],
                    ],
                ],
                'pricing' => [
                    'title' => 'Wat kost een adminpaneel?',
                    'intro' => 'Vaak begint het met een compacte eerste versie die daarna meegroeit. Na een gratis kennismaking ontvangt u een vaste prijs.',
                    'drivers' => [
                        'Hoeveel soorten gegevens en schermen er nodig zijn',
                        'Rollen, rechten en wie wat mag zien',
                        'Koppelingen met bestaande systemen',
                        'Het overzetten van bestaande gegevens',
                        'Rapportages en exports',
                    ],
                    'note' => null,
                ],
                'faq' => [
                    ['q' => 'Wat kost een adminpaneel laten maken?', 'a' => 'Dat hangt af van het aantal schermen, rollen en koppelingen. Na een gratis kennismaking ontvangt u een vaste prijs. Vaak begint het met een compacte eerste versie die daarna meegroeit.'],
                    ['q' => 'Waarom geen standaardpakket?', 'a' => 'Als een bestaand pakket goed past, raad ik dat eerlijk aan. Maatwerk loont wanneer u uw werkwijze zou moeten aanpassen aan de software, of betaalt voor veel functies die u niet gebruikt.'],
                    ['q' => 'Kunnen mijn bestaande Excel-gegevens erin?', 'a' => 'Ja. Ik zet uw bestaande lijsten over naar het nieuwe systeem en controleer samen met u of alles klopt voordat u overstapt.'],
                    ['q' => 'Kan ik bepalen wie wat mag zien?', 'a' => 'Ja. Met rollen en rechten bepaalt u per medewerker wat die kan zien en wijzigen.'],
                    ['q' => 'Werkt het ook op een tablet of telefoon?', 'a' => 'Het adminpaneel draait in de browser, dus er is niets te installeren. Schermen voor onderweg, zoals een lijst of een detailweergave, maak ik geschikt voor tablet en telefoon. Voor uitgebreide overzichten werkt een groter scherm het prettigst.'],
                    ['q' => 'Is mijn data veilig?', 'a' => 'Ik bouw met een eigen inlog per gebruiker, versleutelde verbindingen en rechten per rol. Hosting in de EU is mogelijk. U blijft eigenaar van de data en van de code.'],
                    ['q' => 'Wie is eigenaar van de code?', 'a' => 'U. Na oplevering ontvangt u de volledige broncode en documentatie, zodat u niet vastzit aan één leverancier.'],
                ],
                'contact' => [
                    'title' => 'Plan een gratis gesprek over uw adminpaneel',
                    'intro' => 'Vertel kort hoe u nu werkt en waar het knelt. Ik reageer binnen 1 werkdag.',
                ],
            ],

            'en' => [
                'meta' => [
                    'title' => 'Custom admin panel development | DevAim Labs',
                    'description' => 'A custom admin panel for your customers, planning, orders or stock. One overview with roles and permissions instead of scattered spreadsheets. Try the demo.',
                ],
                'name' => 'Admin panels',
                'summary' => 'Manage customers, orders or planning in one place instead of scattered spreadsheets.',
                'hero' => [
                    'eyebrow' => 'Admin panels',
                    'title' => 'Custom admin panel',
                    'title_em' => 'development',
                    'subtitle' => 'Do you track customers, appointments or orders in separate spreadsheets, emails and notes? I build a custom admin panel where you and your team manage, search and update everything in one place.',
                ],
                'demo' => [
                    'business' => 'Vonkel',
                    'url_label' => 'beheer.vonkel.nl (example)',
                    'title' => 'Work orders, planning and permissions for a fictional installation company',
                    'try' => 'Try it: press Ctrl+K (⌘K) and search for a customer, filter by status, select a few rows, or switch to \'Monteur\' (technician) at the bottom left and see what disappears. The same pattern works for customers, orders, appointments, cases or stock. The demo itself is in Dutch.',
                    'iframe_title' => 'Live example: admin panel with work orders, detail panel and permissions of the fictional business Vonkel',
                    'alt' => 'Screenshot of the example admin panel with work orders, detail panel and permissions of the fictional business Vonkel',
                ],
                'deliverables' => [
                    'title' => 'One place for your data and your team',
                    'intro' => 'Built around how you work, not the other way round. You can see most of it in the demo.',
                    'items' => [
                        ['icon' => 'layout-dashboard', 'title' => 'Everything in one overview', 'text' => 'Your data in one clear list, instead of spread across files and inboxes.', 'demo' => 'The work order list with saved views.'],
                        ['icon' => 'search', 'title' => 'Search and filter', 'text' => 'Find what you need in seconds, by name, status, date or any field that matters to you.', 'demo' => 'The search box, filter chips and Ctrl+K.'],
                        ['icon' => 'check', 'title' => 'Statuses and actions', 'text' => 'Change a status, assign work or update several rows at once, and always see where things stand.', 'demo' => 'Click a status label, or select rows for bulk actions.'],
                        ['icon' => 'user', 'title' => 'Detail view with history', 'text' => 'Everything about a customer or order together, including notes and earlier activity.', 'demo' => 'Click a row: assign, notes and activity.'],
                        ['icon' => 'shield-check', 'title' => 'Roles and permissions', 'text' => 'Everyone sees and does only what fits their role. Optionally with a log of who changed what.', 'demo' => '"Team en rechten", and "Bekijk als" at the bottom left.'],
                        ['icon' => 'workflow', 'title' => 'Links with your systems', 'text' => 'Data from your website, calendar or accounting comes in automatically, with no retyping.', 'demo' => null],
                    ],
                ],
                'fit' => [
                    'good' => [
                        'You track customers, orders, appointments or stock in spreadsheets or separate tools.',
                        'Several people work with the same data and you want to avoid errors and double work.',
                        'Off-the-shelf software doesn\'t quite fit how your business works.',
                    ],
                    'bad' => [
                        'An existing package already does almost everything you need: configuring it is cheaper than building.',
                        'You only need a shared spreadsheet for a few people.',
                    ],
                ],
                'proof' => null,
                'process' => [
                    'title' => 'See it first, then build',
                    'intro' => 'You see a working version early, so the system fits how you really work.',
                    'steps' => [
                        ['title' => 'Intro', 'text' => 'We walk through how you work now: which lists exist, who does what and where it gets stuck.', 'time' => null],
                        ['title' => 'Clickable prototype', 'text' => 'You first see a working first version with example data, like the demo above, and steer it.', 'time' => null],
                        ['title' => 'Build in rounds', 'text' => 'I build in short rounds. After each round you see a working version and we can shift priorities.', 'time' => null],
                        ['title' => 'Launch and grow', 'text' => 'Your existing data moves over, your team starts using it and I stay available for extensions.', 'time' => null],
                    ],
                ],
                'pricing' => [
                    'title' => 'What does an admin panel cost?',
                    'intro' => 'It often starts with a compact first version that grows over time. After a free intro call you get a fixed price.',
                    'drivers' => [
                        'How many kinds of data and screens are needed',
                        'Roles, permissions and who may see what',
                        'Links with existing systems',
                        'Moving over existing data',
                        'Reports and exports',
                    ],
                    'note' => null,
                ],
                'faq' => [
                    ['q' => 'What does a custom admin panel cost?', 'a' => 'It depends on the number of screens, roles and integrations. After a free intro call you receive a fixed price. It often starts with a compact first version that grows over time.'],
                    ['q' => 'Why not an off-the-shelf package?', 'a' => 'If an existing package fits well, I will honestly recommend it. Custom work pays off when you would otherwise have to bend your way of working to the software, or pay for lots of features you don\'t use.'],
                    ['q' => 'Can my existing spreadsheet data go in?', 'a' => 'Yes. I move your existing lists into the new system and check with you that everything is correct before you switch.'],
                    ['q' => 'Can I control who sees what?', 'a' => 'Yes. With roles and permissions you decide per team member what they can see and change.'],
                    ['q' => 'Does it work on a tablet or phone?', 'a' => 'The admin panel runs in the browser, so there is nothing to install. Screens for on the go, such as a list or a detail view, I make work on tablet and phone. For large overviews a bigger screen works best.'],
                    ['q' => 'Is my data safe?', 'a' => 'I build with a personal login per user, encrypted connections and permissions per role. Hosting in the EU is possible. You remain the owner of the data and the code.'],
                    ['q' => 'Who owns the code?', 'a' => 'You do. After delivery you receive the complete source code and documentation, so you are not locked into one vendor.'],
                ],
                'contact' => [
                    'title' => 'Book a free call about your admin panel',
                    'intro' => 'Briefly describe how you work now and where it gets stuck. I reply within 1 working day.',
                ],
            ],
        ],

        /* ---------------------------------------------------------------- */
        'dashboards' => [
            'slugs' => ['nl' => 'dashboards', 'en' => 'dashboards'],
            'icon' => 'chart',
            'project_type' => 'dashboard',
            'package' => 'maatwerk',
            'schema_type' => 'Business intelligence dashboard development',
            'demo' => [
                'src' => '/demo/kpi-dashboard.html',
                'image' => '/service-previews/kpi.webp',
                'width' => 1600,
                'height' => 956,
                'desktop_only' => true,
            ],
            'related' => ['admin-panels', 'api-integrations'],

            'nl' => [
                'meta' => [
                    'title' => 'KPI-dashboard laten maken | Cijfers op één plek | DevAim Labs',
                    'description' => 'KPI-dashboard laten maken met omzet, orders en trends uit uw eigen systemen, automatisch bijgewerkt. Geen handwerk in Excel meer. Bekijk de live demo.',
                ],
                'name' => 'KPI-dashboards',
                'summary' => 'Omzet, orders en trends in één oogopslag, automatisch bijgewerkt.',
                'hero' => [
                    'eyebrow' => 'KPI-dashboards',
                    'title' => 'KPI-dashboard',
                    'title_em' => 'laten maken',
                    'subtitle' => 'Kost het u elke week uren om cijfers uit verschillende systemen bij elkaar te zoeken? Ik bouw een dashboard dat uw belangrijkste cijfers automatisch op één scherm zet, zodat u sneller ziet hoe het gaat.',
                ],
                'demo' => [
                    'business' => 'Zevenster Fietsen',
                    'url_label' => 'dashboard.zevensterfietsen.nl (voorbeeld)',
                    'title' => 'Het KPI-commandocentrum van een fictieve keten met 6 fietswinkels',
                    'try' => 'Probeer: wissel tussen 7 dagen en 12 maanden, filter op een vestiging en klik bij de afwijking op \'Bekijk in grafiek\'. Voor uw bedrijf kunnen het ook aanvragen, afspraken, uren of voorraad zijn.',
                    'iframe_title' => 'Live voorbeeld: KPI-commandocentrum van fictief bedrijf Zevenster Fietsen',
                    'alt' => 'Schermafbeelding van het voorbeeld-KPI-dashboard van fictief bedrijf Zevenster Fietsen, met KPI-kaarten, omzetgrafiek en vestigingen',
                ],
                'deliverables' => [
                    'title' => 'De cijfers die u nodig heeft, zonder handwerk',
                    'intro' => 'Een dashboard dat antwoord geeft op uw vragen. Elk onderdeel hieronder ziet u terug in de demo.',
                    'items' => [
                        ['icon' => 'gauge', 'title' => 'De KPI\'s die voor u tellen', 'text' => 'We kiezen samen de cijfers die bij uw doelen horen, in plaats van alles wat meetbaar is.', 'demo' => 'De vier KPI-kaarten bovenaan, met trendlijn en verandering t.o.v. de vorige periode.'],
                        ['icon' => 'trending-up', 'title' => 'Trends in grafieken', 'text' => 'Omzet, orders of aanvragen per dag, week of maand, zodat u ziet waar het heen gaat.', 'demo' => 'De grafiek met omzet, bestellingen of conversie, naast de vorige periode.'],
                        ['icon' => 'clock', 'title' => 'Periodes vergelijken', 'text' => 'Met één klik schakelen tussen de afgelopen week, maand, kwartaal of jaar.', 'demo' => 'De periodekeuze: 7d, 30d, 90d of 12m.'],
                        ['icon' => 'search', 'title' => 'Van totaal naar detail', 'text' => 'Vanuit een cijfer of afwijking doorklikken naar wat erachter zit.', 'demo' => 'Klik op een vestiging in de ranglijst, of op \'Bekijk in grafiek\' bij de afwijking.'],
                        ['icon' => 'chart', 'title' => 'Inzicht per kanaal of vestiging', 'text' => 'Zien welk kanaal, product, team of welke vestiging het meest bijdraagt.', 'demo' => 'De blokken \'Omzet per kanaal\' en \'Vestigingen op omzet\'.'],
                        ['icon' => 'workflow', 'title' => 'Automatisch bijgewerkt', 'text' => 'Gegevens komen rechtstreeks uit uw webshop, kassa, CRM of boekhouding. Geen exporteren en plakken meer.', 'demo' => '\'Bijgewerkt 09:41\' bovenaan en de live bestellingen rechtsonder.'],
                    ],
                ],
                'fit' => [
                    'good' => [
                        'U verzamelt nu elke week of maand met de hand cijfers uit meerdere systemen.',
                        'U wilt sneller zien hoe het gaat, zonder op een rapportage te wachten.',
                        'Uw gegevens staan in systemen met een API of export, zoals een webshop, kassa, CRM of boekhouding.',
                    ],
                    'bad' => [
                        'Uw huidige software heeft al een rapportage die precies laat zien wat u nodig heeft.',
                        'Er zijn nog geen digitale gegevens om te tonen: dan is een adminpaneel of koppeling de logische eerste stap.',
                    ],
                ],
                'proof' => null,
                'process' => [
                    'title' => 'Van vraag naar dashboard',
                    'intro' => 'We beginnen bij de beslissingen die u wilt nemen, niet bij de grafieken.',
                    'steps' => [
                        ['title' => 'Kennismaking', 'text' => 'Welke beslissingen wilt u met het dashboard nemen, en welke cijfers heeft u daarvoor nodig?', 'time' => null],
                        ['title' => 'Data in kaart', 'text' => 'Ik bekijk waar uw gegevens staan en hoe ze betrouwbaar binnenkomen.', 'time' => null],
                        ['title' => 'Prototype met voorbeelddata', 'text' => 'U ziet een klikbare eerste versie met voorbeelddata en stuurt bij op inhoud en indeling.', 'time' => null],
                        ['title' => 'Live met echte data', 'text' => 'Het dashboard wordt gekoppeld aan uw systemen en blijft daarna automatisch bijgewerkt.', 'time' => null],
                    ],
                ],
                'pricing' => [
                    'title' => 'Wat kost een KPI-dashboard?',
                    'intro' => 'De prijs hangt vooral af van waar uw gegevens vandaan komen. Na een gratis kennismaking ontvangt u een vaste prijs.',
                    'drivers' => [
                        'Het aantal gegevensbronnen en koppelingen',
                        'Hoe vaak de cijfers ververst moeten worden',
                        'Het aantal schermen, KPI\'s en filters',
                        'Toegang per gebruiker of team',
                        'Hoe schoon en consistent uw bestaande gegevens zijn',
                    ],
                    'note' => null,
                ],
                'faq' => [
                    ['q' => 'Wat kost een KPI-dashboard laten maken?', 'a' => 'Dat hangt vooral af van het aantal gegevensbronnen en koppelingen. Na een gratis kennismaking ontvangt u een vaste prijs.'],
                    ['q' => 'Is Power BI of Looker Studio niet genoeg?', 'a' => 'Soms wel, en dan zeg ik dat ook. Een dashboard op maat loont als u cijfers wilt combineren uit systemen zonder standaardkoppeling, als het precies moet aansluiten op uw werkwijze, of als het in uw eigen omgeving moet draaien.'],
                    ['q' => 'Uit welke systemen kan de data komen?', 'a' => 'Uit vrijwel elk systeem met een API of export: webshops, kassasystemen, CRM, boekhouding, betaalproviders zoals Mollie en Stripe, of uw eigen database.'],
                    ['q' => 'Hoe actueel zijn de cijfers?', 'a' => 'Dat bepaalt u. Vaak worden gegevens elk uur of elke nacht bijgewerkt; waar het nodig is, kan het vrijwel direct via webhooks.'],
                    ['q' => 'Kan ik bepalen wie wat ziet?', 'a' => 'Ja. U stelt per gebruiker of team in welke cijfers zichtbaar zijn.'],
                    ['q' => 'Werkt het dashboard op mijn telefoon?', 'a' => 'De belangrijkste cijfers maak ik goed leesbaar op de telefoon. Voor grafieken en tabellen werkt een groter scherm het prettigst, net als bij de demo.'],
                    ['q' => 'Wat als ik later andere cijfers wil zien?', 'a' => 'Dan breiden we het dashboard uit. De code is van u, dus u zit niet vast aan één leverancier.'],
                ],
                'contact' => [
                    'title' => 'Plan een gratis gesprek over uw dashboard',
                    'intro' => 'Vertel kort welke cijfers u nu bij elkaar zoekt en waar ze staan. Ik reageer binnen 1 werkdag.',
                ],
            ],

            'en' => [
                'meta' => [
                    'title' => 'Custom KPI dashboard development | DevAim Labs',
                    'description' => 'A custom KPI dashboard with revenue, orders and trends from your own systems, updated automatically. No more manual spreadsheet work. Try the live demo.',
                ],
                'name' => 'KPI dashboards',
                'summary' => 'Revenue, orders and trends at a glance, updated automatically.',
                'hero' => [
                    'eyebrow' => 'KPI dashboards',
                    'title' => 'Custom KPI dashboard',
                    'title_em' => 'development',
                    'subtitle' => 'Do you spend hours every week pulling numbers together from different systems? I build a dashboard that puts your key figures on one screen automatically, so you see how things are going sooner.',
                ],
                'demo' => [
                    'business' => 'Zevenster Fietsen',
                    'url_label' => 'dashboard.zevensterfietsen.nl (example)',
                    'title' => 'The KPI command centre of a fictional chain of 6 bike shops',
                    'try' => 'Try it: switch between 7 days and 12 months, filter by a shop and click "Bekijk in grafiek" (view in chart) on the anomaly. For your business it could be enquiries, appointments, hours or stock instead. The demo itself is in Dutch.',
                    'iframe_title' => 'Live example: KPI command centre of the fictional business Zevenster Fietsen',
                    'alt' => 'Screenshot of the example KPI dashboard of the fictional business Zevenster Fietsen, with KPI cards, a revenue chart and shop rankings',
                ],
                'deliverables' => [
                    'title' => 'The numbers you need, without manual work',
                    'intro' => 'A dashboard that answers your questions. You can see every part below in the demo.',
                    'items' => [
                        ['icon' => 'gauge', 'title' => 'The KPIs that matter to you', 'text' => 'Together we choose the figures that fit your goals, instead of everything that can be measured.', 'demo' => 'The four KPI cards at the top, with a trend line and the change against the previous period.'],
                        ['icon' => 'trending-up', 'title' => 'Trends in charts', 'text' => 'Revenue, orders or enquiries per day, week or month, so you see where things are heading.', 'demo' => 'The chart with revenue, orders or conversion, next to the previous period.'],
                        ['icon' => 'clock', 'title' => 'Compare periods', 'text' => 'Switch between the last week, month, quarter or year in one click.', 'demo' => 'The period picker: 7d, 30d, 90d or 12m.'],
                        ['icon' => 'search', 'title' => 'From total to detail', 'text' => 'Click through from a figure or an anomaly to what lies behind it.', 'demo' => 'Click a shop in the ranking, or "Bekijk in grafiek" on the anomaly.'],
                        ['icon' => 'chart', 'title' => 'Insight per channel or location', 'text' => 'See which channel, product, team or location contributes most.', 'demo' => 'The "Omzet per kanaal" and "Vestigingen op omzet" blocks.'],
                        ['icon' => 'workflow', 'title' => 'Updated automatically', 'text' => 'Data comes straight from your webshop, till, CRM or accounting. No more exporting and pasting.', 'demo' => '"Bijgewerkt 09:41" at the top and the live orders at the bottom right.'],
                    ],
                ],
                'fit' => [
                    'good' => [
                        'You pull together figures from several systems by hand every week or month.',
                        'You want to see how things are going sooner, without waiting for a report.',
                        'Your data lives in systems with an API or export, such as a webshop, till, CRM or accounting.',
                    ],
                    'bad' => [
                        'Your current software already has a report that shows exactly what you need.',
                        'There is no digital data to show yet: then an admin panel or integration is the logical first step.',
                    ],
                ],
                'proof' => null,
                'process' => [
                    'title' => 'From question to dashboard',
                    'intro' => 'We start with the decisions you want to make, not with the charts.',
                    'steps' => [
                        ['title' => 'Intro', 'text' => 'Which decisions do you want to make with the dashboard, and which figures do you need for them?', 'time' => null],
                        ['title' => 'Map the data', 'text' => 'I look at where your data lives and how it can come in reliably.', 'time' => null],
                        ['title' => 'Prototype with example data', 'text' => 'You see a clickable first version with example data and steer the content and layout.', 'time' => null],
                        ['title' => 'Live with real data', 'text' => 'The dashboard is connected to your systems and stays up to date automatically.', 'time' => null],
                    ],
                ],
                'pricing' => [
                    'title' => 'What does a KPI dashboard cost?',
                    'intro' => 'The price mostly depends on where your data comes from. After a free intro call you get a fixed price.',
                    'drivers' => [
                        'The number of data sources and integrations',
                        'How often the figures need refreshing',
                        'The number of screens, KPIs and filters',
                        'Access per user or team',
                        'How clean and consistent your existing data is',
                    ],
                    'note' => null,
                ],
                'faq' => [
                    ['q' => 'What does a custom KPI dashboard cost?', 'a' => 'It mostly depends on the number of data sources and integrations. After a free intro call you receive a fixed price.'],
                    ['q' => 'Isn\'t Power BI or Looker Studio enough?', 'a' => 'Sometimes it is, and then I will say so. A custom dashboard pays off when you want to combine figures from systems without a standard connector, when it has to fit your way of working exactly, or when it has to run in your own environment.'],
                    ['q' => 'Which systems can the data come from?', 'a' => 'From almost any system with an API or export: webshops, till systems, CRM, accounting, payment providers such as Mollie and Stripe, or your own database.'],
                    ['q' => 'How up to date are the figures?', 'a' => 'You decide. Data is often refreshed every hour or every night; where needed, it can be near real time through webhooks.'],
                    ['q' => 'Can I control who sees what?', 'a' => 'Yes. You set per user or team which figures are visible.'],
                    ['q' => 'Does the dashboard work on my phone?', 'a' => 'I make the key figures easy to read on a phone. For charts and tables a bigger screen works best, as with the demo.'],
                    ['q' => 'What if I want to see other figures later?', 'a' => 'Then we extend the dashboard. The code is yours, so you are not locked into one vendor.'],
                ],
                'contact' => [
                    'title' => 'Book a free call about your dashboard',
                    'intro' => 'Briefly describe which figures you pull together now and where they live. I reply within 1 working day.',
                ],
            ],
        ],

        /* ---------------------------------------------------------------- */
        'payments' => [
            'slugs' => ['nl' => 'betalingen', 'en' => 'payments'],
            'icon' => 'credit-card',
            'project_type' => 'betalingen',
            'package' => 'maatwerk',
            'schema_type' => 'Payment integration',
            'demo' => [
                'src' => '/demo/betaalsysteem.html',
                'image' => '/service-previews/betaal.webp',
                'width' => 1600,
                'height' => 956,
                'desktop_only' => false,
            ],
            'related' => ['websites', 'api-integrations'],

            'nl' => [
                'meta' => [
                    'title' => 'Betaalsysteem laten maken | Mollie & Stripe | DevAim Labs',
                    'description' => 'Online betalingen, abonnementen en facturen via Mollie of Stripe, gekoppeld aan uw website of systeem. Met webhooks en foutafhandeling. Bekijk de live demo.',
                ],
                'name' => 'Betalingen',
                'summary' => 'Betalingen, abonnementen en facturen via Mollie of Stripe, inclusief foutafhandeling.',
                'hero' => [
                    'eyebrow' => 'Betalingen',
                    'title' => 'Betaalsysteem',
                    'title_em' => 'laten maken',
                    'subtitle' => 'Wilt u online betalingen ontvangen, abonnementen aanbieden of facturen automatisch versturen? Ik koppel Mollie of Stripe aan uw website of systeem, inclusief alles wat er achter de schermen moet gebeuren.',
                ],
                'demo' => [
                    'business' => 'Ovenlicht Keramiekstudio',
                    'url_label' => 'ovenlicht.nl (voorbeeld)',
                    'title' => 'Checkout met iDEAL en creditcard voor een fictieve keramiekstudio',
                    'try' => 'Probeer: kies een lidmaatschap, vul voorbeeldgegevens in en betaal met iDEAL of testkaart 4242 4242 4242 4242. Probeer ook kortingscode WELKOM10 of de geweigerde kaart 4000 0000 0000 0002. Testmodus: er wordt niets afgeschreven. Dezelfde checkout werkt voor abonnementen, cursussen, tickets of producten.',
                    'iframe_title' => 'Live voorbeeld: checkout van fictief bedrijf Ovenlicht Keramiekstudio',
                    'alt' => 'Schermafbeelding van de voorbeeld-checkout van Ovenlicht Keramiekstudio, met betaalstap, kaartvoorbeeld en besteloverzicht',
                ],
                'deliverables' => [
                    'title' => 'Betalingen die gewoon kloppen',
                    'intro' => 'Van de betaalknop tot de factuur in uw administratie. Een deel ziet u terug in de demo.',
                    'items' => [
                        ['icon' => 'credit-card', 'title' => 'Een checkout die vertrouwen geeft', 'text' => 'Een duidelijke betaalstap in uw eigen huisstijl, met de betaalmethoden die uw klanten verwachten, zoals iDEAL en creditcard.', 'demo' => 'De betaalstap met iDEAL, creditcard en het besteloverzicht ernaast.'],
                        ['icon' => 'clock', 'title' => 'Abonnementen', 'text' => 'Maandelijks of jaarlijks afschrijven, van plan wisselen en opzeggen, zonder handwerk.', 'demo' => 'De keuze tussen maandelijks en jaarlijks, met de besparing erbij.'],
                        ['icon' => 'mail', 'title' => 'Facturen automatisch', 'text' => 'Na elke betaling een factuur met btw-specificatie, die uw klant zelf kan downloaden.', 'demo' => '\'Download factuur\' na een geslaagde betaling.'],
                        ['icon' => 'check', 'title' => 'Btw en bedragen correct', 'text' => 'Subtotaal, btw en totaal kloppen altijd, ook bij kortingen of een planwijziging.', 'demo' => 'Kortingscode WELKOM10: subtotaal, btw (21%) en totaal rekenen mee.'],
                        ['icon' => 'workflow', 'title' => 'Webhooks en foutafhandeling', 'text' => 'Uw systeem weet direct of een betaling gelukt, mislukt of teruggeboekt is. Mislukte afschrijvingen worden opnieuw geprobeerd.', 'demo' => 'De geweigerde testkaart en \'Weigeren\' in het bankscherm, met een duidelijke vervolgstap.'],
                        ['icon' => 'shield-check', 'title' => 'Betaalgegevens bij de provider', 'text' => 'Kaartgegevens gaan rechtstreeks naar Mollie of Stripe en komen niet op uw server.', 'demo' => null],
                    ],
                ],
                'fit' => [
                    'good' => [
                        'U wilt online betalingen ontvangen op uw website of in uw eigen systeem.',
                        'U verkoopt abonnementen, lidmaatschappen, cursussen of diensten met terugkerende betalingen.',
                        'U wilt dat betalingen, facturen en uw administratie automatisch op elkaar aansluiten.',
                    ],
                    'bad' => [
                        'Een betaallink per e-mail is genoeg: die maakt u direct in het dashboard van Mollie of Stripe.',
                        'Uw webshopplatform heeft een kant-en-klare betaalplugin die al doet wat u nodig heeft.',
                    ],
                ],
                'proof' => null,
                'process' => [
                    'title' => 'Zorgvuldig, want het gaat om geld',
                    'intro' => 'Elke stap wordt eerst in een testomgeving doorlopen, ook wat er gebeurt als het misgaat.',
                    'steps' => [
                        ['title' => 'Kennismaking', 'text' => 'Welke producten of abonnementen, welke betaalmethoden en wat moet er na een betaling gebeuren?', 'time' => null],
                        ['title' => 'Betaalstroom uitgetekend', 'text' => 'Ik teken de stappen uit, inclusief wat er gebeurt als een betaling mislukt of wordt teruggeboekt.', 'time' => null],
                        ['title' => 'Bouwen en testen', 'text' => 'Ik bouw in de testomgeving van Mollie of Stripe en test elk scenario, ook de randgevallen.', 'time' => null],
                        ['title' => 'Live en bewaken', 'text' => 'Na de livegang houd ik de eerste betalingen in de gaten en blijf ik beschikbaar voor aanpassingen.', 'time' => null],
                    ],
                ],
                'pricing' => [
                    'title' => 'Wat kost een betaalkoppeling?',
                    'intro' => 'De prijs hangt af van wat er rond de betaling moet gebeuren. Na een gratis kennismaking ontvangt u een vaste prijs.',
                    'drivers' => [
                        'Eenmalige betalingen of ook abonnementen',
                        'Het aantal producten, plannen en kortingsregels',
                        'Facturen en een koppeling met uw boekhouding',
                        'Een eigen checkout of de betaalpagina van Mollie of Stripe',
                        'Het systeem waarin de betalingen moeten landen',
                    ],
                    'note' => 'De transactiekosten van Mollie of Stripe betaalt u rechtstreeks aan de betaalprovider.',
                ],
                'faq' => [
                    ['q' => 'Wat kost een betaalkoppeling laten maken?', 'a' => 'Dat hangt af van eenmalige of terugkerende betalingen, facturatie en het systeem waarin het moet landen. Na een gratis kennismaking ontvangt u een vaste prijs. De transactiekosten betaalt u rechtstreeks aan Mollie of Stripe.'],
                    ['q' => 'Mollie of Stripe: wat past bij mij?', 'a' => 'Beide zijn betrouwbaar en ondersteunen onder meer iDEAL, creditcard en abonnementen. Mollie is een Nederlandse aanbieder met een sterke focus op Europese betaalmethoden; Stripe is breed internationaal inzetbaar. Ik adviseer op basis van uw klanten en uw plannen.'],
                    ['q' => 'Wat gebeurt er als een betaling mislukt?', 'a' => 'Uw systeem krijgt via een webhook direct bericht. Bij abonnementen kan een mislukte afschrijving automatisch opnieuw worden geprobeerd en krijgt de klant een melding, zodat u niet zelf hoeft na te bellen.'],
                    ['q' => 'Komen kaartgegevens op mijn server?', 'a' => 'Nee. Betaalgegevens worden rechtstreeks door Mollie of Stripe verwerkt. Uw systeem ontvangt alleen de status van de betaling.'],
                    ['q' => 'Kan ik abonnementen aanbieden?', 'a' => 'Ja: maandelijkse of jaarlijkse plannen, proefperiodes, van plan wisselen en opzeggen, met automatische facturen.'],
                    ['q' => 'Kan het gekoppeld worden aan mijn boekhouding?', 'a' => 'Ja. Betalingen en facturen kunnen via een API-koppeling automatisch in uw boekhoudpakket terechtkomen.'],
                ],
                'contact' => [
                    'title' => 'Plan een gratis gesprek over uw betalingen',
                    'intro' => 'Vertel kort wat u wilt verkopen en waar de betalingen moeten landen. Ik reageer binnen 1 werkdag.',
                ],
            ],

            'en' => [
                'meta' => [
                    'title' => 'Payment integration with Mollie and Stripe | DevAim Labs',
                    'description' => 'Online payments, subscriptions and invoices via Mollie or Stripe, connected to your website or system. Including webhooks and error handling. Try the live demo.',
                ],
                'name' => 'Payments',
                'summary' => 'Payments, subscriptions and invoices via Mollie or Stripe, including error handling.',
                'hero' => [
                    'eyebrow' => 'Payments',
                    'title' => 'Payment integration',
                    'title_em' => 'with Mollie and Stripe',
                    'subtitle' => 'Do you want to take payments online, offer subscriptions or send invoices automatically? I connect Mollie or Stripe to your website or system, including everything that has to happen behind the scenes.',
                ],
                'demo' => [
                    'business' => 'Ovenlicht Keramiekstudio',
                    'url_label' => 'ovenlicht.nl (example)',
                    'title' => 'Checkout with iDEAL and cards for a fictional ceramics studio',
                    'try' => 'Try it: pick a membership, fill in example details and pay with iDEAL or test card 4242 4242 4242 4242. Also try discount code WELKOM10 or the declined card 4000 0000 0000 0002. Test mode: nothing is charged. The same checkout works for subscriptions, courses, tickets or products. The demo itself is in Dutch.',
                    'iframe_title' => 'Live example: checkout of the fictional business Ovenlicht Keramiekstudio',
                    'alt' => 'Screenshot of the example checkout of Ovenlicht Keramiekstudio, with the payment step, card preview and order summary',
                ],
                'deliverables' => [
                    'title' => 'Payments that simply add up',
                    'intro' => 'From the pay button to the invoice in your books. You can see part of it in the demo.',
                    'items' => [
                        ['icon' => 'credit-card', 'title' => 'A checkout people trust', 'text' => 'A clear payment step in your own branding, with the methods your customers expect, such as iDEAL and cards.', 'demo' => 'The payment step with iDEAL, card and the order summary alongside.'],
                        ['icon' => 'clock', 'title' => 'Subscriptions', 'text' => 'Monthly or yearly billing, switching plans and cancelling, without manual work.', 'demo' => 'The choice between monthly and yearly, with the saving shown.'],
                        ['icon' => 'mail', 'title' => 'Automatic invoices', 'text' => 'An invoice with VAT breakdown after every payment, which your customer can download.', 'demo' => '"Download factuur" (download invoice) after a successful payment.'],
                        ['icon' => 'check', 'title' => 'Correct VAT and totals', 'text' => 'Subtotal, VAT and total always add up, including discounts and plan changes.', 'demo' => 'Discount code WELKOM10: subtotal, VAT (21%) and total update with it.'],
                        ['icon' => 'workflow', 'title' => 'Webhooks and error handling', 'text' => 'Your system knows right away whether a payment succeeded, failed or was charged back. Failed charges are retried.', 'demo' => 'The declined test card and "Weigeren" (decline) in the bank screen, with a clear next step.'],
                        ['icon' => 'shield-check', 'title' => 'Card data stays with the provider', 'text' => 'Card details go straight to Mollie or Stripe and never touch your server.', 'demo' => null],
                    ],
                ],
                'fit' => [
                    'good' => [
                        'You want to take payments on your website or in your own system.',
                        'You sell subscriptions, memberships, courses or services with recurring payments.',
                        'You want payments, invoices and your bookkeeping to line up automatically.',
                    ],
                    'bad' => [
                        'A payment link by email is enough: you can create one directly in the Mollie or Stripe dashboard.',
                        'Your shop platform has a ready-made payment plugin that already does what you need.',
                    ],
                ],
                'proof' => null,
                'process' => [
                    'title' => 'Careful, because it is about money',
                    'intro' => 'Every step is run through in a test environment first, including what happens when things go wrong.',
                    'steps' => [
                        ['title' => 'Intro', 'text' => 'Which products or plans, which payment methods and what should happen after a payment?', 'time' => null],
                        ['title' => 'Payment flow mapped', 'text' => 'I map out the steps, including what happens when a payment fails or is charged back.', 'time' => null],
                        ['title' => 'Build and test', 'text' => 'I build in the Mollie or Stripe test environment and test every scenario, edge cases included.', 'time' => null],
                        ['title' => 'Launch and monitor', 'text' => 'After launch I keep an eye on the first payments and stay available for changes.', 'time' => null],
                    ],
                ],
                'pricing' => [
                    'title' => 'What does a payment integration cost?',
                    'intro' => 'The price depends on what needs to happen around the payment. After a free intro call you get a fixed price.',
                    'drivers' => [
                        'One-off payments or subscriptions too',
                        'The number of products, plans and discount rules',
                        'Invoices and a link with your accounting',
                        'A custom checkout or the Mollie or Stripe hosted payment page',
                        'The system the payments need to land in',
                    ],
                    'note' => 'You pay the Mollie or Stripe transaction fees directly to the payment provider.',
                ],
                'faq' => [
                    ['q' => 'What does a payment integration cost?', 'a' => 'It depends on one-off or recurring payments, invoicing and the system it needs to land in. After a free intro call you receive a fixed price. You pay transaction fees directly to Mollie or Stripe.'],
                    ['q' => 'Mollie or Stripe: which fits me?', 'a' => 'Both are reliable and support iDEAL, cards and subscriptions, among others. Mollie is a Dutch provider with a strong focus on European payment methods; Stripe is broadly international. I advise based on your customers and your plans.'],
                    ['q' => 'What happens when a payment fails?', 'a' => 'Your system is notified right away through a webhook. For subscriptions a failed charge can be retried automatically and the customer gets a message, so you don\'t have to chase it yourself.'],
                    ['q' => 'Does card data end up on my server?', 'a' => 'No. Payment details are processed directly by Mollie or Stripe. Your system only receives the status of the payment.'],
                    ['q' => 'Can I offer subscriptions?', 'a' => 'Yes: monthly or yearly plans, trial periods, switching plans and cancelling, with automatic invoices.'],
                    ['q' => 'Can it be linked to my accounting?', 'a' => 'Yes. Payments and invoices can flow into your accounting software automatically through an API integration.'],
                ],
                'contact' => [
                    'title' => 'Book a free call about your payments',
                    'intro' => 'Briefly describe what you want to sell and where the payments need to land. I reply within 1 working day.',
                ],
            ],
        ],

        /* ---------------------------------------------------------------- */
        'api-integrations' => [
            'slugs' => ['nl' => 'api-integraties', 'en' => 'api-integrations'],
            'icon' => 'workflow',
            'project_type' => 'api',
            'package' => 'maatwerk',
            'schema_type' => 'System integration',
            // No demo: an integration has no UI of its own. The page shows
            // an illustrated data flow with an example sync log instead.
            'demo' => null,
            'related' => ['payments', 'dashboards'],

            'nl' => [
                'meta' => [
                    'title' => 'API-koppeling laten maken | Systemen koppelen | DevAim Labs',
                    'description' => 'API-koppeling laten maken tussen uw webshop, betaalprovider, CRM en boekhouding. Geen dubbel overtypen meer, met logboek, meldingen en nieuwe pogingen.',
                ],
                'name' => 'API-koppelingen',
                'summary' => 'Uw systemen praten met elkaar: geen dubbel overtypen meer.',
                'hero' => [
                    'eyebrow' => 'API-koppelingen',
                    'title' => 'API-koppeling',
                    'title_em' => 'laten maken',
                    'subtitle' => 'Typt u gegevens twee keer over omdat uw systemen niet met elkaar praten? Ik bouw koppelingen die orders, klanten en facturen automatisch doorzetten, en die het merken als er iets misgaat.',
                ],
                'flow' => [
                    'eyebrow' => '// zo werkt een koppeling',
                    'title' => 'Van betaling tot boekhouding, zonder overtypen',
                    'try' => 'Voorbeeld: een klant betaalt in een webshop via Mollie. De koppeling maakt de factuur aan in de boekhouding en werkt het CRM bij. Is een systeem even onbereikbaar, dan probeert de koppeling het automatisch opnieuw.',
                    'diagram_label' => 'Schema: een betaling in de webshop gaat via de koppeling naar de boekhouding en het CRM.',
                    'nodes' => [
                        'source' => ['title' => 'Webshop', 'meta' => 'Betaling via Mollie'],
                        'hub' => ['title' => 'Koppeling', 'meta' => 'Controleert en zet door'],
                        'targets' => [
                            ['title' => 'Boekhouding', 'meta' => 'Factuur aangemaakt'],
                            ['title' => 'CRM', 'meta' => 'Klant bijgewerkt'],
                        ],
                    ],
                    'log_title' => 'Synclog',
                    'log_label' => 'Synclog met voorbeelddata',
                    'status' => ['ok' => 'Gelukt', 'retry' => 'Opnieuw geprobeerd'],
                    'log' => [
                        ['time' => '09:14:02', 'event' => 'Bestelling #1042 betaald', 'result' => 'Factuur aangemaakt in boekhouding', 'status' => 'ok'],
                        ['time' => '09:14:03', 'event' => 'Klantgegevens #1042', 'result' => 'CRM bijgewerkt', 'status' => 'ok'],
                        ['time' => '09:21:47', 'event' => 'Bestelling #1043 betaald', 'result' => 'Boekhouding tijdelijk onbereikbaar, na 30 sec. opnieuw geprobeerd', 'status' => 'retry'],
                        ['time' => '09:22:17', 'event' => 'Bestelling #1043', 'result' => 'Factuur aangemaakt (2e poging)', 'status' => 'ok'],
                        ['time' => '09:30:05', 'event' => 'Terugbetaling #1038', 'result' => 'Creditfactuur aangemaakt', 'status' => 'ok'],
                        ['time' => '09:41:19', 'event' => 'Nieuwe aanvraag via website', 'result' => 'Contact aangemaakt in CRM', 'status' => 'ok'],
                    ],
                    'before' => ['label' => 'Nu', 'text' => 'Gegevens twee keer invoeren, fouten zoeken en achteraf controleren.'],
                    'after' => ['label' => 'Met een koppeling', 'text' => 'Eén keer invoeren. De rest gaat automatisch, en u krijgt bericht als er iets misgaat.'],
                ],
                'deliverables' => [
                    'title' => 'Koppelingen die blijven werken',
                    'intro' => 'Een koppeling is pas goed als u er niet meer aan hoeft te denken. Een deel ziet u terug in het voorbeeld hierboven.',
                    'items' => [
                        ['icon' => 'workflow', 'title' => 'Geen dubbel werk meer', 'text' => 'Orders, klanten en facturen gaan automatisch van het ene systeem naar het andere.', 'demo' => 'De stip die van webshop via de koppeling naar boekhouding en CRM loopt.'],
                        ['icon' => 'clock', 'title' => 'Automatisch opnieuw proberen', 'text' => 'Is een systeem even onbereikbaar, dan probeert de koppeling het later opnieuw in plaats van gegevens kwijt te raken.', 'demo' => 'De regel "Opnieuw geprobeerd" in de synclog.'],
                        ['icon' => 'alert-circle', 'title' => 'Logboek en meldingen', 'text' => 'Elke synchronisatie wordt vastgelegd. Lukt iets echt niet, dan krijgt u of uw team een melding.', 'demo' => 'De synclog met tijd en status per regel.'],
                        ['icon' => 'trending-up', 'title' => 'Direct bij elke gebeurtenis', 'text' => 'Waar het kan, reageert de koppeling direct via webhooks, bijvoorbeeld op een betaling of een nieuwe aanvraag.', 'demo' => 'De betaling die meteen doorloopt naar de koppeling.'],
                        ['icon' => 'shield-check', 'title' => 'Veilig en gedocumenteerd', 'text' => 'API-sleutels veilig opgeslagen, alleen de rechten die nodig zijn, en documentatie zodat u niet van mij afhankelijk bent.', 'demo' => null],
                        ['icon' => 'check', 'title' => 'Onderhoud bij API-wijzigingen', 'text' => 'Verandert een leverancier zijn API, dan pas ik de koppeling op tijd aan.', 'demo' => null],
                    ],
                ],
                'fit' => [
                    'good' => [
                        'U of uw team typt gegevens over van het ene systeem naar het andere.',
                        'Uw webshop, kassa, CRM of boekhouding lopen uit de pas en u zoekt fouten achteraf.',
                        'Een standaardkoppeling bestaat niet, of doet net niet wat u nodig heeft.',
                    ],
                    'bad' => [
                        'Er is al een kant-en-klare koppeling die precies doet wat u wilt: die is vaak sneller en goedkoper.',
                        'Het gaat om een paar handelingen per maand: dan weegt maatwerk niet op tegen de kosten.',
                    ],
                ],
                'proof' => null,
                'process' => [
                    'title' => 'Van losse systemen naar één stroom',
                    'intro' => 'Eerst uitzoeken wat er precies moet gebeuren, ook als het misgaat. Dan pas bouwen.',
                    'steps' => [
                        ['title' => 'Kennismaking', 'text' => 'Welke systemen, welke gegevens, en wat moet er gebeuren als iets misgaat?', 'time' => null],
                        ['title' => 'Koppeling uitgetekend', 'text' => 'Ik controleer de API\'s van uw systemen en teken de gegevensstroom uit, inclusief randgevallen.', 'time' => null],
                        ['title' => 'Bouwen en testen', 'text' => 'Ik bouw en test met testdata, ook bij fouten, dubbele berichten en onbereikbare systemen.', 'time' => null],
                        ['title' => 'Live en bewaken', 'text' => 'De koppeling gaat live met logboek en meldingen. Onderhoud bij API-wijzigingen kan in een supportpakket.', 'time' => null],
                    ],
                ],
                'pricing' => [
                    'title' => 'Wat kost een API-koppeling?',
                    'intro' => 'De prijs hangt af van de systemen en van hoeveel logica er tussen zit. Na een gratis kennismaking ontvangt u een vaste prijs.',
                    'drivers' => [
                        'Het aantal systemen en soorten gegevens',
                        'Eén richting, of synchronisatie in twee richtingen',
                        'De kwaliteit en documentatie van de API\'s',
                        'Hoe snel gegevens moeten doorkomen: direct, elk uur of elke nacht',
                        'Het overzetten van bestaande gegevens',
                    ],
                    'note' => null,
                ],
                'faq' => [
                    ['q' => 'Wat kost een API-koppeling laten maken?', 'a' => 'Dat hangt af van het aantal systemen, de richting van de gegevens en de kwaliteit van de API\'s. Na een gratis kennismaking ontvangt u een vaste prijs.'],
                    ['q' => 'Met welke systemen kunt u koppelen?', 'a' => 'Met vrijwel elk systeem dat een API of webhooks heeft: webshops, betaalproviders zoals Mollie en Stripe, CRM-pakketten, boekhoudsoftware, kassasystemen en planningstools.'],
                    ['q' => 'Wat als een systeem geen API heeft?', 'a' => 'Dan kijken we naar alternatieven, zoals een geautomatiseerde export en import. Soms is een pakket met een API de betere keuze; dat bespreken we eerlijk.'],
                    ['q' => 'Wat gebeurt er als de koppeling faalt?', 'a' => 'Tijdelijke fouten worden automatisch opnieuw geprobeerd. Lukt het daarna nog niet, dan krijgt u een melding en blijft het bericht bewaard, zodat er niets verloren gaat.'],
                    ['q' => 'Wat als een leverancier zijn API verandert?', 'a' => 'Leveranciers kondigen wijzigingen meestal vooraf aan. Met een supportpakket pas ik de koppeling op tijd aan.'],
                    ['q' => 'Is Zapier of Make niet genoeg?', 'a' => 'Voor eenvoudige stappen vaak wel, en dan raad ik dat aan. Maatwerk loont bij grotere aantallen, complexe regels, gevoelige gegevens of als u geen maandelijkse kosten per taak wilt.'],
                    ['q' => 'Wie is eigenaar van de koppeling?', 'a' => 'U. U krijgt de broncode en documentatie, zodat u niet vastzit aan één leverancier.'],
                ],
                'contact' => [
                    'title' => 'Plan een gratis gesprek over uw koppeling',
                    'intro' => 'Vertel kort welke systemen u gebruikt en wat u nu overtypt. Ik reageer binnen 1 werkdag.',
                ],
            ],

            'en' => [
                'meta' => [
                    'title' => 'API integration development | Connect systems | DevAim Labs',
                    'description' => 'API integrations between your webshop, payment provider, CRM and accounting. No more retyping data, with a log, alerts and automatic retries.',
                ],
                'name' => 'API integrations',
                'summary' => 'Your systems talk to each other: no more retyping data.',
                'hero' => [
                    'eyebrow' => 'API integrations',
                    'title' => 'API integration',
                    'title_em' => 'development',
                    'subtitle' => 'Do you type data in twice because your systems don\'t talk to each other? I build integrations that pass orders, customers and invoices along automatically, and that notice when something goes wrong.',
                ],
                'flow' => [
                    'eyebrow' => '// how an integration works',
                    'title' => 'From payment to accounting, without retyping',
                    'try' => 'Example: a customer pays in a webshop through Mollie. The integration creates the invoice in the accounting software and updates the CRM. If a system is briefly unreachable, the integration retries automatically.',
                    'diagram_label' => 'Diagram: a payment in the webshop goes through the integration to the accounting software and the CRM.',
                    'nodes' => [
                        'source' => ['title' => 'Webshop', 'meta' => 'Payment via Mollie'],
                        'hub' => ['title' => 'Integration', 'meta' => 'Checks and passes on'],
                        'targets' => [
                            ['title' => 'Accounting', 'meta' => 'Invoice created'],
                            ['title' => 'CRM', 'meta' => 'Customer updated'],
                        ],
                    ],
                    'log_title' => 'Sync log',
                    'log_label' => 'Sync log with example data',
                    'status' => ['ok' => 'Done', 'retry' => 'Retried'],
                    'log' => [
                        ['time' => '09:14:02', 'event' => 'Order #1042 paid', 'result' => 'Invoice created in accounting', 'status' => 'ok'],
                        ['time' => '09:14:03', 'event' => 'Customer details #1042', 'result' => 'CRM updated', 'status' => 'ok'],
                        ['time' => '09:21:47', 'event' => 'Order #1043 paid', 'result' => 'Accounting briefly unreachable, retried after 30 sec.', 'status' => 'retry'],
                        ['time' => '09:22:17', 'event' => 'Order #1043', 'result' => 'Invoice created (2nd attempt)', 'status' => 'ok'],
                        ['time' => '09:30:05', 'event' => 'Refund #1038', 'result' => 'Credit note created', 'status' => 'ok'],
                        ['time' => '09:41:19', 'event' => 'New enquiry via website', 'result' => 'Contact created in CRM', 'status' => 'ok'],
                    ],
                    'before' => ['label' => 'Now', 'text' => 'Entering data twice, hunting for errors and checking afterwards.'],
                    'after' => ['label' => 'With an integration', 'text' => 'Enter it once. The rest happens automatically, and you hear about it when something goes wrong.'],
                ],
                'deliverables' => [
                    'title' => 'Integrations that keep working',
                    'intro' => 'An integration is only good when you no longer have to think about it. You can see part of it in the example above.',
                    'items' => [
                        ['icon' => 'workflow', 'title' => 'No more double work', 'text' => 'Orders, customers and invoices move from one system to the next automatically.', 'demo' => 'The dot travelling from the webshop through the integration to accounting and CRM.'],
                        ['icon' => 'clock', 'title' => 'Automatic retries', 'text' => 'If a system is briefly unreachable, the integration tries again later instead of losing data.', 'demo' => 'The "Retried" row in the sync log.'],
                        ['icon' => 'alert-circle', 'title' => 'Log and alerts', 'text' => 'Every sync is recorded. If something really fails, you or your team get an alert.', 'demo' => 'The sync log with a time and status per row.'],
                        ['icon' => 'trending-up', 'title' => 'Instant on every event', 'text' => 'Where possible, the integration reacts right away through webhooks, for example to a payment or a new enquiry.', 'demo' => 'The payment that flows straight into the integration.'],
                        ['icon' => 'shield-check', 'title' => 'Secure and documented', 'text' => 'API keys stored safely, only the permissions that are needed, and documentation so you don\'t depend on me.', 'demo' => null],
                        ['icon' => 'check', 'title' => 'Maintenance when APIs change', 'text' => 'When a vendor changes its API, I update the integration in time.', 'demo' => null],
                    ],
                ],
                'fit' => [
                    'good' => [
                        'You or your team retype data from one system into another.',
                        'Your webshop, till, CRM or accounting get out of step and you hunt for errors afterwards.',
                        'No standard integration exists, or it doesn\'t quite do what you need.',
                    ],
                    'bad' => [
                        'A ready-made integration already does exactly what you want: that is often faster and cheaper.',
                        'It is about a handful of actions a month: then custom work doesn\'t outweigh the cost.',
                    ],
                ],
                'proof' => null,
                'process' => [
                    'title' => 'From separate systems to one flow',
                    'intro' => 'First work out exactly what should happen, including when things go wrong. Only then build.',
                    'steps' => [
                        ['title' => 'Intro', 'text' => 'Which systems, which data, and what should happen when something goes wrong?', 'time' => null],
                        ['title' => 'Integration mapped', 'text' => 'I check the APIs of your systems and map out the data flow, edge cases included.', 'time' => null],
                        ['title' => 'Build and test', 'text' => 'I build and test with test data, including errors, duplicate messages and unreachable systems.', 'time' => null],
                        ['title' => 'Launch and monitor', 'text' => 'The integration goes live with a log and alerts. Maintenance for API changes can be part of a support package.', 'time' => null],
                    ],
                ],
                'pricing' => [
                    'title' => 'What does an API integration cost?',
                    'intro' => 'The price depends on the systems and how much logic sits in between. After a free intro call you get a fixed price.',
                    'drivers' => [
                        'The number of systems and kinds of data',
                        'One direction, or two-way sync',
                        'The quality and documentation of the APIs',
                        'How fast data needs to arrive: instantly, hourly or nightly',
                        'Moving over existing data',
                    ],
                    'note' => null,
                ],
                'faq' => [
                    ['q' => 'What does an API integration cost?', 'a' => 'It depends on the number of systems, the direction of the data and the quality of the APIs. After a free intro call you receive a fixed price.'],
                    ['q' => 'Which systems can you connect?', 'a' => 'Almost any system with an API or webhooks: webshops, payment providers such as Mollie and Stripe, CRM packages, accounting software, till systems and planning tools.'],
                    ['q' => 'What if a system has no API?', 'a' => 'Then we look at alternatives, such as an automated export and import. Sometimes a package with an API is the better choice; we discuss that honestly.'],
                    ['q' => 'What happens when the integration fails?', 'a' => 'Temporary errors are retried automatically. If it still fails after that, you get an alert and the message is kept, so nothing gets lost.'],
                    ['q' => 'What if a vendor changes its API?', 'a' => 'Vendors usually announce changes in advance. With a support package I update the integration in time.'],
                    ['q' => 'Isn\'t Zapier or Make enough?', 'a' => 'For simple steps it often is, and then I will recommend it. Custom work pays off with larger volumes, complex rules, sensitive data, or if you don\'t want monthly per-task costs.'],
                    ['q' => 'Who owns the integration?', 'a' => 'You do. You receive the source code and documentation, so you are not locked into one vendor.'],
                ],
                'contact' => [
                    'title' => 'Book a free call about your integration',
                    'intro' => 'Briefly describe which systems you use and what you retype now. I reply within 1 working day.',
                ],
            ],
        ],
    ],

    /*
     * Old URLs that should now land on a service page (one 301 hop).
     * Keys are paths; values are service keys. Read by App\Support\LegacyRedirects,
     * which lets these win over the home-anchor mapping of the same path.
     */
    'legacy' => [
        'nl' => [
            '/adminpaneel-laravel-vue' => 'admin-panels',
            '/adminpaneel' => 'admin-panels',
            '/kpi-dashboard' => 'dashboards',
            '/stripe-mollie-integratie' => 'payments',
            '/betaalintegratie' => 'payments',
            '/api-koppelingen' => 'api-integrations',
            '/landingspagina' => 'websites',
        ],
        'en' => [
            '/en/admin-panel' => 'admin-panels',
            '/en/dashboard' => 'dashboards',
        ],
    ],

    /* Labels shared by every service page. */
    'ui' => [
        'nl' => [
            'crumb_services' => 'Diensten',
            'cta_primary' => 'Plan een gratis gesprek',
            'cta_demo' => 'Bekijk de live demo',
            'cta_flow' => 'Bekijk hoe een koppeling werkt',
            'price_label' => 'Prijsindicatie',
            'demo' => [
                'eyebrow' => '// live demo',
                'badge' => 'Voorbeelddata · fictief bedrijf',
                'start' => 'Start live demo',
                'open_tab' => 'Open in nieuw tabblad',
                'open_mobile' => 'Open de demo',
                'fullscreen' => 'Volledig scherm',
                'close' => 'Demo sluiten',
                'loading' => 'Demo laden…',
                'skip' => 'Sla demo over',
                'wide' => 'Werkt het best op een groter scherm.',
                'disclaimer' => 'Dit is een werkend voorbeeld van een fictief bedrijf met nepdata. Er worden geen echte betalingen of gegevens verwerkt.',
            ],
            'flow' => [
                'badge' => 'Voorbeelddata',
                'pause' => 'Animatie pauzeren',
                'play' => 'Animatie afspelen',
            ],
            'deliverables_eyebrow' => 'Wat u krijgt',
            'demo_hint' => 'In de demo',
            'flow_hint' => 'In het voorbeeld',
            'fit' => [
                'eyebrow' => 'Voor wie',
                'title' => 'Past dit bij u?',
                'good' => 'Een goede keuze als',
                'bad' => 'Niet de juiste keuze als',
            ],
            'proof_eyebrow' => 'Opgeleverd',
            'process_eyebrow' => 'Werkwijze',
            'pricing' => [
                'eyebrow' => 'Tarief',
                'drivers' => 'Waar de prijs van afhangt',
                'fixed' => 'Vaste prijs vooraf, na een gratis kennismaking.',
                'cta' => 'Vraag een vaste prijs aan',
            ],
            'faq_eyebrow' => 'Veelgestelde vragen',
            'faq_more' => 'Staat uw vraag er niet bij?',
            'faq_more_link' => 'Stel hem direct',
            'related' => [
                'eyebrow' => 'Gerelateerd',
                'title' => 'Vaak gecombineerd met',
                'link' => 'Bekijk',
            ],
            'contact_eyebrow' => 'Contact',
            'mobile_cta' => 'Plan een gratis gesprek',
            'mobile_demo' => 'Demo',
        ],
        'en' => [
            'crumb_services' => 'Services',
            'cta_primary' => 'Book a free call',
            'cta_demo' => 'See the live demo',
            'cta_flow' => 'See how an integration works',
            'price_label' => 'Price indication',
            'demo' => [
                'eyebrow' => '// live demo',
                'badge' => 'Example data · fictional business',
                'start' => 'Start live demo',
                'open_tab' => 'Open in new tab',
                'open_mobile' => 'Open the demo',
                'fullscreen' => 'Full screen',
                'close' => 'Close demo',
                'loading' => 'Loading demo…',
                'skip' => 'Skip demo',
                'wide' => 'Works best on a larger screen.',
                'disclaimer' => 'This is a working example of a fictional business with fake data. No real payments or personal data are processed.',
            ],
            'flow' => [
                'badge' => 'Example data',
                'pause' => 'Pause animation',
                'play' => 'Play animation',
            ],
            'deliverables_eyebrow' => 'What you get',
            'demo_hint' => 'In the demo',
            'flow_hint' => 'In the example',
            'fit' => [
                'eyebrow' => 'Who it is for',
                'title' => 'Is this a fit?',
                'good' => 'A good choice if',
                'bad' => 'Not the right choice if',
            ],
            'proof_eyebrow' => 'Delivered',
            'process_eyebrow' => 'Process',
            'pricing' => [
                'eyebrow' => 'Pricing',
                'drivers' => 'What drives the price',
                'fixed' => 'Fixed price up front, after a free intro call.',
                'cta' => 'Ask for a fixed price',
            ],
            'faq_eyebrow' => 'FAQ',
            'faq_more' => 'Don\'t see your question?',
            'faq_more_link' => 'Ask me directly',
            'related' => [
                'eyebrow' => 'Related',
                'title' => 'Often combined with',
                'link' => 'See',
            ],
            'contact_eyebrow' => 'Contact',
            'mobile_cta' => 'Book a free call',
            'mobile_demo' => 'Demo',
        ],
    ],
];

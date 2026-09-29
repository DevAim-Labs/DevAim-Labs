# Automatische deploy vanaf `main`

De Droplet kijkt elke 2 minuten of er nieuwe commits op `main` staan. Zo ja, dan doet hij:

1. `git merge --ff-only`. Stopt als iemand op de server bestanden heeft aangepast.
2. `composer install --no-dev`, alleen als `composer.json`/`composer.lock` veranderd zijn.
3. `npm ci`, alleen als `package.json`/`package-lock.json` veranderd zijn.
4. `npm run build`.
5. `php artisan migrate --force`, alleen als er een migratie veranderd is.
6. `php artisan optimize` (config-, route- en view-cache).
7. PHP-FPM herladen, zodat de nieuwe code direct actief is.

Mislukt een stap, dan zet het script de vorige commit terug en bouwt die opnieuw. De site blijft dan op de laatste werkende versie.

## Installeren (eenmalig, als root op de Droplet)

```bash
cd /var/www/devaimlabs
sudo install -m 755 deploy/auto-deploy/devaim-deploy.sh /usr/local/bin/devaim-deploy
sudo cp deploy/auto-deploy/devaim-deploy.service deploy/auto-deploy/devaim-deploy.timer /etc/systemd/system/
sudo systemctl daemon-reload
sudo systemctl enable --now devaim-deploy.timer
```

Controleer eerst deze twee dingen:

- **Tools in het PATH:** `which git npm composer php` moet voor alle vier een pad geven dat in de `PATH`-regel van `devaim-deploy.service` staat. Staat node via nvm, pas die regel dan aan.
- **Toegang tot GitHub:** `git -C /var/www/devaimlabs fetch origin main` moet zonder vragen werken, als de eigenaar van de projectmap (`stat -c %U /var/www/devaimlabs`).

## Gebruiken

| Wat | Commando |
| --- | --- |
| Timer actief? | `systemctl list-timers devaim-deploy.timer` |
| Nu direct deployen | `sudo systemctl start devaim-deploy.service` |
| Log bekijken | `journalctl -u devaim-deploy.service -n 50 --no-pager` |
| Tijdelijk uitzetten | `sudo systemctl stop devaim-deploy.timer` |
| Weer aanzetten | `sudo systemctl start devaim-deploy.timer` |

## Script bijgewerkt?

De timer draait de kopie in `/usr/local/bin`, niet het bestand in de repo. Zo kan een pull het script niet halverwege overschrijven. Na een wijziging aan `devaim-deploy.sh` installeert u hem opnieuw:

```bash
sudo install -m 755 /var/www/devaimlabs/deploy/auto-deploy/devaim-deploy.sh /usr/local/bin/devaim-deploy
```

## Goed om te weten

- **Wachttijd:** tussen een push naar `main` en de site live zit maximaal ongeveer 2 minuten plus de buildtijd.
- **Mismatch tijdens de build:** heel even kunnen nieuwe views de oude CSS gebruiken, tot `npm run build` klaar is. Dat duurt meestal een paar seconden.
- **Wijzig geen bestanden direct op de server.** Dan weigert `--ff-only` de deploy. Dat ziet u in het log. Zet de wijzigingen terug met `git -C /var/www/devaimlabs status` en `git checkout -- <bestand>`.

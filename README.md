# PHP Login- und Registrierungssystem

Ein sicheres Login- und Registrierungssystem mit PHP und MySQL. Dieses Projekt implementiert grundlegende Sicherheitsstandards wie Passwort-Hashing, CSRF-Schutz, SQL-Injection-Vermeidung und sicheres Session-Management.

## Funktionen

- Benutzerregistrierung mit validierten Eingaben.
- Sichere Passwortspeicherung mit `password_hash()`.
- Benutzerlogin mit `password_verify()` und Session-Management.
- Schutz vor SQL-Injection durch vorbereitete Statements.
- CSRF-Schutz für Formulare.
- HTTPS-Unterstützung (Serverkonfiguration erforderlich).

---

## Voraussetzungen

- PHP 7.4 oder höher.
- MySQL-Datenbank.
- Webserver (z. B. Apache, Nginx, XAMPP).

---

## Installation

### 1. Datenbank einrichten
1. Importiere die Datei `PHPLoginScript.sql` in deine MySQL-Datenbank.
2. Die Datei erstellt eine Datenbank und die notwendige Tabelle `users`.

### 2. Datenbankverbindung konfigurieren
1. Öffne die Datei `src/config/database.php`.
2. Passe die Verbindungsdetails für deine Datenbank an:
   ```php
   $host = 'localhost';      // Datenbankhost
   $dbname = 'deine_datenbank'; // Name der Datenbank
   $user = 'dein_benutzer';    // Benutzername
   $password = 'dein_passwort'; // Passwort


3. Projekt testen
Starte deinen Webserver (z. B. Apache oder Nginx).
Greife im Browser auf die Anwendung zu:
Registrierung: http://localhost/src/register.php
Login: http://localhost/src/login.php
Wenn alles korrekt eingerichtet ist, kannst du das Login- und Registrierungssystem verwenden und erweitern.
Verwendung
Registrierung
Besuche die Seite register.php.
Fülle die Felder aus:
Benutzername (3–20 Zeichen, nur Buchstaben, Zahlen, Unterstriche).
Passwort (mindestens 8 Zeichen).
Nach erfolgreicher Registrierung wirst du zum Login weitergeleitet.
Login
Besuche die Seite login.php.
Melde dich mit deinem Benutzernamen und Passwort an.
Nach erfolgreichem Login wirst du auf das Dashboard weitergeleitet.
Dashboard
Das Dashboard (dashboard.php) zeigt den aktuell angemeldeten Benutzer.
Abmelden ist über logout.php möglich.
Sicherheitsmaßnahmen
Passwort-Hashing:
Passwörter werden mit password_hash() gehasht und sicher gespeichert.

Prepared Statements:
SQL-Injection wird durch vorbereitete Statements verhindert.

CSRF-Schutz:
Alle Formulare verwenden CSRF-Tokens, um Manipulationen durch Dritte zu verhindern.

Session-Schutz:

Session-IDs werden nach Login regeneriert (session_regenerate_id()).
Cookies sind auf HTTP und HTTPS beschränkt.
Eingabevalidierung:

Benutzername und Passwort werden auf Länge und Format geprüft.
Haftungsausschluss
Dieses Script dient ausschließlich Bildungszwecken. Obwohl es grundlegende Sicherheitsmaßnahmen implementiert, ist es möglicherweise nicht ausreichend gegen alle Arten von Angriffen geschützt, insbesondere in einem Produktionsumfeld. Ich übernehme keine Verantwortung für Schäden, die durch die Verwendung dieses Codes entstehen könnten.

Ich empfehle dringend, das System vor dem produktiven Einsatz gründlich zu überprüfen und zusätzliche Sicherheitsmaßnahmen zu implementieren. Zudem übernehme ich keine Haftung für Erweiterungen oder Schäden, die durch das Abändern des Source-Codes verursacht werden. Der Code dient nur zur Veranschaulichung für Neulinge in der Programmierung.

To-Do / Weiterentwicklungen / Updates
Passwort-Wiederherstellung:
Implementiere ein System zum Zurücksetzen des Passworts per E-Mail.
Design:
Erstellung eines Designs mit Bootstrap oder TailwindCSS.

E-Mail-Verifizierung:
Füge eine Verifizierungslogik hinzu, um Benutzer nach der Registrierung zu bestätigen.

Rate Limiting:
Schutz vor Brute-Force-Angriffen (z. B. durch reCAPTCHA oder IP-Sperrung).
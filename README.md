## Information

Dies ist ein Projekt der Veranstaltung Software-Projekt an der Hochschule Flensburg.

Ersteller: Simon Leunig, 

## Vorhandene Funktionen

- Administration
- Login
- Registrierung
- Datenbank Einträge erstellen, bearbeiten und löschen
- Datenbank anzeigen

## Admin Access

Für die Erstellung eines Accounts kann nur die E-Mail "@muerwiker" verwendet werden. Dies bietet den Vorteil das nur Mitarbeiter sich Zugriff verschaffen können.

## Versionen

Folgende Versionen wurden für das Projekt verwendet:

- [PHP 8.0.2]
- [Laravel Framework 9.19].
- [Vue 3.2.31].

### Anleitung zum Starten

Projekt mit z.B. Visual Studio Code öffnen

Im Terminal:
Um die .env Datei zu erstellen:
```
copy .env.example .env
```

Für die .env Datei muss eine Datenbankverbindung hergestellt werden.
In unserem Fall wurde dies mit sqlite durchgeführt.

- gehe zu database und erstelle die Datei "database.sqlite"
- Pfad kopieren
- z.B. C:/{PFAD}/{ZUR}/{DATEI}/database.sqlite (Wichtig "/" zu nutzen, den Pfad in Anführungszeichen " ")
- gehe zu .env - DB_DATABASE= und füge den Pfad von oben hinzu
- ändere DB_CONNECTION= zu "sqlite"

Weitere Befehle:
```
- composer install
- npm install
- php artisan key:generate
- php artisan migrate
- php artisan serve
- npm run dev (im neuen Terminal)
```

## Anwendung

Um in die Administration zu gelangen kann einer der folgenden Links ausgewählt werden: 
- /register für Registierung
- /login für Login
- /admin für das Admin Dashboard


# 21ai1-webeng-II-verein-pdf
21ai1-webeng-II-verein-pdf created by GitHub Classroom

Das letzte README ist bei dem Klonen des Projekts überschrieben worden. Deshalb sind die ersten Zeilen Gedächnisprotokoll des README, dannach folgen die benötigten Installationen und Wissen zum Benutzen des Projekts.

1)LittleHelper

2)LittleHelper ist eine Website, welche Menschen mit verschiedenen Aufgaben des Altags zu helfen

3)Die Webseite umfasst eine Regestrierung, Login etc., einen PDF Konverter und eine Infoseite.(Optional: eine TODO Seite)

4)Teilnehmer: Liz Wellhausen, Martrikelnummer: 7691528

Benötigte Installationen:

-PHP: php muss auf den Rechner installiert sein und vom Projekt benutzt werden können. Es wird die Version PHP 8.2.0 empfolen(diese wurde bei der Entwicklung verwendet).

-JavaScript, HTML, CSS müssen funktionieren

-Composer: der Composer kann über https://getcomposer.org/download/ installiert werden. Es wird die Version 2.5.5 vorrausgesetzt. (Die neuste Version lässt sich durch composer self-update 2.5.5 auf die benötigte Version zurücksetzen)

-PHP Mailer: der PHP Mailer kann über den Composer installiert werden, Version 6.8.0 wird verwendet. Zur Hilfe: https://de.wikihow.com/PHP-Mailer-installieren

-XAMPP: XAMPP muss installiert sein und das Projekt in den htdocs Folder geschrieben werden.(In Testumgebung wurde dies unter C:\\xampp\\htdocs)

  -phpMyAdmin: In phpMyAdmin muss eine Datenbank names littlehelperdb erstellt worden sein. Diese besitzt zwei Tabellen
    -login
    ![image](https://github.com/DHBW-Vilas/21ai1-webeng-II-verein-pdf/assets/73017201/b950bf7d-5e59-493e-bd30-c482bd7ad1c9)
    -todo
    ![image](https://github.com/DHBW-Vilas/21ai1-webeng-II-verein-pdf/assets/73017201/81ef6ddb-d751-4438-b6de-bb08ec3d2553)

Sonstige Anpassungen:

-Es wurde die Datenbank PDF.co verwendet. Es wird empfolen, wenn der Fehler 402 auftritt, einen Account zu erstellen und einen API Key zu holen, da die Kredits des eingetragenden dann aufgebraucht sind. https://app.pdf.co

-Um selbst die Mail zu bekommen, müssen die Files reset_password.php und validate_mail.php $username und $password angepasst werden. Der Code ist für eine GMAIL Addresse ausgelegt. Das Passwort muss über Google App Passwort erstellt werden. Infos: https://support.google.com/accounts/answer/185833?hl=en

Mögliche Fehlerquellen:

Es sind keine Fehler beim Benutzung der Webseite bekannt.

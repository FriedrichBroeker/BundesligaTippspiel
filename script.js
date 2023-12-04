
document.addEventListener('DOMContentLoaded', function() {

    // Bundesliga Tabelle API
    function fetchTable() {
        // API-Endpunkt-URL
        const url = 'https://api.openligadb.de/getbltable/bl1/2023';

        // API aufrufen und Antwort
        fetch(url)
            .then(response => response.json()) // zu json
            .then(data => displayTable(data)) 
            .catch(error => console.error('Fehler beim Abrufen der Tabelle:', error)); // Fängt Fehler ab
    }

    // Tabelle
    function displayTable(tableData) {
        const container = document.getElementById('table-container');

        // Erstellt Tabellen element
        const table = document.createElement('table');
        table.className = 'table'; // tabellen klasse

        // kopfzeile und fußzeile
        const thead = table.createTHead();
        const tbody = table.createTBody();
        const headRow = thead.insertRow(); //zeile hinzufügen

        // kopfzeilen namen
        const headers = [
            { text: 'Verein', class: 'verein' },
            { text: 'Spiele', class: 'spiele', abk: 'Sp' },
            { text: 'Siege', class: 'siege', abk: 'S' },
            { text: 'Unentschieden', class: 'unentschieden', abk: 'U' },
            { text: 'Niederlagen', class: 'niederlagen', abk: 'N' },
            { text: 'Tore', class: 'tore' },
            { text: 'Gegentore', class: 'gegentore' },
            { text: 'Tordifferenz', class: 'tordifferenz', abk: 'TD' },
            { text: 'Punkte', class: 'punkte', abk: 'Pk.' }
        ];

        // kopfzeile zu tabelle hinzufügen
        headers.forEach(header => {
            const th = document.createElement('th');
            th.className = header.class;
            const span = document.createElement('span');
            span.textContent = header.text;
            th.appendChild(span);
            if (header.abk) {
                th.setAttribute('data-abk', header.abk);
            }
            headRow.appendChild(th);
        });

        // daten hinzufügen zeile
        tableData.forEach((team, index) => {
            const row = tbody.insertRow();
            
            // vereinslogo zelle
            const teamCell = row.insertCell();
            teamCell.classList.add('team-cell');

            // logo platzierung
            const placeSpan = document.createElement('span');
            placeSpan.textContent = `${index + 1} `;
            placeSpan.classList.add('platz');
            teamCell.appendChild(placeSpan);

            // vereinslogo
            const logoImg = document.createElement('img');
            logoImg.src = team.teamIconUrl;
            logoImg.alt = `${team.shortName} Logo`;
            logoImg.classList.add('team-logo');
            teamCell.appendChild(logoImg);
            teamCell.appendChild(document.createTextNode(team.shortName));

            // mannschafts daten
            row.insertCell().textContent = team.matches;
            row.insertCell().textContent = team.won;
            row.insertCell().textContent = team.draw;
            row.insertCell().textContent = team.lost;
            const goalsCell = row.insertCell();
            goalsCell.textContent = team.goals;
            goalsCell.className = 'tore';
            const oppGoalsCell = row.insertCell();
            oppGoalsCell.textContent = team.opponentGoals;
            oppGoalsCell.className = 'gegentore';
            row.insertCell().textContent = team.goalDiff;
            row.insertCell().textContent = team.points;
        });

        // tabelle zum container hinzufügen
        container.appendChild(table);
    }

    // tabelle anzeigen
    fetchTable();
});

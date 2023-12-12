document.addEventListener('DOMContentLoaded', function() {
    function fetchMatches() {
        const url = 'https://api.openligadb.de/getmatchdata/bl1';

        fetch(url)
            .then(response => response.json())
            .then(data => displayMatches(data))
            .catch(error => console.error('Fehler beim Abrufen der Spiele:', error));
    }

    function displayMatches(matchData) {
        const container = document.getElementById('matches-container');

        matchData.forEach(match => {
            // Erstellt einen Container für jedes Spiel
            const matchElement = document.createElement('div');
            matchElement.className = 'match-container';
        
            // Container für Datum und Uhrzeit
            const dateTimeContainer = document.createElement('div');
            dateTimeContainer.className = 'date-time-container';
            const dateElement = document.createElement('span');
            dateElement.textContent = new Date(match.matchDateTime).toLocaleDateString();
            const timeElement = document.createElement('span');
            // Setzt das Format für die Uhrzeitanzeige ohne Sekunden
            timeElement.textContent = new Date(match.matchDateTime).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            dateTimeContainer.appendChild(dateElement);
            dateTimeContainer.appendChild(document.createElement('br')); // Zeilenumbruch
            dateTimeContainer.appendChild(timeElement);
        
            // Container für Team-Informationen
            const teamsContainer = document.createElement('div');
            teamsContainer.className = 'teams-container';
            const team1Element = createTeamElement(match.team1);
            const team2Element = createTeamElement(match.team2);
            teamsContainer.appendChild(team1Element);
            
            teamsContainer.appendChild(team2Element);
        
            // Tippfelder
            const tipContainer = document.createElement('div');
            tipContainer.className = 'tip-container';
            const tipInput1 = document.createElement('input');
            tipInput1.type = 'number';
            tipInput1.className = 'tip-input';
            const tipInput2 = document.createElement('input');
            tipInput2.type = 'number';
            tipInput2.className = 'tip-input';
            tipContainer.appendChild(tipInput1);
            tipContainer.appendChild(document.createTextNode(':'));
            tipContainer.appendChild(tipInput2);
        
            // Fügt die Elemente zum Spielcontainer hinzu
            matchElement.appendChild(dateTimeContainer);
            matchElement.appendChild(teamsContainer);
            matchElement.appendChild(tipContainer);
            container.appendChild(matchElement);

            container.appendChild(matchElement);
        });
        
        // Hilfsfunktion zum Erstellen eines Team-Elements
        function createTeamElement(team) {
            const teamElement = document.createElement('div');
            teamElement.className = 'team-element';
        
            const logoImg = document.createElement('img');
            logoImg.src = team.teamIconUrl;
            logoImg.alt = `${team.shortName} Logo`;
            logoImg.className = 'team-logo';
        
            const teamName = document.createElement('span');
            teamName.textContent = team.teamName;
        
            teamElement.appendChild(logoImg);
            teamElement.appendChild(teamName);
        
            return teamElement;
        }
        
        
    }

    fetchMatches();
});


Include Chart.js library
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Canvas pour le graphique -->
<canvas id="candidatChart" width="400" height="400"></canvas>

@verbatim
<script>


   

// Récupérez les données nécessaires depuis votre API
var candidatId = !! json_encode($candidat = id) ;
var apiUrl = "/api/candidats/" + candidatId + "/data";

// Utilisez Ajax pour récupérer les données du serveur
$.get(apiUrl, function(data) {
    // Préparez les données pour le graphique
    var ctx = document.getElementById('candidatChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Likes', 'Dislikes'],
            datasets: [{
                data: [data.likes, data.dislikes],
                backgroundColor: ['green', 'red'],
            }]
        },
    });
});
</script>
@endverbatim

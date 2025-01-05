<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/3.0.0/luxon.min.js"></script>
<link rel="stylesheet" href="../assets/css/chart.css">
<div style="max-width: 800px; margin: auto; display: flex;">
    <canvas id="availabilityChart" width="700" height="500"></canvas>
    <div id="legend" style="padding-left: 20px;">
        <h4>Player Availability</h4>
        <ul style="list-style: none; padding: 0;">
            <li><span style="background-color: rgba(255, 99, 132, 0.8); display: inline-block; width: 15px; height: 15px; margin-right: 10px;"></span> 0 players</li>
            <li><span style="background-color: rgba(255, 159, 64, 0.8); display: inline-block; width: 15px; height: 15px; margin-right: 10px;"></span> 1–5 players</li>
            <li><span style="background-color: rgba(255, 205, 86, 0.8); display: inline-block; width: 15px; height: 15px; margin-right: 10px;"></span> 6–10 players</li>
            <li><span style="background-color: rgba(75, 192, 192, 0.8); display: inline-block; width: 15px; height: 15px; margin-right: 10px;"></span> 11–20 players</li>
            <li><span style="background-color: rgba(54, 162, 235, 0.8); display: inline-block; width: 15px; height: 15px; margin-right: 10px;"></span> 21+ players</li>
            <li><span style="background-color: rgba(52, 211, 153, 0.8); display: inline-block; width: 15px; height: 15px; margin-right: 10px;"></span> 31+ players</li>
            <li><span style="background-color: rgba(34, 139, 34, 0.8); display: inline-block; width: 15px; height: 15px; margin-right: 10px;"></span> 41+ players</li>
            <li><span style="background-color: rgba(255, 223, 0, 0.8); display: inline-block; width: 15px; height: 15px; margin-right: 10px;"></span> 50+ players</li>
        </ul>
    </div>
</div>
<script>
function fetchAvailabilityData() {
    fetch('../functions/availability-fetch.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'error') {
            console.error('Error:', data.message);
            return;
        }

        const viewerTimezone = 'America/Sao_Paulo'; 

        function convertToViewerTimeDirectly(time, userTimezone) {
            const timeInUserTimezone = luxon.DateTime.fromFormat(time, "HH:mm:ss", { zone: userTimezone });
            const localTimeInViewerTimezone = timeInUserTimezone.setZone(viewerTimezone);
            return localTimeInViewerTimezone;
        }

        const availabilityData = data.data.map(item => {
            const localTime = convertToViewerTimeDirectly(item.time_slot, item.user_timezone);
            return {
                ...item,
                localTimeFormatted: localTime.toFormat("hh:mm a"),
                localTimeLuxon: localTime 
            };
        });

        
        availabilityData.sort((a, b) => a.localTimeLuxon - b.localTimeLuxon);

        function getPlayerColor(count) {
            if (count === 0) return 'rgba(255, 99, 132, 0.8)';
            if (count <= 5) return 'rgba(255, 159, 64, 0.8)';
            if (count <= 10) return 'rgba(255, 205, 86, 0.8)';
            if (count <= 20) return 'rgba(75, 192, 192, 0.8)';
            if (count <= 31) return 'rgba(52, 211, 153, 0.8)';
            if (count <= 41) return 'rgba(34, 139, 34, 0.8)';
            if (count >= 50) return 'rgba(255, 223, 0, 0.8)';
            return 'rgba(54, 162, 235, 0.8)';
        }

        const days = [...new Set(availabilityData.map(item => item.day_of_week))];
        const timeSlots = [...new Set(availabilityData.map(item => item.localTimeFormatted))];

        const playerCounts = {};
        days.forEach(day => {
            playerCounts[day] = {};
            timeSlots.forEach(time => {
                playerCounts[day][time] = 0;
            });
        });

        availabilityData.forEach(item => {
            playerCounts[item.day_of_week][item.localTimeFormatted] = item.player_count || 0;
        });

        const datasets = timeSlots.map((time, index) => ({
            label: time,
            data: days.map(day => playerCounts[day][time]),
            backgroundColor: days.map(day => getPlayerColor(playerCounts[day][time])),
            borderWidth: 1
        }));

        generateChart(days, datasets);
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
}


function generateChart(labels, datasets) {
    const ctx = document.getElementById('availabilityChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    callbacks: {
                        label: context => {
                            const count = context.raw;
                            return `${context.dataset.label}: ${count} player(s) available`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    stacked: true,
                    title: {
                        display: true,
                        text: 'Days of the Week',
                        font: { size: 14 }
                    },
                    ticks: { font: { size: 12 } },
                    grid: { display: false }
                },
                y: {
                    stacked: true,
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Times of the day',
                        font: { size: 14 }
                    },
                    ticks: { stepSize: 6 },
                    grid: { color: 'rgba(200, 200, 200, 0.3)' }
                }
            },
            layout: { padding: 10 }
        }
    });
}

fetchAvailabilityData();

</script>

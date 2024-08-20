const ctx = document.getElementById("dashboardChart").getContext("2d");
const chart = new Chart(ctx, {
    type: "line", // Chart type (line, bar, pie, etc.)
    data: {
        labels: ['Elearnings', 'Reviews', 'Users', 'Articles'], // Labels
        datasets: [
            {
                label: "Total Count",
                data: datachart, // Data values
                backgroundColor: [
                    "rgba(54, 162, 235, 0.2)",
                    "rgba(255, 206, 86, 0.2)",
                    "rgba(255, 99, 132, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                ],
                borderColor: [
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(255, 99, 132, 1)",
                    "rgba(75, 192, 192, 1)",
                ],
                borderWidth: 1,
            },
        ],
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});

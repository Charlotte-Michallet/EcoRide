const API_ENDPOINT = "index.php?controller=api&resource=admin&action=graph";

const graphCreditCanvas = document.getElementById("graphCredit");
const graphTripCanvas = document.getElementById("graphTrip");

export async function init(firstday, lastday) {
    const resp = await fetch(API_ENDPOINT);

    if (!resp.ok) {
        throw new Error("Erreur de réseau ou de serveur");
    }
    const datatrips = await resp.json();
    graphTrip(datatrips["tripsInfo"]);
    graphCredits(datatrips["credits"]);
}

const graphTrip = (datatrips) => {
    const maxValue = Math.max(...datatrips.data) + 2;
    Chart.defaults.font.size = 16;

    const barCharts = new Chart(graphTripCanvas, {
        type: "bar",
        data: {
            labels: datatrips.labels,
            datasets: [
                {
                    label: "Nombre de covoiturage part jour",
                    data: datatrips.data,
                    backgroundColor: "green",
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: "Nombre de covoiturage par jour",
                    font: {
                        size: 20,
                    },
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: "jours et mois",
                    },
                },
                y: {
                    min: 0,
                    max: maxValue,
                    ticks: {
                        stepSize: 2,
                    },
                    title: {
                        display: true,
                        text: "Valeur",
                    },
                },
            },
        },
    });
};

const graphCredits = (datatrips) => {
    const maxValue = Math.max(...datatrips.data) + 2;
    Chart.defaults.font.size = 16;

    const lineCharts = new Chart(graphCreditCanvas, {
        type: "line",
        data: {
            labels: datatrips.labels,
            datasets: [
                {
                    label: "Nombre de credits part jour",
                    data: datatrips.data,
                    pointStyle: "circle",
                    borderColor: "green",
                    backgroundColor: "green",
                    pointRadius: 5,
                    pointHoverRadius: 10,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: "Nombre de covoiturage par jour",
                    font: {
                        size: 20,
                    },
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: "jours et mois",
                        font: {
                            size: 20,
                        },
                    },
                },
                y: {
                    min: 0,
                    max: maxValue,
                    ticks: {
                        stepSize: 2,
                    },
                    title: {
                        display: true,
                        text: "Valeur",
                    },
                },
            },
        },
    });
};

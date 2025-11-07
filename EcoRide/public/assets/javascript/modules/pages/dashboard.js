const API_ENDPOINT = "index.php?controller=api&resource=admin&action=graph";

const graphCreditCanvas = document.getElementById("graphCredit");
const graphTripCanvas = document.getElementById("graphTrip");

export async function init() {
    const resp = await fetch(API_ENDPOINT);

    if (!resp.ok) {
        throw new Error("Erreur de réseau ou de serveur");
    }
    const datatrips = await resp.json();
    graphTrip(datatrips["tripsInfo"]);
    graphCredits(datatrips["credits"]);
}

const titleSize = (chartWidth) => {
    let titleSize;
    if (chartWidth < 450) {
        titleSize = 16;
    } else {
        titleSize = 20;
    }

    return titleSize;
};

const labelSize = (chartWidth) => {
    let fontSize;
    if (chartWidth < 450) {
        fontSize = 10;
    } else if (chartWidth < 650) {
        fontSize = 14;
    } else {
        fontSize = 16;
    }

    return fontSize;
};

const fontSize = (chartWidth) => {
    let fontSize;
    if (chartWidth < 450) {
        fontSize = 12;
    } else if (chartWidth < 650) {
        fontSize = 14;
    } else {
        fontSize = 16;
    }

    return fontSize;
};

const graphTrip = (datatrips) => {
    const maxValue = Math.max(...datatrips.data) + 2;

    const lineCharts = new Chart(graphTripCanvas, {
        type: "line",
        data: {
            labels: datatrips.labels,
            datasets: [
                {
                    label: "Nombre de covoiturages par jour",
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
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: "Nombre de covoiturages par jour",
                    font: (context) => ({
                        size: titleSize(context.chart.width),
                    }),
                },
                legend: {
                    labels: {
                        font: (context) => ({
                            size: labelSize(context.chart.width),
                        }),
                    },
                },
            },
            scales: {
                x: {
                    ticks: {
                        font: (context) => ({
                            size: fontSize(context.chart.width),
                        }),
                    },
                    title: {
                        display: true,
                        text: "Jours et mois",
                        font: (context) => ({
                            size: fontSize(context.chart.width),
                        }),
                    },
                },
                y: {
                    min: 0,
                    max: maxValue,
                    ticks: {
                        stepSize: 2,
                        font: (context) => ({
                            size: fontSize(context.chart.width),
                        }),
                    },
                    title: {
                        display: true,
                        text: "Valeur",
                        font: (context) => ({
                            size: fontSize(context.chart.width),
                        }),
                    },
                },
            },
        },
    });
};

const graphCredits = (datatrips) => {
    const maxValue = Math.max(...datatrips.data) + 2;

    const barCharts = new Chart(graphCreditCanvas, {
        type: "bar",
        data: {
            labels: datatrips.labels,
            datasets: [
                {
                    label: "Nombre de crédits par jour",
                    data: datatrips.data,
                    backgroundColor: "green",
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: "Nombre de crédits par jour",
                    font: (context) => ({
                        size: titleSize(context.chart.width),
                    }),
                },
                legend: {
                    labels: {
                        font: (context) => ({
                            size: labelSize(context.chart.width),
                        }),
                    },
                },
            },
            scales: {
                x: {
                    ticks: {
                        font: (context) => ({
                            size: fontSize(context.chart.width),
                        }),
                    },
                    title: {
                        display: true,
                        text: "Jours et mois",
                        font: (context) => ({
                            size: fontSize(context.chart.width),
                        }),
                    },
                },
                y: {
                    min: 0,
                    max: maxValue,
                    ticks: {
                        stepSize: 2,
                        font: (context) => ({
                            size: fontSize(context.chart.width),
                        }),
                    },
                    title: {
                        display: true,
                        text: "Valeur",
                        font: (context) => ({
                            size: fontSize(context.chart.width),
                        }),
                    },
                },
            },
        },
    });
};

function AddBackgroundColors(chartConfig) {
    
    let dataset;
    if (chartConfig &&
        chartConfig.data &&
        chartConfig.data.datasets) {
        
        dataset = chartConfig.data.datasets[0];
        for (let i = 0; i < dataset.data.length; i++) {

            if (dataset.data[i] < 8.00) {
                dataset.backgroundColor[i] = 'rgba(255, 99, 132, 0.2)';
                dataset.borderColor[i] = 'rgba(255, 99, 132, 1)';
            } else {
                dataset.backgroundColor[i] = 'rgba(0, 255, 64, 0.2)';
                dataset.borderColor[i] = 'rgba(0, 255, 64, 1)';
            }
        }
    }
    return chartConfig;
}

let chartConfig = {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Daily Working Hours ( Current Month )',
            data: [],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    },
    plugins: [ChartDataLabels],
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Working Hours'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Working Date'
                }
            },
        }
    }
};

$.ajax({
    url:"/get_dashboard_bar_chart/",
    type:"GET",
    cache: false,
    success: function(response) {
        chartConfig.data.labels= response[0]
        chartConfig.data.datasets[0].data=response[1]
    },
    failure: function (response) {
        swal.fire(
            "Bar Chart Internal Error",
            "Oops, Missing Something.",
            "error"
        )
        localStorage.clear();
    }
})

window.onload = function() {
    setTimeout(function () {
        const ctx = document.getElementById("barChart").getContext("2d");
        chartConfig = AddBackgroundColors(chartConfig);
        window.myBar = new Chart(ctx, chartConfig);
    }, 500);
};
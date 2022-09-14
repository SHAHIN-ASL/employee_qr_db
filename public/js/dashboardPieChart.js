const ctx1 = document.getElementById('pieChart');
const pieChart = new Chart(ctx1, {
    type: 'pie',
    data: {
        labels: [],
        datasets: [{
            label: 'Current Month Activities History',
            data: [],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)'
            ],
            hoverOffset: 4
        }]
    },
    plugins: [ChartDataLabels],
    options:
        {
        responsive: true,
        maintainAspectRatio: false,
            plugins: {
                // Change options for ALL labels of THIS CHART
                datalabels: {
                    anchor:'center',
                    color: '#000000'
                },
                title: {
                    display: true,
                    text: 'Custom Chart Title'
                }
            }
        // scales: {
        //     y: {
        //         beginAtZero: true
        //     }
        // }
    }
});

$.ajax({
    url:"/get_dashboard_pie_chart/",
    type:"GET",
    cache: false,
    success: function(response) {
         console.log(response);
        if (response[0].length === 0 && response[1].length === 0){
           // console.log(response);

        }else{
            response[0].splice(3,1);
            response[1].splice(3,1);
            pieChart.data.labels= response[0]
            pieChart.data.datasets[0].data=response[1]
            pieChart.update()
        }

       // console.log(response);
    },
    failure: function (response) {
        swal.fire(
            "Pie Chart Internal Error",
            "Oops, Missing Something.",
            "error"
        )
        localStorage.clear();
    }
})


var ctx = document.getElementById("__id__").getContext('2d');
var myChart = new Chart(ctx, {
    type: '__type__',
    data: {
        labels: __labels__,
        datasets: [__dataset__]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
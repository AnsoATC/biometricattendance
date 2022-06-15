var usersByDevice;
var usersByDeviceKeys = [], usersByDeviceValues = [],
    usersByDeviceColors = [], usersByDeviceHoverColors = [];

$.ajax({
    url: "partials/users_by_devices.php"
}).done(function (data) {
    usersByDevice = JSON.parse(data);
    var keys = Object.keys(usersByDevice);
    var values = Object.values(usersByDevice);
    keys = Array.from(keys);
    values = Array.from(values);
    for (let i = 0; i < keys.length; i++) {
        usersByDeviceKeys[i] = keys[i];
        usersByDeviceValues[i] = values[i];
    }
    generateColors();
    showDevicesByDepartementChart();
    showDevicesByDepartementLegende();
});

function generateColors(){
    var backgroundColor = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
        hoverBackgroundColor = ['#2e59d9', '#17a673', '#2c9faf', '#e6b23e'];
    
    for (let i = 0; i < usersByDeviceKeys.length; i++) {
        backgroundColor = backgroundColor.concat(backgroundColor);
        hoverBackgroundColor = hoverBackgroundColor.concat(hoverBackgroundColor);
    }

    usersByDeviceColors = backgroundColor.slice(0, usersByDeviceKeys.length);
    usersByDeviceHoverColors = hoverBackgroundColor.slice(0, usersByDeviceKeys.length);
}

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function showDevicesByDepartementChart() {
    var ctx = document.getElementById("usersByDeviceChart");
    var myPieChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: usersByDeviceKeys,
            datasets: [{
                data: usersByDeviceValues,
                backgroundColor: usersByDeviceColors,
                hoverBackgroundColor: usersByDeviceHoverColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        suggestedMin: 0, 
                        beginAtZero: true
                    }
                }]
            },
            cutoutPercentage: 80,
        },
    });
}

function showDevicesByDepartementLegende(){
    var legende = document.getElementById("usersByDeviceLegende");
    var legendeContent = '';
    for (let i = 0; i < usersByDeviceKeys.length; i++) {
        legendeContent += "<span class='mr-2'><i class='fas fa-circle' style='color: "+usersByDeviceColors[i]+"';"+"></i>"+" "+usersByDeviceKeys[i]+"</span>";
    }
    legende.innerHTML = legendeContent;
}
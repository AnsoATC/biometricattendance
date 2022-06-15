var devicesByDepartement;
var devicesByDepartementKeys = [], devicesByDepartementValues = [],
    devicesByDepartementColors = [], devicesByDepartementHoverColors = [];

$.ajax({
    url: "partials/devices_by_departement.php"
}).done(function (data) {
    devicesByDepartement = JSON.parse(data);
    var keys = Object.keys(devicesByDepartement);
    var values = Object.values(devicesByDepartement);
    keys = Array.from(keys);
    values = Array.from(values);
    for (let i = 0; i < keys.length; i++) {
        devicesByDepartementKeys[i] = keys[i];
        devicesByDepartementValues[i] = values[i];
    }
    generateColors();
    showDevicesByDepartementChart();
    showDevicesByDepartementLegende();
});

function generateColors(){
    var backgroundColor = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
        hoverBackgroundColor = ['#2e59d9', '#17a673', '#2c9faf', '#e6b23e'];
    
    for (let i = 0; i < devicesByDepartementKeys.length; i++) {
        backgroundColor = backgroundColor.concat(backgroundColor);
        hoverBackgroundColor = hoverBackgroundColor.concat(hoverBackgroundColor);
    }

    devicesByDepartementColors = backgroundColor.slice(0, devicesByDepartementKeys.length);
    devicesByDepartementHoverColors = hoverBackgroundColor.slice(0, devicesByDepartementKeys.length);
}

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function showDevicesByDepartementChart() {
    var ctx = document.getElementById("devicesByDepartementChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: devicesByDepartementKeys,
            datasets: [{
                data: devicesByDepartementValues,
                backgroundColor: devicesByDepartementColors,
                hoverBackgroundColor: devicesByDepartementHoverColors,
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
            cutoutPercentage: 80,
        },
    });
}

function showDevicesByDepartementLegende(){
    var legende = document.getElementById("devicesByDepartementLegende");
    var legendeContent = '';
    for (let i = 0; i < devicesByDepartementKeys.length; i++) {
        legendeContent += "<span class='mr-2'><i class='fas fa-circle' style='color: "+devicesByDepartementColors[i]+"';"+"></i>"+" "+devicesByDepartementKeys[i]+"</span>";
    }
    legende.innerHTML = legendeContent;
}
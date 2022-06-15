var enrolledUsers;
var enrolledUsersKeys = ['non enrollés', 'enrollés'], enrolledUsersValues = [],
    enrolledUsersColors = [], enrolledUsersHoverColors = [];

$.ajax({
    url: "partials/enrolled_users_stats.php"
}).done(function (data) {
    enrolledUsers = JSON.parse(data);
    var keys = Object.keys(enrolledUsers);
    var values = Object.values(enrolledUsers);
    keys = Array.from(keys);
    values = Array.from(values);
    for (let i = 0; i < keys.length; i++) {
        enrolledUsersValues[i] = values[i];
    }
    generateColors();
    showDevicesByDepartementChart();
    showDevicesByDepartementLegende();
});

function generateColors(){
    var backgroundColor = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
        hoverBackgroundColor = ['#2e59d9', '#17a673', '#2c9faf', '#e6b23e'];
    
    for (let i = 0; i < enrolledUsersKeys.length; i++) {
        backgroundColor = backgroundColor.concat(backgroundColor);
        hoverBackgroundColor = hoverBackgroundColor.concat(hoverBackgroundColor);
    }

    enrolledUsersColors = backgroundColor.slice(0, enrolledUsersKeys.length);
    enrolledUsersHoverColors = hoverBackgroundColor.slice(0, enrolledUsersKeys.length);
}

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function showDevicesByDepartementChart() {
    var ctx = document.getElementById("enrolledUsersChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: enrolledUsersKeys,
            datasets: [{
                data: enrolledUsersValues,
                backgroundColor: enrolledUsersColors,
                hoverBackgroundColor: enrolledUsersHoverColors,
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
    var legende = document.getElementById("enrolledUsersLegende");
    var legendeContent = '';
    for (let i = 0; i < enrolledUsersKeys.length; i++) {
        legendeContent += "<span class='mr-2'><i class='fas fa-circle' style='color: "+enrolledUsersColors[i]+"';"+"></i>"+" "+enrolledUsersKeys[i]+"</span>";
    }
    legende.innerHTML = legendeContent;
}
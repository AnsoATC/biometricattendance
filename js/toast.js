$(document).ready(function () {
    $('.toast').toast('show');
});

$(".toast").addClass("active");
$(".progress").addClass("active");

setTimeout(() => {
    $(".toast").removeClass("active");
}, 5000);

setTimeout(() => {
    $(".progress").removeClass("active");
}, 5300);
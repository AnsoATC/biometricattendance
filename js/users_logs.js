$.ajax({
    url: "partials/users_logs_data.php",
    type: 'POST',
    data: {
        'select_date': 1,
    }
}).done(function (data) {
    $(".spinner-border").addClass("d-none");
    $('#usersLogsData').html(data);
});

$('.filterModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var modal = $(this)
    var dep_sel;

    $.ajax({
        url: "partials/select_departement.php"
    }).done(function (data) {
        $('#dep_sel').html("<option value='0'>Tous les départements</option>" + data);
    });

    $(document).on('change', '#dep_sel', function () {
        dep_sel = $('#dep_sel option:selected').val();
        if (dep_sel !== "") {
            console.log("aha");
            $.ajax({
                url: "partials/select_device.php",
                type: 'POST',
                data: {
                    'dep_sel': dep_sel,
                },
            }).done(function (data) {
                $('#dev_sel').html("<option value='0'>Tous les appareils</option>" + data);
            });
        } else {
            console.log("putin");
            $('#dev_sel').html("<option value='0'>Tous les appareils</option>");
        }
    });
});

$(document).on('click', '#user_log', function () {
    var date_sel_start = $('#date_sel_start').val();
    var date_sel_end = $('#date_sel_end').val();
    var time_sel = $(".time_sel:checked").val();
    var time_sel_start = $('#time_sel_start').val();
    var time_sel_end = $('#time_sel_end').val();
    var dep_sel = $('#dep_sel option:selected').val();
    var dev_uid = $('#dev_sel option:selected').val();
    var fing_sel = $('#fing_sel option:selected').val();

    $.ajax({
        url: 'partials/users_logs_data.php',
        type: 'POST',
        data: {
            'log_date': 1,
            'date_sel_start': date_sel_start,
            'date_sel_end': date_sel_end,
            'time_sel': time_sel,
            'time_sel_start': time_sel_start,
            'time_sel_end': time_sel_end,
            'dep_sel': dep_sel,
            'dev_uid': dev_uid,
            'fing_sel': fing_sel,
            'select_date': 0,
        },
        success: function (response) {
            if (response) {
                $.ajax({
                    url: "partials/users_logs_data.php",
                    type: 'POST',
                    data: {
                        'log_date': 1,
                        'date_sel_start': date_sel_start,
                        'date_sel_end': date_sel_end,
                        'time_sel': time_sel,
                        'time_sel_start': time_sel_start,
                        'time_sel_end': time_sel_end,
                        'dep_sel': dep_sel,
                        'dev_uid': dev_uid,
                        'fing_sel': fing_sel,
                        'select_date': 0,
                    }
                }).done(function (data) {
                    $(".spinner-border").addClass("d-none");
                    $('#usersLogsData').html(data);
                });

                $('.filterModal').modal('hide');
                $('#toast-content').text("Les informations ont été filtrées depuis la base de données avec succès !");

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
            }
            else {
                $('.filterModal').modal('hide');

                $('#toast-content').text("Un problème est survenu lors de la requette vers la base de données !");
                $(document).ready(function () {
                    $('#infoToast').toast('show');
                });
                $("#infoToast").removeClass("toast-info").addClass("active toast-danger");
                $(".progress").addClass("active");

                setTimeout(() => {
                    $("#infoToast").removeClass("active");
                }, 5000);

                setTimeout(() => {
                    $(".progress").removeClass("active");
                }, 5300);
            }
        }
    });
})
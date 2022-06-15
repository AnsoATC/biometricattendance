var dev_id, dev_mode;
var mode, array;
var form = document.getElementById('device_edit_form');

$.ajax({
    url: "partials/devices_data.php"
}).done(function (data) {
    $(".spinner-border").addClass("d-none");
    $('#devicesData').html(data);
});

$.ajax({
    url: "partials/select_departement.php"
}).done(function (data) {
    $('#dep_sel').html(data);
});

//Edit function
$('.editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    mode = button.data('mode')
    if (mode === "edit") {
        array = button.data('array').split(",");
        dev_id = array[0];
        $('#dev_name').val(array[2]);
        $('#dep_sel').val(array[1]);
    }
    var modal = $(this)
});

$(".edit_device").click(function () {
    if (form[0].checkValidity()) {
        sendData();
    }
    else {
        //Validate Form
        form[0].reportValidity()
        form.classList.add('was-validated');
    }
});

function sendData() {
    var dev_name = $('#dev_name').val();
    var dep_sel = $('#dep_sel option:selected').val();

    if (mode === "add") {
        console.log("mode 1")
        $.ajax({
            url: 'dev_config.php',
            type: 'POST',
            data: {
                'dev_add': 1,
                'dev_name': dev_name,
                'dep_sel': dep_sel,
            },
            success: function (response) {
                if (response == "1") {
                    $.ajax({
                        url: "partials/devices_data.php"
                    }).done(function (data) {
                        $('#devicesData').html(data);
                    });

                    $('.editModal').modal('hide');
                    $('#toast-content').text("Le département a été ajouté dans la base de données !");

                    $(document).ready(function () {
                        $('.toast').toast('show');
                    });

                    $(".toast").addClass("active toast-info").removeClass("toast-danger");
                    $(".progress").addClass("active");

                    setTimeout(() => {
                        $(".toast").removeClass("active");
                    }, 5000);

                    setTimeout(() => {
                        $(".progress").removeClass("active");
                    }, 5300);
                }
                else {
                    $('.editModal').modal('hide');
                    $('#toast-content').text(response);

                    $(document).ready(function () {
                        $('.toast').toast('show');
                    });

                    $(".toast").addClass("active toast-danger").removeClass("toast-info");
                    $(".progress").addClass("active");

                    setTimeout(() => {
                        $(".toast").removeClass("active");
                    }, 5000);

                    setTimeout(() => {
                        $(".progress").removeClass("active");
                    }, 5300);
                }
            }
        });
    } else {
        $.ajax({
            url: 'dev_config.php',
            type: 'POST',
            data: {
                'edit_dev': 1,
                'dev_id': dev_id,
                'dev_name': dev_name,
                'dep_sel': dep_sel
            },
            success: function (response) {
                if (response == "1") {
                    $.ajax({
                        url: "partials/devices_data.php"
                    }).done(function (data) {
                        $('#devicesData').html(data);
                    });

                    $('.editModal').modal('hide');
                    $('#toast-content').text("Le département a été modifié avec succès !");

                    $(document).ready(function () {
                        $('.toast').toast('show');
                    });

                    $(".toast").addClass("active toast-info").removeClass("toast-danger");
                    $(".progress").addClass("active");

                    setTimeout(() => {
                        $(".toast").removeClass("active");
                    }, 5000);

                    setTimeout(() => {
                        $(".progress").removeClass("active");
                    }, 5300);
                }
                else {
                    $('.editModal').modal('hide');
                    $('#toast-content').text(response);

                    $(document).ready(function () {
                        $('.toast').toast('show');
                    });

                    $(".toast").addClass("active toast-danger").removeClass("toast-info");
                    $(".progress").addClass("active");

                    setTimeout(() => {
                        $(".toast").removeClass("active");
                    }, 5000);

                    setTimeout(() => {
                        $(".progress").removeClass("active");
                    }, 5300);
                }
            }
        });
    }
}

$('.refreshModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    dev_id = button.data('id')
    var modal = $(this)
});

$('.modeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    dev_id = button.data('id');
    dev_mode = button.data('mode');
    var modal = $(this)
});

//Refresh Device
$(document).on('click', '.refreshToken', function () {
    $.ajax({
        url: 'dev_config.php',
        type: 'POST',
        data: {
            'dev_uid_up': 1,
            'dev_id_up': dev_id,
        },
        success: function (response) {
            if (response == "1") {
                $.ajax({
                    url: "partials/devices_data.php"
                }).done(function (data) {
                    $('#devicesData').html(data);
                });

                $('.refreshModal').modal('hide');
                $('#toast-content').text("Le token de l'appareil a été mis à jour avec succès !");

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
                $('.refreshModal').modal('hide');

                $('#toast-content').text("Un problème est survenu lors de la mise à jour du token !");
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
});

//Device Mode
$(document).on('click', '.changeMode', function () {
    $.ajax({
        url: 'dev_config.php',
        type: 'POST',
        data: {
            'dev_mode_set': 1,
            'dev_mode': dev_mode,
            'dev_id': dev_id,
        },
        success: function (response) {
            if (response == "1") {
                $.ajax({
                    url: "partials/devices_data.php"
                }).done(function (data) {
                    $('#devicesData').html(data);
                });

                $('.modeModal').modal('hide');
                $('#toast-content').text("Le mode de l'appareil a été mis à jour avec succès !");

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
                $.ajax({
                    url: "partials/devices_data.php"
                }).done(function (data) {
                    $('#devicesData').html(data);
                });

                $('.modeModal').modal('hide');

                $('#toast-content').text("Un problème est survenu lors du changement du mode de l'appareil !");
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
});

$(document).on('click', '.cancelChangeMode', function () {
    $.ajax({
        url: "partials/devices_data.php"
    }).done(function (data) {
        $('#devicesData').html(data);
    });
});
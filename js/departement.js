var form = document.getElementById('dep_edit_form');
var mode, array;

$.ajax({
    url: "partials/departement_data.php"
}).done(function (data) {
    $(".spinner-border").addClass("d-none");
    $('#departementData').html(data);
});

$('.editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    mode = button.data('mode')
    if (mode === "edit") {
        array = button.data('array').split(",");
        $('#dep_name').val(array[1]);
    }
    console.log(mode)
    var modal = $(this)
});

$(".edit_departement").click(function () {
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
    var dep_name = $('#dep_name').val();

    if (mode === "add") {
        $.ajax({
            url: 'manage_departement.php',
            type: 'POST',
            data: {
                'Add_dep': 1,
                'dep_name': dep_name,
            },
            success: function (response) {
                if (response == "1") {
                    $.ajax({
                        url: "partials/departement_data.php"
                    }).done(function (data) {
                        $('#departementData').html(data);
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
            url: 'manage_departement.php',
            type: 'POST',
            data: {
                'Edit_dep': 1,
                'dep_name': dep_name,
                'dep_id': array[0]
            },
            success: function (response) {
                if (response == "1") {
                    $.ajax({
                        url: "partials/departement_data.php"
                    }).done(function (data) {
                        $('#departementData').html(data);
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
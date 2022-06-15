var finger_id, device_uid;
var array, id;

$(document).ready(function () {
    $('#firstToast').toast('show');
});

$.ajax({
    url: "partials/enrolled_users_data.php"
}).done(function (data) {
    $(".spinner-border").addClass("d-none");
    $('#enrolledUsersData').html(data);
});

$("#firstToast").addClass("active");
$(".progress").addClass("active");

setTimeout(() => {
    $("#firstToast").removeClass("active");
}, 5000);

setTimeout(() => {
    $(".progress").removeClass("active");
}, 5300);

$('.deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    finger_id = button.data('finger_id')
    device_uid = button.data('device_uid')
    var modal = $(this)
    modal.find('.modal-body').text('Etes-vous vraiment sur de vouloir supprimer l\'emprunt ' + finger_id + ' ?')
});

$(document).on('click', '.confimDeletion', function () {
    $.ajax({
        url: 'manage_users_conf.php',
        type: 'POST',
        data: {
            'delete': 1,
            'dev_uid': device_uid,
            'finger_id': finger_id,
        },
        success: function (response) {
            if (response == "1") {
                $.ajax({
                    url: "partials/enrolled_users_data.php"
                }).done(function (data) {
                    $('#enrolledUsersData').html(data);
                });

                $('.deleteModal').modal('hide');
                $('#toast-content').text("Utilisateur supprimer de la base de données avec succès !");

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
                $('.deleteModal').modal('hide');

                $('#toast-content').text("Un problème est survenu lors de la suppression de l'utilisateur !");
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

$('.editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    device_uid = button.data('device_uid')
    id = button.data('id');
    array = button.data('array').split(",")
    $('#dep_sel').html("<option value=''>" + array[0] + "</option>")
    $('#dev_sel').html("<option value=''>" + array[1] + "</option>")
    $('#fingerid').val(array[2]);
    $('#name').val(array[3]);
    $('#email').val(array[4]);
    $('#number').val(array[5]);
    $(".gender").val(array[6]);
    var modal = $(this);
});

$(document).on('click', '.updateUser', function () {
    var finger_id = $('#fingerid').val();
    var name = $('#name').val();
    var email = $('#email').val();
    var gender = $(".gender").val();
    var number = $('#number').val();

    $.ajax({
        url: 'manage_users_conf.php',
        type: 'POST',
        data: {
            'Update': 1,
            'id': id,
            'dev_uid': device_uid,
            'finger_id': finger_id,
            'name': name,
            'number': number,
            'email': email,
            'gender': gender,
        },
        success: function (response) {
            console.log(response);
            if (response == "1") {
                $.ajax({
                    url: "partials/enrolled_users_data.php"
                }).done(function (data) {
                    $('#enrolledUsersData').html(data);
                });

                $('.editModal').modal('hide');
                $('#toast-content').text("Les informations ont été mises à jours dans la base de données avec succès !");

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
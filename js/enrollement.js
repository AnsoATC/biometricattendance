var form = document.getElementById('user_add_form');
var dep_sel;

$.ajax({
  url: "partials/select_departement.php"
}).done(function (data) {
  $('#dep_sel').html("<option value=''>Sélectionez un département</option>"+data);
});

$(document).on('change','#dep_sel', function(){
  dep_sel = $('#dep_sel option:selected').val();
  if(dep_sel !== ""){
    console.log("aha");
    $.ajax({
      url: "partials/select_device.php",
      type: 'POST',
      data: {
        'dep_sel': dep_sel,
      },
    }).done(function (data) {
      $('#dev_sel').html(data);
    });
  }else{
    console.log("putin");
    $('#dev_sel').html("<option value=''>Sélectionez un dispositif</option>");
  }
});

form.addEventListener('submit', function (event) {
  if (form.checkValidity() === false) {
    event.preventDefault();
    event.stopPropagation();
    form.classList.add('was-validated');
  } else {
    event.preventDefault();
    sendData();
  }
});

function sendData() {
  var fingerid = $('#fingerid').val();
  var dev_uid = $('#dev_sel option:selected').val();
  var name = $('#name').val();
  var email = $('#email').val();
  var number = $('#number').val();
  var gender = $(".gender:checked").val();

  $.ajax({
    url: 'manage_users_conf.php',
    type: 'POST',
    data: {
      'Add_fingerID': 1,
      'fingerid': fingerid,
      'dev_uid': dev_uid,
      'name': name,
      'email': email,
      'number': number,
      'gender': gender
    },
    success: function (response) {
      console.log(response)
      if (response == "1") {
        $('#dev_sel').val('0');
        $('#fingerid').val('');

        window.location.href = 'enrolled_user.php?user_add=success'
      }
      else {
        $('#toast-content').text(response);

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
    }
  });
}
// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "language": {
      "lengthMenu": "Afficher _MENU_ par page",
      "search": "Rechercher :",
      "zeroRecords": "Rien trouvé - désolé",
      "info": "Affichage page _PAGE_ sur _PAGES_",
      "infoEmpty": "Aucune donnée disponible",
      "infoFiltered": "(filtré sur _MAX_  au total)"
    }
  });
});

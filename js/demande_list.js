$(document).ready(function () {
    chercher();

    $("#btn-chercher").click(function (e) {
        e.preventDefault(); // toujours bien de le mettre
        chercher();
    });

    function chercher() {
        let idDemande = $("#idDemande").val();
        let origine = $("#origine").val();
        let client = $("#client").val();
        let date_debut = $("#date_debut").val();
        let date_fin = $("#date_fin").val();

        console.log(idDemande);
        console.log(origine);
        console.log(client);
        console.log(date_debut);
        console.log(date_fin);

        $("#lesdonnees").empty().append(
            '<tr><td colspan="9" align="center"><img src="../images/ajax.loader.gif" align="absmiddle"> Chargement</td></tr>'
        ).hide().fadeTo(700, 1);

        $.post(
            "../ajax/demande_list.ajax.php",
            {
                idDemande,
                origine,
                client,
                date_debut,
                date_fin
            },
            function (data) {
                $("#lesdonnees").empty().append(data.lignes).hide().fadeIn('slow');
            },
            "json"
        );
    }
});

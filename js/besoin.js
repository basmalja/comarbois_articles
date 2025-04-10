$(document).ready(function () {
    chercher();

    $("#btnEnregistrer").click(function (e) {
        e.preventDefault();

        const formData = {
            idbesoin: $("#idbesoin").val(),
            date: $("#date").val(),
            origine: $("#origine").val(),
            client: $("#client").val(),
            objet: $("#objet").val()
        };

        $.ajax({
            type: "POST",
            url: "../ajax/insert_besoin.ajax.php",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert("✅ " + response.message);

                    // Si besoin de faire quelque chose avec l'ID inséré :
                    // $("#idbesoin").val(response.idbesoin);

                    // Réinitialiser les champs
                    $("#date").val('');
                    $("#origine").val('');
                    $("#client").val('');
                    $("#objet").val('');

                    chercher();
                } else {
                    alert("❌ " + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.log("Erreur AJAX:", xhr.responseText);
            }
        });
    });
});

function chercher() {
    let id = $("#idbesoin").val();

    $("#lesdonnees").empty().append(
        '<tr><td colspan="9" align="center"><img src="../images/ajax.loader.gif" align="absmiddle"> Chargement</td></tr>'
    ).hide().fadeTo(700, 1);

    $.post(
        "../ajax/list_details.ajax.php",
        { idBesoin: id },
        function (data) {
            $("#lesdonnees").empty().append(data.lignes).hide().fadeIn('slow');
        },
        "json"
    );
}

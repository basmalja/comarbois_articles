$(document).ready(function () {
    chercher();

    $("#btnEnregistrer").click(function (e) {
        e.preventDefault();
        const formData = {
            idbesoin: $("#idbesoin").val(),
            date: $("#date").val(),
            origine: $("#origine").val(),
            client: $("#client").val(),
            objet: $("#objet").val(),
            status: $("#status").val()
        };
        // Check if all three fields are empty
        if (!formData.date || !formData.origine) {
            alert("❌ Please fill in all fields.");
            return; // Stop execution if validation fails

        }
        if (formData.origine === "vente" && !formData.client) {
            alert("❌ Veuillez définir le client");
            return; // Prevent further execution if "client" is empty
        }

        $.ajax({
            type: "POST",
            url: "../ajax/insert_besoin.ajax.php",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert("✅ " + response.message);

                    $("#btnEnregistrer").attr("hidden", true);

                    $("#idbesoin").val(response.idbesoin);

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

    

    $("#btn-chercher").click(function (e) {
        chercher()
    })

    function chercher() {
        let id = $("#idbesoin").val();
        let origine = $("#origine").val();
        let client = $("#client").val();
        let objet = $("#objet").val();
        let date_debut = $("#date_debut").val();
        let date_fin = $("#date_fin").val();
        let status = $("#status").val();
        $("#lesdonnees").empty().append(
            '<tr><td colspan="9" align="center"><img src="../images/ajax.loader.gif" align="absmiddle"> Chargement</td></tr>'
        ).hide().fadeTo(700, 1);

        $.post(
            "../ajax/besoin_list.ajax.php",
            { idBesoin: id,
                origine: origine,
                client: client,
                objet: objet,
                date_debut: date_debut,
                date_fin: date_fin , status: status },
            function (data) {
                $("#lesdonnees").empty().append(data.lignes).hide().fadeIn('slow');
            },
            "json"
        );
    }


});


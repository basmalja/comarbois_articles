$(document).ready(function () {
    chercher();

    $("#btnEnregistrer").click(function (e) {
        e.preventDefault();
        // hide the button after click
        $("#btnEnregistrer").attr("hidden", true);
        const formData = {
            idbesoin: $("#idbesoin").val(),
            date: $("#date").val(),
            origine: $("#origine").val(),
            client: $("#client").val(),
            objet: $("#objet").val()
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
});

function chercher() {
    const formData = {};

    // Automatically get all input[type="text"], input[type="date"], select inside the form
    $("#filterForm")
        .find('input[type="text"], input[type="date"], select')
        .each(function () {
            const name = $(this).attr('name') || $(this).attr('id');
            const value = $(this).val();
            if (name) {
                formData[name] = value;
            }
        });

    $("#lesdonnees").empty().append(
        '<tr><td colspan="9" align="center"><img src="../images/ajax.loader.gif" align="absmiddle"> Chargement...</td></tr>'
    ).hide().fadeTo(700, 1);

    $.ajax({
        type: "POST",
        url: "../ajax/besoin_list.ajax.php",
        data: formData,
        dataType: "json",
        success: function (data) {
            if (data.erreur && data.erreur !== '') {
                $("#message").attr('class', 'err')
                    .empty()
                    .append('<img src="images/err.png" align="absmiddle"> ' + data.erreur)
                    .hide()
                    .fadeTo(700, 1);
            } else {
                $("#lesdonnees").empty().append(data.lignes).hide().fadeIn('slow');
                $("#nbreEnr").empty().text(data.nbreEnre + ' enregistrement(s)').hide().fadeIn('slow');
                $("#pages").empty();
            }
        },
        error: function (xhr) {
            console.error("Erreur AJAX:", xhr.responseText);
        }
    });
}


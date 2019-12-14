$(document).ready(function () {



    $("#edit_users_status").change(function () {
    //     // console.log($("#edit_users_status").val());
    //
        var valeur = $(this).val();

        //console.log(valeur);

        if(valeur == 'ROLE_ADMIN'){
            var status = 'Administrateur';
            var back = 'ROLE_USER';
        }
        else{
            var status = 'Membre';
            var back = 'ROLE_ADMIN';
        }

        if(confirm('Vous allez passer le statut en mode ' + status)){
            //console.log(valeur);
        } else {
            $(this).val(back);
        }


        //confirm("Vous vous appretez à changer le status du membre");
    });



});
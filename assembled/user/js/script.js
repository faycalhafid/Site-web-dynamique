
function addComment(ID_recette, ID_user, commentaire) {
        // Add record
alert("vvvv");
        $.post("Ajax/create.php", {
            ID_recette: ID_recette,
            ID_user: ID_user,
            commentaire: commentaire
        }, function (data, status) {
            // close the popup
            $("#add_new_record_modal").modal("hide");
 
            // read records again
            readComment(ID_recette);
 
            // clear fields from the popup
            $("#Auteur").val("");
            $("#commentaire").val("");
        });
    }
}
	
// READ comment
function readComment(ID_recette) {
    $.get("Ajax/read.php", { ID_recette: ID_recette}, function (data, status) {
        $(".comment_content").html(data);
    });
}

//get detail commentaire

function GetCommentDetails(ID) {
    // Add User ID to the hidden field
    $("#hidden_user_id").val(ID);
    $.post("Ajax/details.php", {
            ID: ID
        },
        function (data, status) {
            
            // PARSE json data
            var user = JSON.parse(data);
            // Assign existing values to the modal popup fields
            	
            $("#update_Commentaire").val(user.Commentaire);
            
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

//update commentaire

function UpdateUserDetails() {
    // get values
    var commentaire = $("#update_Commentaire").val();
    commentaire = commentaire.trim();
        // get hidden field value
        var id = $("#hidden_user_id").val();
 
        // Update the details by requesting to the server using ajax
        $.post("Ajax/update.php", {
                id: id,
                commentaire: commentaire
            },
            function (data, status) {
                // hide modal popup
                $("#update_user_modal").modal("hide");
                // reload Users by using readRecords();
                readComment();
            }
        );
    
}
//delete commentaire
	
function DeleteUser(id) {
    var conf = confirm("Are you sure, do you really want to delete User?");
    if (conf == true) {
        $.post("Ajax/delete.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readComment();
            }
        );
    }
}

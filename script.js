
function addlike(idchro) 
{
    div = document.getElementById("divstars");
    likevalue = document.getElementById("likecount");
    likestar = document.getElementById("likestar");

    var count = parseInt(likevalue.innerHTML);
    $("body").css("cursor", "progress");
    $.ajax
    (
        {
            type: "POST",               
            url: "/addLike.php",
            data: { idchronique: idchro },
            success: function(msg)
            {
                $("body").css("cursor", "auto");
                var star = document.createElement("img");
                star.setAttribute('src', '/assets/star.png');
                div.appendChild(star);
                count = count + 1;
                likevalue.innerHTML = count.toString();
                likestar.parentNode.removeChild(likestar);
            },
            error : function(resultat, statut, erreur)
            {

       		},
            complete : function(resultat, statut)
            {
       		}
        }
    )
}


function addComment(idc)
{
    if (document.getElementById('dont-fuck-with-me').value.length > 0)
        return false;

    commentlistDiv = document.getElementById("commentboxid");
    newDiv = document.createElement("div");
    newDiv.className = "cm-box";

    newP = document.createElement("p");
    newH4 = document.createElement("h4");
    
    textarea = document.getElementById("comment-text-area");
    pseudoinput = document.getElementById("comment-pseudo");
    textComment = textarea.value.trim();
    pseudo = pseudoinput.value.trim();
    if (textComment.length > 0 && pseudo.length > 0)  
    {
        $("body").css("cursor", "progress");
        $.ajax
        (
            {
                type: "POST",               
                url: "/addComment.php",
                data: { comment: textComment, idchronique: idc, idauthor: 0, anonymouspseudo: pseudo },
                success: function(msg)
                {
                    newH4.innerHTML = "Ecrit à l'instant par " + pseudo + " </H4>";
                    newP.innerHTML = textComment;
                    newDiv.appendChild(newP);
                    newDiv.appendChild(newH4);
                    commentlistDiv.appendChild(newDiv);

                    newSeparator = document.createElement("div");
                    newSeparator.className = "cm-separator-double";
                    commentlistDiv.appendChild(newSeparator);

                    $("body").css("cursor", "auto");
                    
                    // On resete le contenu de la zone de saisie
                    textarea.value = '';
                },
                error: function(msg)
                {
                    alert('Impossible d\'ajouter votre commentaire !');
                }
            }
        )
        
    
  }

}

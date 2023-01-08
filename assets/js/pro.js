   var form = document.getElementById('verifier');
   var nom_type_contrat = document.getElementById('nom_type_contrat');
   var description = document.getElementById('description') ;
   var date_creation = document.getElementById('date_creation') ;
   var date_modification= document.getElementById('date_modification') ;
   var errors = document.getElementById('error');
   
   var hasErrors = 0;

   form.addEventListener("submit", function(e){
      e.preventDefault();
      errors.innerHTML = "";
      var hasErrors = 0;

      if(nom_type_contrat.value==""){
         var divError = document.createElement("div");
         divError.className = "alert alert-danger";
         divError.setAttribute("role", "alert");
         divError.innerText = "Entrer le nom du contrat svp";
         errors.append(divError);
         email.focus();
         hasErrors++;
      }
   
      if( description.value == ""){
         var divError = document.createElement("div");
         divError.className = "alert alert-danger";
         divError.setAttribute("role", "alert");
         divError.innerText = "Entrez votre description";
         errors.append(divError);
         if(hasErrors == 0) {
            sujet.focus();
         }
         hasErrors++;
      }
      if(date_creation.value == ""){
         var divError = document.createElement("div");
         divError.className = "alert alert-danger";
         divError.setAttribute("role", "alert");
         divError.innerText = "Entrez votre date";
         errors.append(divError);
         if(hasErrors == 0) {
            message.focus();
         }
         hasErrors++;
      }
      if( date_modification.value == ""){
        var divError = document.createElement("div");
        divError.className = "alert alert-danger";
        divError.setAttribute("role", "alert");
        divError.innerText = "Entrez votre modification";
        errors.append(divError);
        if(hasErrors == 0) {
           message.focus();
        }
        hasErrors++;
     }
   
      if(hasErrors == 0) {
         alert("nom_type_contrat : "+ nom_type_contrat.value + "  \n\n " + " description: " +description.value + "\n\n" + " date_creation : "+ date_creation.value + "  \n\n " + " date_modification: " + date_modification.value);
         errors.innerHTML = '<div class="alert alert-success" role="alert">merci beaucoup davoir rempli le formulaire </div>';
      }
      
   
    });
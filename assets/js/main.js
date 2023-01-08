 function validation(){
    var start_date = document.getElementById('leave_start_date').value;
    var end_date = document.getElementById('leave_end_date').value;
    var leave_duration = document.getElementById('leave_duration').value;
    var employe = document.getElementById('id_employee').value;
    var error = document.getElementById('error');
    

    if (employe=="" & start_date== "" & end_date== "" & leave_duration=="" & employe=="") {
        var error = '+<div class="alert alert-danger" role="alert">veillez entrez toutes les informations!!!</div>';
         errors.innerHTML=error;
         email.focus();
         return false;
       }
     else if (start_date== "") {
        error.innerHTML= "Veillez entrer l'id de l'employe!!!";
        sujet.focus();
        return false;
      }
      else if (start_date== "") {
           error.innerHTML= 'Veillez entrer la date de debut!!!';
           sujet.focus();
           return false;
         }
      else if (end_date== "") {
            error.innerHTML= 'Veillez entrer la date de fin!!!';
            sujet.focus();
            return false;
          }
      else if (leave_duration== "") {
            error.innerHTML= 'Veillez entrer la duree du conge!!!';
            sujet.focus();
            return false;
          }
}
var senha = document.getElementById("senha")
  , conf_senha = document.getElementById("conf_senha");

function validatePassword(){
  if(senha.value != conf_senha.value) {
    conf_senha.setCustomValidity("Senhas diferentes!");
  } else {
    conf_senha.setCustomValidity('');
  }
}

senha.onchange = validatePassword;
conf_senha.onkeyup = validatePassword;
function cadastroAluno(){
  event.preventDefault();
  var email = $('.email').val();
  var senha = $('.senha').val();
  
  $.ajax({
    type: 'POST',
    url: '../app/requests/cadastroAluno.php',
    dataType: 'JSON',
    data: {
      email: email,
      senha: senha
    },
    success: function (data) {
      Swal.fire({
        title: data.tittle,
        text: data.msg,
        icon: data.icon
      }).then(() => {
        window.location.replace('loginAluno.html');
      });
    },
    error: function(data){

    }

  }) 
}

function loginAluno(){
  event.preventDefault();
  var email = $('.email').val();
  var senha = $('.senha').val();

  $.ajax({
      type: 'POST',
      url: '../app/requests/loginAluno.php',
      dataType: 'JSON',
      data: {
      email: email,
      senha: senha
      },
      success: function(data){
      if(data.sucesso){
          window.location.replace(data.redirecionar);

      }else{
          Swal.fire({
          title: data.tittle,
          text: data.msg,
          icon: data.icon
        });
      }
      },
      error: function(xhr, error, status){
      console.log(xhr, error, status);
      }

  }) 
}

function cadastroEmpresa(){
  event.preventDefault();
  var email = $('.email').val();
  var senha = $('.senha').val();
  
  $.ajax({
    type: 'POST',
    url: '../app/requests/cadastroEmpresa.php',
    dataType: 'JSON',
    data: {
      email: email,
      senha: senha
    },
    success: function(data){
      Swal.fire({
        title: data.tittle,
        text: data.msg,
        icon: data.icon
      }).then(() => {
        window.location.replace('loginEmpresa.html');
      });
    },
    error: function(data){

    }

  }) 
}

function loginEmpresa(){
  event.preventDefault();
  var email = $('.email').val();
  var senha = $('.senha').val();
  
  $.ajax({
    type: 'POST',
    url: '../app/requests/loginEmpresa.php',
    dataType: 'json',
    data: {
      email: email,
      senha: senha
    },
    success: function(data){
      if(data.sucesso){
        window.location.replace(data.redirecionar);

      }else{
        Swal.fire({
          title: data.tittle,
          text: data.msg,
          icon: data.icon
        });
      }
      
    },
    error: function(xhr, error, status){
      console.log(xhr, error, status);
    }

  }) 
}

function loginAdmin(){
event.preventDefault();
var email = $('.email').val();
var senha = $('.senha').val();

$.ajax({
    type: 'POST',
    url: '../app/requests/loginAdmin.php',
    dataType: 'JSON',
    data: {
    email: email,
    senha: senha
    },
    success: function(data){
    if(data.sucesso){
        window.location.replace(data.redirecionar);

    }else{
        Swal.fire({
        title: data.tittle,
        text: data.msg,
        icon: data.icon
      });
    }
    },
    error: function(xhr, error, status){
    console.log(xhr, error, status);
    }

}) 
}
<!DOCTYPE html>
<?php


 include("config.php");
   session_start();
   $error="";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM usuarios WHERE usuario = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
  
    
      if($count == 1) {
        // session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: inicio.php");
      }else {
         $error = "Usuario o contraseña incorrecta";
      }
   }
?>




<html>
<head>
  <meta charset="UTF-8"/>
  <link  rel="icon"   href="planeta.ico" type="image/png" />
  <title>Inicio</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="css/estilo.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="css/font.css">
</head>
<body>
<div class="social-bar">
    <a href="https://www.facebook.com/DevCode.la" class="fa fa-envelope" data-toggle="modal" data-target="#contacto"></a>
    
  </div>
<nav  class="menu navbar navbar-expand-lg navbar-light  ">
  <img style="width: 8%;" class="navbar-brand" src="img/logo.png">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a  style="color:#fff;" class="nav-link linkm" href="index.html">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a style="color:#fff;" class="nav-link linkm" href="servicios.html">Servicios</a>
      </li>
      
     
   </ul>
    <form class="form-inline my-2 my-lg-0">
      
      <a onClick="window.location.href = 'ingreso.php'" class="btn btn-outline-success my-2 my-sm-0 ingreso">Ingreso</a>
    </form>
  </div>
</nav>
<div class="container-fluid">
<div class="row">
<div class="textob col-lg-8">
<h1 class="text-center">Bienvenido</h1>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.

</p>
	
</div>
	<div  class="textoi col-lg-4">
<h1 class="">Ingreso</h1>

<form class="text-center" action = "" method = "post">
  <div class="form-group row text-center">
    
    <div class="col-sm-10">

      <input type="text" class="form-control login" id="inputEmail3" placeholder="Usuario"  onkeypress="return ValidaLongitud(this, 20);" name="username" >
    </div>
  </div>
  <div class="form-group row">
    
    <div class="col-sm-10">
      <input type="password" class="form-control login " id="inputPassword3" placeholder="Password"  onkeypress="return ValidaLongitud(this, 20);" name="password" >
    </div>
  </div>
  
  <div class="form-group row">
    <div class="col-sm-10">
    <h6 class="text-center errorin"><?php echo $error; ?></h6>
      <button type="submit" class="btn btn-primary">Ingreso</button>
    </div>
  </div>
  
</form>
		
	</div>
</div>
	
</div>
<div class=" container-fluid">
<div class="ncetrot col-lg-12">
	<p class="text-center">
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
</p>
<div class="text-center">
	
</div>
</div>


<div class="container-fluid">
	<div class="row">
  <div class="col-lg-12">
  <div class="ncetrot text-center">
    <img src="img/descarga.png" alt="..." class="img-thumbnail">
<img src="img/descarga.png" alt="..." class="img-thumbnail">
<img src="img/descarga.png" alt="..." class="img-thumbnail">
</div>
  </div>

	
</div>
</div>
</div>
<footer class="page-footer font-small blue pt-4">
    <div style="color:#fff;" class=" foter footer-copyright text-center py-3">Derechos Reservados
      <a> TECNICOM</a>
    </div>


  </footer>
  <div class="modal fade" id="contacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">CONTACTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form>
     
  <div class="form-group ">
    <label for="exampleFormControlInput1">Nombre</label>
    <input required type="text" class="form-control" id="exampleFormControlInput1" onkeypress="return ValidaLongitud(this, 50);" >
  </div>
  <div class="form-group ">
    <label for="exampleFormControlInput1">Email</label>
    <input required type="email" class="form-control" id="exampleFormControlInput1" >
  </div>
  
  
  <div class="form-group ">
    <label for="exampleFormControlTextarea1">Mensaje</label>
    <textarea required  class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
   <button type="submit" class="btn btn-primary">Enviar</button>
   </form>

      </div>
     
     
    </div>
  </div>
</div>  
<script type="text/javascript">
  function checkKeyCode(evt)
{

var evt = (evt) ? evt : ((event) ? event : null);
var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
if(event.keyCode==116)
{
evt.keyCode=0;
return false
}
}
document.onkeydown=checkKeyCode;
function ValidaLongitud(campo, longitudMaxima) {
            try {
                if (campo.value.length > (longitudMaxima - 1))
                    return false;
                else
                    return true;             
            } catch (e) {
                return false;
            }
        }
</script>
</body>
</html>
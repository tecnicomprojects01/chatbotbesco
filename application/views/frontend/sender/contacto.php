
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <title>ChatBot | TECNICOM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="SHORTCUT ICON" href="https://www.tecnicom.pe/icon-tecnicom.ico">
    <link href="<?= base_url()?>public/frontend/css/bootstrap.min.css?v=<?= time()?>" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="<?= base_url()?>public/frontend/css/cb_css.css?v=<?= time()?>">
    <script src="<?= base_url()?>public/frontend/js/jquery.min.js"></script>
    <script src="<?= base_url()?>public/frontend/js/bootstrap.min.js"></script>
    <script>var intervalc = '';</script>
  <script src="<?= base_url()?>public/frontend/js/chat.js?v=<?= time()?>"></script>

  <script>var base_url = "<?= base_url()?>index.php/"</script>
  <script>var base_url_no = "<?= base_url()?>"</script>
    <script>var start_c = "<?= $start?>"</script>
    <script>var USER_PIC = "<?= USER_PIC?>"</script>

    <script type="text/javascript">

        window.alert = function(){};

        var defaultCSS = document.getElementById('bootstrap-css');

        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }

        $( document ).ready(function() {
          $('.guardar_datos_c').on('click',function(){

              guardar_datos_c();
          });
        });
    </script>

    <style>
      .error_c{
          color: #ffb9b9;
      }
      .listo_datos{
        padding: 21px;
        background: white;
        border-radius: 6px;
      }
      .no_datos{
        padding: 21px;
        background: white;
        border-radius: 6px;
        text-align: center;
      }
    </style>
  
</head>
<body>
  <input type="hidden" id="si_escribio_c" value="0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  
  <link rel="stylesheet" type="text/css" href="<?= base_url()?>public/frontend/css/jquery.mCustomScrollbar.min.css">
  <script type="text/javascript" src="<?= base_url()?>public/frontend/js/jquery.mCustomScrollbar.min.js"></script>

  <div class="container-fluid h-100">
    <div class="row justify-content-center h-100 back_chat">
      
      <div class="col-lg-12 chat">
        
        <div class="card" style="height: 434px">
          <div class="card-header msg_head">

            <div class="d-flex bd-highlight">
              <div class="img_cont">
                <img src="<?= base_url()?>public/frontend/img/<?= ASISTENTE_PIC?>?v=<?= time()?>" class="rounded-circle user_img">
                <span class="online_icon"></span>
              </div>
              <div class="user_info">
           
                
              </div>
              <h4 style="color: white;" class="text-center">Ingresa tus datos de contacto</h4>
              
            </div>
          </div>
          <div class="card-body datos_c_body">
            <form method="POST" style="padding: 22px;">

              <?php if(!isset($cliente['datos_contacto']) OR $cliente['datos_contacto'] == 0): ?>
              <?php $id_proyecto = $proyecto['id']; ?>
              <?php $id_cliente = $cliente['id']; ?>
              <div class="form-group">
                <input class="form-control" id="nombre_chat" placeholder="Ingresa tu Nombre" maxlength="150" onkeypress="return sololetras(event)" onkeyup="$('#error_nombre_c').hide();">
                <p class="error_c" id="error_nombre_c" style="display: none;">Debes ingresar tu nombre.</p>
                <input type="hidden" value="<?= $id_proyecto ?>" id="id_proyecto">
              </div>
              <div class="form-group">
                <input class="form-control" id="apellido_chat" placeholder="Ingresa tu Apellido " maxlength="150" onkeypress="return sololetras(event)" onkeyup="$('#error_nombre_c1').hide();">
                <p class="error_c" id="error_nombre_c1" style="display: none;">Debes ingresar tus apellidos.</p>
                <input type="hidden" value="<?= $id_cliente ?>" id="id_cliente">
              </div>

              <div class="form-group">
                <input class="form-control" id="dni_chat" placeholder="Ingresa tu DNI" maxlength="8" onkeypress="return valida(event)" >
              </div>

              <div class="form-group ">
                <select class="form-control col-lg-4" id="codigo_chat" style="width: 30%;display: inline-block;float: left;">
              <?php foreach ($prefijos as $p): ?>
                <option value="<?= $p['codigo']?>" <?=($p['codigo'] == PREFIJO_PRED)?'selected':''?>><?= $p['codigo']?></option>
              <?php endforeach ?>
            </select>

            <input type="text" id="numero_chat" class="form-control" placeholder="Ingresa tu  teléfono" maxlength="12" onkeypress="return valida(event)" onkeyup="$('#error_numero_c').hide();" style="width: 67%;display: inline-block;float: left;    margin-left: 3%;">

            <p class="error_c" id="error_numero_c" style="display: none;margin-bottom: -58px;">El formato de tu número telefónico es incorrecto.</p>
              </div>

              <div class="form-group" style="margin-top: 68px;">
                <input type="email" class="form-control" id="email_chat" placeholder="Ingresa tu correo electrónico" maxlength="150" >
              </div>
              <?php endif ?>

            <?php if(isset($cliente['datos_contacto']) AND $cliente['datos_contacto'] == 1): ?>
              <p style="color: #636467;font-weight: bold;" class="no_datos">¡Ya nos has enviado tus datos de contacto!</p>
            <?php endif ?>

              </div>
                <?php if(!isset($cliente['datos_contacto']) OR $cliente['datos_contacto'] == 0): ?>
                  <div class="modal-footer conctacto_c_guardar">
                    <div class="col-md-4 col-xs-12"></div>

                    <div class="col-md-4 col-xs-12 " style="text-align: center;">
                      <button type="button" class="btn btn-primary p-x-md guardar_datos_c">Enviar datos de contacto</button>
                    </div>

                    <div class="col-md-4 col-xs-12"></div>
                  
                  </div>
              <?php endif ?>

            </form>

          </div>

          <div class="card-footer">
            
            
          </div>
        </div>
      </div>
    </div>
  </div>

  </body>
</html>
<?php $id_proyecto = $proyecto['id']; ?>
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
    <!--<script>var start_c = "<?= $start?>"</script>-->
    <script>var USER_PIC = "<?= USER_PIC?>"</script>

    <script type="text/javascript">

        window.alert = function(){};

        var defaultCSS = document.getElementById('bootstrap-css');

        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }

        $( document ).ready(function() {
          //Hacer llamada
          $('.enviar_llamada_c').on('click',function(){
            enviar_llamada_c();
          });
        /*
        $("#ingreso").click(function() {
            var pw = $("#numero_chat_llamada").val();            
            var proyecto=<?php echo $id_proyecto; ?>;
            var datos = "number=" + pw +"&proyecto=" + proyecto ;
            if ( $.trim(pw).length > 0 && pw!=999999999) {
                $.ajax({
                    type: "POST",
                    url: "https://35.236.241.218/make_call.php",
                    data: datos,
                    success: function(data) {                        
                      console.log("Correcto");
                    }
                });
            }
        });*/
    });
      
    </script>

    <style>
      .error_c{
          color: #ffb9b9;
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
      
      <div class="col-md-6 col-xl-6 chat">
        
        <div class="card" style="height: 323px">
          <div class="card-header msg_head">

            <div class="d-flex bd-highlight">
              <div class="img_cont">
                <img src="<?= base_url()?>public/frontend/img/<?= ASISTENTE_PIC?>?v=<?= time()?>" class="rounded-circle user_img">
                <span class="online_icon"></span>
              </div>
              <div class="user_info">
               
                
              </div>
              <h4 style="color: white;margin-top: 17px;">Ingresa tu número de teléfono</h4>
              
            </div>
          </div>
          <div class="card-body datos_c_body">
            <form method="POST" style="padding: 22px;">

              <div class="form-group">
                  <select class="form-control" id="codigo_chat_llamada" style="width: 30%;display: inline-block;float: left;">
                <?php foreach ($prefijos as $p): ?>
                  <option value="<?= $p['codigo']?>" <?=($p['codigo'] == PREFIJO_PRED)?'selected':''?>><?= $p['codigo']?></option>
                <?php endforeach ?>
              </select>

              <input type="text" id="numero_chat_llamada" class="form-control" placeholder="Ingresa tu  teléfono" maxlength="12" onkeypress="return valida(event)" onkeyup="$('#error_numero_c').hide();" style="width: 66%;display: inline-block;float: left;    margin-left: 3%;">
              <input type="hidden" id="cliente_id" value="<?= $cliente_id ?>">
              <input type="hidden" id="proyecto_id" value="<?= $proyecto['id'] ?>">

              <p class="error_c" id="error_numero_c_llamada" style="display: none;">El formato de tu número telefónico es incorrecto.</p>

                  
              </div>
              <p id="success_numero_c_llamada" style="background: white;display: none;color: #002162;margin-top: 49px;font-weight: bold;padding: 7px;border-radius: 5px;text-align: center;">¡Listo! En un momento te llamaremos.</p>

              </div>
               
                  <div class="modal-footer conctacto_c_guardar">
                    <div class="col-md-4 col-xs-12"></div>

                    <div class="col-md-4 col-xs-12 " style="text-align: center;">
                     
                      <button type="button" id="ingreso" class="btn btn-primary p-x-md enviar_llamada_c ">Llamar Gratis  </button>
                    </div>

                    <div class="col-md-4 col-xs-12"></div>
                  
                  </div>

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
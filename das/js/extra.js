function alertForm(e){
  var who= window.event? event.srcElement: e.target;
  var boton = $(document.activeElement).val();
  if (boton === 'Actualizar') {
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'),
      data: $(this).serialize(),

      success: function (data) {
        var json = JSON.parse(data);
        alert(json.mensaje);
        window.location.href = window.location.href
      },
      error: function () {
        console.log('Ocurrio un error por favor intente nuevamente');
      }
    })
  }else if(boton === 'Eliminar'){
    var aceptar = confirm("¿Está seguro que desea Eliminar el proyecto ?");
    if (aceptar) {
      $.ajax({
        type: 'POST',
        url: 'eliminarproyectov.php',
        data: $(this).serialize(),

        success: function (data) {
          var json = JSON.parse(data);
          alert(json.mensaje);
          window.location.href = window.location.href
        },
        error: function () {
          console.log('Ocurrio un error por favor intente nuevamente');
        }
      })
    }
  }else if(boton === 'Asignar'){
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'),
      data: $(this).serialize(),

      success: function (data) {
        var json = JSON.parse(data);
        alert(json.mensaje);
        window.location.href = window.location.href
      },
      error: function () {
        console.log('Ocurrio un error por favor intente nuevamente');
      }
    })
  }  
  return false;
}
onload=function(){
  var i= 0,F= document.getElementsByTagName('form');
  while(F[i]){
    if(F[i].name !== 'ignorar')
      F[i++].onsubmit= alertForm;
    else
      i++;
  }

  window.onunload=function(){};
}
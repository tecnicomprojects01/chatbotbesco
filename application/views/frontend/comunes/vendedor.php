
<?php 
	//Calcular height

	$height = (isset($llamada) AND $llamada)?'160px':'110px';
?>
<div class="col-md-12 col-xs-12" style="margin-bottom: 15px;height: <?= $height?>;">

	<?php if(isset($llamada) AND $llamada): ?>
	<div class="col-md-12 col-xs-12" style="display: inline-block;float: left;margin-bottom: 15px;text-align: center;">
		
		<button type="button" class="btn btn-primary" style="width: 72%;font-size: 14px" onclick="$('#chat_phone_modal').modal('show');"> <i class="fa fa-phone"></i> ¡Llámanos Gratis!</button>
			
	</div>
	<?php endif ?>

	<div class="col-md-12 col-xs-12" style="display: inline-block;float: left;margin-bottom: 15px;text-align: center;">
		
		<button type="button" class="btn btn-primary" onclick="whatsapp_me_c('<?= $whatsapp?>')" style="width: 72%;font-size: 14px"><img src="<?= base_url()?>public/frontend/img/whatsapp.png?v=<?= time()?>" style="width: 6%;margin-bottom: 3px;margin-left: -6px;"> Escribenos por WhatsApp</button>

	</div>

	<div class="col-md-12 col-xs-12" style="display: inline-block;float: left; text-align: center;margin-bottom: 15px;">
		
		<button type="button" class="btn btn-primary" onclick="form_contact_c()" style="width: 72%;font-size: 14px"><i class="fa fa-envelope" style="font-size: 17px;"></i> Déjanos tus datos de contacto </button>

	</div>

</div>
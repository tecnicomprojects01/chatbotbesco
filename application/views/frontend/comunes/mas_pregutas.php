<?php 
	//Calcular height
	
	$cantidad = count($cualidades);

	$numero = applib::es_par($cantidad);

	$cantidad = $numero?$cantidad:$cantidad+1;

	$height = (($cantidad / 2) * 35) + 38 + 53;
	
	$height .= 'px';
?>

<div class="col-md-12 col-xs-12" style="margin-bottom: 15px;height: <?=$height?>">
	<p style="text-align: center;font-size: 15px;color: white;font-weight: bold;margin-top: -9px;margin-bottom: 7px;
"><?= $msg?></p>
	<?php foreach($cualidades as $p): ?>
		<div class="col-md-6 col-xs-6" style="display: inline-block;float: left;margin-bottom: 8px;width: 50%;">
			<button type="button" class="btn btn-warning" style="width: 100%;color: white;background: orange;padding: 3px;" onclick="set_pregunta(<?= $p['id']?>)">
				<span style="font-size: 13px;font-weight: bold;"><?= $p['cualidad']?></span> 
				
			</button>
		</div>
	<?php endforeach ?>

	<div class="col-md-12 col-xs-12" style="display: inline-block;float: left;margin-bottom: 8px;text-align: center;margin-top: 4px;">
		<button type="button" class="btn btn-warning" style="width: 70%;color: white; background: #002162;border: #ffffff 1px solid; padding: 8px;margin-top: 1px;" onclick="escribir_bot(0,'com')">
			<span style="font-size: 15px;font-weight: bold;" ><i class="fa fa-phone"></i> Hablar con un Asesor</span> 
			
		</button>
	</div>
</div>

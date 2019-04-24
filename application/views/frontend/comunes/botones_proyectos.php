<?php 
	//Calcular height
	
	$cantidad = count($proyectos);

	//$numero = applib::es_par($cantidad);

	//$cantidad = $numero?$cantidad:$cantidad+ 1;
	
	$height = ($cantidad  * 45);
	

	$height .= 'px';
?>

<div class="col-md-12 col-xs-12" style="margin-bottom: 15px;margin-bottom: 15px;height: <?=$height?>;margin-top: -6px">
	<?php foreach($proyectos as $p): ?>
		<div class="col-md-6 col-xs-12" style="display: inline-block;float: left;margin-bottom: 13px;text-align: center;">
			<button type="button" class="btn btn-warning" style="width: 70%;color: white;background: orange;padding: 0px;" onclick="set_proyecto(<?= $p['id']?>)">
				<span style="font-size: 14px;font-weight: bold;display: block;overflow: hidden;"><?= $p['name']?></span> 
				<span style="font-size: 11px;display: block;margin-top: -5px;overflow: hidden;"><i class="fa fa-map-marker" style="font-size: 9px;"></i>  <?= $p['ubicacion']?></span>
				<div style="width: 19%;
    position: absolute;
    top: -17px;
    right: 13px;
    transform: skew(0deg,15deg);
    -ms-transform: skew(0deg,15deg);
    -webkit-transform: skew(0deg,15deg);
    border-radius: 15px;
    background: white;
    border: yellow solid 2px;"><p style=" font-size: 9px;
    font-weight: bold;
    color: #ff0707;
    margin-bottom: 5px;
    margin-top: 3px;"><span>Desde</span><br> <?= $p['desde_precio']?></p></div>
			</button>
		</div>
	<?php endforeach ?>
</div>

<div class="col-md-12 col-xs-12" style="margin-bottom: 15px;margin-bottom: 15px;height: <?=(count($cualidades) * 18) + 26?>px;">
	<p style="text-align: center;font-size: 15px;color: white;font-weight: bold;margin-top: -18px;
">¿Que deseas saber?</p>
	<?php foreach($cualidades as $p): ?>
		<div class="col-md-6 col-xs-6" style="display: inline-block;float: left;margin-bottom: 8px;width: 50%">
			<button type="button" class="btn btn-warning" style="width: 100%;color: white;background: orange;padding: 3px;" onclick="set_pregunta(<?= $p['id']?>)">
				<span style="font-size: 12px;font-weight: bold;"><?= $p['cualidad']?></span> 
				
			</button>
		</div>
	<?php endforeach ?>
</div>

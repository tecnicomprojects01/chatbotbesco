<?php 
	foreach($mensajes as $m):

		if($m['sin_fondo'] == 0):

			if($m['from_id'] == 0):
?>
				<div class="d-flex justify-content-start mb-4">
					<div class="img_cont_msg">
						<img src="<?= base_url()?>public/frontend/img/<?= ASISTENTE_PIC?>" class="rounded-circle user_img_msg" style="background: white">
					</div>
					<div class="msg_cotainer">
						<?= $m['mensaje']?>
						<span class="msg_time"><?= applib::time_ago($m['date'])?></span>
					</div>
				</div>

			<?php else: ?>

				<div class="d-flex justify-content-end mb-4">
					<div class="msg_cotainer_send">
						<?= $m['mensaje']?>
						<span class="msg_time_send"><?= applib::time_ago($m['date'])?></span>
					</div>
					<div class="img_cont_msg">
					<img src="<?= base_url()?>public/frontend/img/<?= USER_PIC?>" class="rounded-circle user_img_msg">
					</div>
				</div>

			<?php endif ?>

		<?php else: ?>
			
			<?= $m['mensaje']?>

		<?php endif ?>

<?php endforeach ?>
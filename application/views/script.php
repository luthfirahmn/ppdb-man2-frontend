<?php
if (isset($js)) :
	foreach ($js as $v) : ?>
		<script src="<?php echo $v; ?>"></script>
<?php endforeach;
endif;
?>
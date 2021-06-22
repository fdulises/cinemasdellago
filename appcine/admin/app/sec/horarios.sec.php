<select data-stype="d" name="sc_d" class="form-in bx-left">
	<?php foreach( $opdias as $k => $v ): ?>
	<option value="<?php echo $k ?>"><?php echo $v ?></option>
	<?php endforeach; ?>
</select>
<select data-stype="h" name="sc_h" class="form-in">
	<?php for( $i = 0; $i<24; $i++ ): ?>
	<option value="<?php echo $i ?>"><?php echo (strlen($i)<2) ? '0'.$i : $i, ' hrs'?></option>
	<?php endfor; ?>
</select>
<select data-stype="m" name="sc_m" class="form-in">
	<?php for( $i = 0; $i<60; $i+=15 ): ?>
	<option value="<?php echo $i ?>"><?php echo (strlen($i)<2) ? '0'.$i : $i ?></option>
	<?php endfor; ?>
</select>
<input type="hidden" name="id" value="0" />
<input type="hidden" name="post_id" value="0" />
<input type="hidden" name="type" value="0" />
<button class="mw-close size-l sche-close" type="button"><span class="icon-cross"></span></button>

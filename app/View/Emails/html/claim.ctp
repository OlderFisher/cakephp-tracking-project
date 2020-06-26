<p>
	<?= __('form.label.date'); ?> <?php echo date('d/m/Y H:i'); ?>
</p>
<p>
	<?= __('form.label.sent_by'); ?> <?php echo $data['Claim']['last_name'] . ' ' . $data['Claim']['first_name']; ?>
</p>
<p>
	<?= __('form.label.email'); ?> <?php echo $data['Claim']['email']; ?>
</p>
<p>
	<?= __('form.label.subject'); ?> <?= __('form.placeholder.claim'); ?>
</p>
<p>
	<?= __('form.label.message'); ?> <br/>
	<?php echo $data['Claim']['message']; ?>
</p>

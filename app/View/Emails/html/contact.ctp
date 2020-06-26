<p>
	<?= __('email.contact.sent'); ?>
</p>
<p>
	<?= __('form.label.date'); ?>  <?php echo date('d/m/Y H:i'); ?>
</p>
<p>
	<?= __('form.label.sent_by'); ?> <?php echo $data['Contact']['last_name'] . ' ' . $data['Contact']['first_name']; ?>
</p>
<p>
	<?= __('form.label.email'); ?> <?php echo $data['Contact']['email']; ?>
</p>
<p>
	<?= __('form.label.subject'); ?> <?php echo $data['Contact']['subject']; ?>
</p>
<p>
	<?= __('form.label.message'); ?> <br/>
	<?php echo $data['Contact']['message']; ?>
</p>

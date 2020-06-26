<p>
	<?= __('email.hello', $name, $lastname); ?>
</p>
<p>
	<?= __('email.password.new_credentials'); ?><br/>
	<?= __('form.label.id'); ?> <?php echo $email; ?><br/>
	<?= __('form.label.password'); ?> <?php echo $password; ?>
</p>
<p>
	<?= __('email.footer.disposal'); ?>
</p>
<p>
	<?= __('email.footer.regards'); ?><br/>
    <?= __('email.footer.team', $nameSAV); ?><br/>
	<?= __('form.label.phone'); ?> <?php echo Configure::read('Config.phone') ?>
</p>

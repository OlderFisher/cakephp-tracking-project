<p>
	<?= __('email.hello', $firstName, $lastName); ?>
</p>
<p>
	<?= __('email.termination.information'); ?>
</p>
<p>
	<?= __('email.termination.confirm'); ?>
</p>
<p>
	<?= __('email.footer.disposal'); ?>
</p>
<p>
	<?= __('email.footer.regards'); ?><br/>
    <?= __('email.footer.team', $nameSAV); ?><br/>
	<?= __('form.label.phone'); ?> <?php echo Configure::read('Config.phone') ?>
</p>

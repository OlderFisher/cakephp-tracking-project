<p>
	<?= __('email.tracking_update.description', $tracking_number, $carrier); ?>
</p>
<p>
	<?= $update['date'] ?><br/>
	<?= $update['status_description'] ?><br/>
	<?= $update['details'] ?><br/>
</p>
<p>
	<?= __('email.footer.regards') ?><br/>
    <?= __('email.footer.team', Configure::read('Site.name')) ?><br/>
	<?= __('form.label.phone') ?> <?= Configure::read('Config.phone') ?>
</p>

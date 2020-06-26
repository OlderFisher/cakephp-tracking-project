<div style="margin-left: 8.33333333%; width: 83.33333333%; color: #5E5E6E; font-size: 1.3em;">
	<p>
		<b><?= __('email.application.thanks'); ?></b>
	</p>
	<p style="margin-top: 20px">
		<b><?= __('email.application.contact'); ?></b><br><a href="mailto:<?php echo Configure::read('Contact.email') ?>" ><?php echo Configure::read('Contact.email') ?></a><br>
		<?= __('email.application.contact_next'); ?><?php echo Configure::read('Config.phone') ?>
	</p>

	<?php if (isset($passwordClient)) { ?>
		<p style="margin-top: 20px">
			<?= __('email.application.login'); ?>
		</p>
		<p>
			<?= $urlLogin; ?><br/>
			<?= __('form.label.user'); ?> <?php echo $mailClient; ?><br/>
			<?= __('form.label.password'); ?> <?php echo $passwordClient; ?>
		</p>
	<?php } ?>
	<p style="margin-top: 20px">
		<?= __('email.footer.regards'); ?><br/>
		<?= __('email.footer.team', Configure::read('Contact.name_sav')); ?><br/>
		<?= __('form.label.phone'); ?> <?php echo Configure::read('Config.phone') ?>
	</p>
</div>

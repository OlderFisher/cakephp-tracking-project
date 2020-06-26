<p><?php echo $result['Customer']['last_name']; ?> <?php echo $result['Customer']['first_name']; ?>,</p>
<p><strong><?= __('email.confirm.transaction_descriptor'); ?> <?php echo Configure::read('Payment.description') ?></strong></p>
<p>
<?= __('email.confirm.order_summary'); ?><br/>
<?php if ($this->Session->read('Config.currency') != 'usd'): ?>
  <?= __('form.label.service'); ?> <?php echo $amountHT; ?> <?= configure::read('currencies')[$this->Session->read('Config.currency')]['symbol']; ?><br/>
  <?= __('form.label.vat'); ?> <?php echo $result['Payment']['subscription_amount'] - $amountHT; ?> <?= configure::read('currencies')[$this->Session->read('Config.currency')]['symbol']; ?><br/>
<?php endif; ?>
<?= __('form.label.total'); ?> <?php echo $result['Payment']['subscription_amount']; ?> <?= configure::read('currencies')[$this->Session->read('Config.currency')]['symbol']; ?><br/>
<?= __('form.label.order_number'); ?> <?php echo $result['Payment']['order_number']; ?>
</p>
<p><?= __('email.footer.contact', Configure::read('Contact.email'), Configure::read('Config.phone')); ?></p>
<p>
    <?= __('email.footer.regards'); ?><br/>
    <?= __('email.footer.team', Configure::read('Contact.name_sav')); ?><br/>
    <?= __('form.label.phone'); ?> <?php echo Configure::read('Config.phone') ?>
</p>

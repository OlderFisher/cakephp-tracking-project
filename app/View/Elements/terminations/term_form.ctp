
	<?php
		echo $this->Form->create(
			'Customer',
			array(
				'type' => 'POST',
				'inputDefaults' => array(
						'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
						'div' => array(
						  'class' => ''
				        ),
				        'class' => '',
				        'error' => array('attributes' => array('wrap' => 'span', 'style' => 'color:red;'))
				)
				)
		);
	?>
        <input type="text" name="email" id="email" class="form-control" placeholder="<?php echo __('form.placeholder.email_example') ; ?>">
        <button class="btn" type="submit"><?php echo __('form.termination.submit.send') ; ?></button>

        <div class="g-recaptcha d-flex justify-content-center mb-3" data-sitekey="<?= Configure::read('recaptcha.checkbox.site') ?>"></div>

	<?php
		echo $this->Form->end();
	?>
    </form>


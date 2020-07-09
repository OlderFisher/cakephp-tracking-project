
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
        <input type="text" name="email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required id="email" class="form-control" placeholder="<?php echo __('form.placeholder.email_example') ; ?>">
        <span style="display:none; color: #fff;" id="email-invalid" class="text-danger"><?=__('validation.email')?></span>
        <button class="btn" type="submit"><?php echo __('form.termination.submit.send') ; ?></button>
        <div class="g-recaptcha" data-size="invisible" data-sitekey="<?= Configure::read('recaptcha.checkbox.site') ?>"  data-callback="v2_invisible_callback"></div>
        <script type="text/javascript">
            function v2_invisible_onload() { console.log('v2 invisible loaded'); }
            function v2_invisible_callback(token) { console.log('v2 invisible token: ' + token); }
            function v2_invisible_get_token() { grecaptcha.execute(); }
        </script>

	<?php
		echo $this->Form->end();
	?>
    </form>


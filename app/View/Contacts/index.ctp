  <!-- PAGE HEADER -->
  <section id="page-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="my-4"><span class="secondary-color"><?= __('contact.title.contactus'); ?></span></h2>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTACT SECTION -->
  <section id="contact" class="py-5 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 pb-3">
          <div class="card p-3">
            <div class="card-body">
              <h4><?= __('contact.title.getintouch'); ?></h4>
              <p>
			    <?= __('contact.text.getintouch', Configure::read('Site.url2')); ?>
              </p>
              <h4><?= __('contact.title.email'); ?></h4>
              <p><a href="mailto:<?php echo Configure::read('Contact.email'); ?>"><?php echo Configure::read('Contact.email'); ?></a></p>
              <h4><?= __('contact.title.phone'); ?></h4>
              <p><a href="callto:<?php echo Configure::read('Config.phone'); ?>"><?php echo Configure::read('Config.phone'); ?></a></p>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <h3 class="text-center"><?= __('contact.title.contactform'); ?></h3>
              <hr>

			    <?php
				echo $this->Form->create(
				  'Contact',
				  array(
					'type' => 'POST',
					'inputDefaults' => array(
					  'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
					  'div' => array(
						'class' => 'form-group'
					  ),
					  'label' => false,
					  'class' => 'form-control',
					  'error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger'))
					)
				  )
				);
				?>

              <div class="row">
                <div class="col-md-6">

					<?php
					echo $this->Form->input(
					  'first_name',
					  array(
						'placeholder' => __('form.placeholder.firstname').' *',
						'value' => isset($this->request->data['Contact']['first_name']) ? $this->request->data['Contact']['first_name'] : null
					  )
					);
					?>

                </div>

                <div class="col-md-6">

					<?php
					echo $this->Form->input(
					  'last_name',
					  array(
						'placeholder' => __('form.placeholder.lastname').' *',
						'value' => isset($this->request->data['Contact']['last_name']) ? $this->request->data['Contact']['last_name'] : null
					  )
					);
					?>

                </div>

                <div class="col-md-12">

					<?php
					echo $this->Form->input(
					  'email',
					  array(
						'placeholder' => __('form.placeholder.email').' *',
						'value' => isset($this->request->data['Contact']['email']) ? $this->request->data['Contact']['email'] : null
					  )
					);
					?>

                </div>

                <div class="col-md-12">

					<?php
					echo $this->Form->input(
					  'subject',
					  array(
						'placeholder' => __('form.placeholder.subject').' *',
						'value' => isset($this->request->data['Contact']['subject']) ? $this->request->data['Contact']['subject'] : null,
					  )
					);
					?>

                </div>
              </div>
              <div class="row">
                <div class="col-md-12">

					<?php
					echo $this->Form->input(
					  'message',
					  array(
						'placeholder' => __('form.placeholder.message').' *',
						'type' => 'textarea',
						'rows' => 3,
						'value' => isset($this->request->data['Contact']['message']) ? $this->request->data['Contact']['message'] : null
					  )
					);
					?>

                </div>

              </div>

			  <div class="row">
                <div class="col-md-12">
					<?php
					echo $this->Form->input(
					  'policy',
					  array(
						'type' => 'checkbox',
						'class' => 'custom-control-input',
						'format' => array('before', 'input', 'between', 'label', 'error', 'after'),
						'label' => array(
						  'class' => 'custom-control-label',
						  'text' => __('form.label.policy')
						),
						'before' => '<div class="custom-control custom-checkbox">',
						'after' => '</div>'
					  )
					);
					?>
				</div>
              </div>

			  <div class="row">
                <div class="col-md-12">

					<?php echo $this->Form->submit(__('form.submit.send'), array('class' => 'btn btn-2 text-white text-center', 'div' => 'form-group text-center')); ?>

				</div>
              </div>

			  <div class="g-recaptcha" data-sitekey="<?= Configure::read('recaptcha.site') ?>" data-size="invisible" data-callback="formSubmitContact"></div>

			  <?php echo $this->Form->end(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

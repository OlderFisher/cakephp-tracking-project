          <p class="pt-2 pb-4 pl-2 text-center"> <?= __('termination.text.termination'); ?></p>
          <div class="col-lg-6 col-md-9 p-2 mx-auto">
            <div class="card rounded mb-4">
              <div class="card-body ">

				<?php
				 echo $this->Form->create(
					'Customer',
					array(
					  'type' => 'POST',
					  'inputDefaults' => array(
						'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
						'div' => array(
						  'class' => 'form-group'
						),
						'class' => 'needs-validation form-control',
						'error' => array('attributes' => array('wrap' => 'span', 'style' => 'color:red;'))
					  )
					)
				);
				?>

                  <div class="title-header pb-2">
                    <figure>
                      <h4 class="text-center text-weight"><?= __('termination.title.unsubscribe'); ?></h4>
                    </figure>
                  </div>

				  <?php
				  echo $this->Form->input(
					  'email',
					  array(
						'label' => __('form.label.email_used'),
						'placeholder' => __('form.placeholder.email_example'),
						'required' => true,
						'value' => isset($this->request->data['RetrievePassword']['email']) ? $this->request->data['RetrievePassword']['email'] : null,
					  )
				  );
				  ?>

                  <div class="g-recaptcha d-flex justify-content-center mb-3" data-sitekey="<?= Configure::read('recaptcha.checkbox.site') ?>"></div>

                  <div class="col-md-12">

					<?php
					echo $this->Form->submit(
					  __('form.submit.send'),
					  array(
						'class' => 'btn btn-2 text-white text-center',
						'div' => 'form-group text-center'
					  )
					);
					?>

                  </div>

				  <?php
				  echo $this->Form->end();
				  ?>
                </form>
              </div>
            </div>
          </div>

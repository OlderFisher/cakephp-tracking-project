  <!-- PAGE HEADER -->
  <section class="head" id="contact">
      <div class="container">
          <div class="row">
              <div class="col-lg-7 d-flex flex-column">
                  <div class="white-bg p-mid h-100 mb-4">
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

                          <div class="form-group">
                              <?php
                              echo $this->Form->input(
                                  'first_name',
                                  array(
                                      'type' => 'text',
                                      'name' => 'firstName',
                                      'id' => 'firstName',
                                      'class' => 'form-control',
                                      'placeholder' => __('form.placeholder.firstname'),
                                      'value' => isset($this->request->data['Contact']['first_name']) ? $this->request->data['Contact']['first_name'] : null
                                  )
                              );
                              ?>
                          </div>
                          <div class="form-group">
                              <?php
                              echo $this->Form->input(
                                  'first_name',
                                  array(
                                      'type' => 'text',
                                      'name' => 'lasttName',
                                      'id' => 'lasttName',
                                      'class' => 'form-control',
                                      'placeholder' => __('form.placeholder.lastname'),
                                      'value' => isset($this->request->data['Contact']['last_name']) ? $this->request->data['Contact']['last_name'] : null
                                  )
                              );
                              ?>
                          </div>
                          <div class="form-group">
                              <?php
                              echo $this->Form->input(
                                  'email',
                                  array(
                                      'type' => 'text',
                                      'name' => 'email',
                                      'id' => 'email',
                                      'class' => 'form-control',
                                      'placeholder' => __('form.placeholder.email'),
                                      'pattern' => "^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$",
                                      'value' => isset($this->request->data['Contact']['email']) ? $this->request->data['Contact']['email'] : null
                                  )
                              );
                              ?>
                              <span style="display:none" id="email-invalid" class="text-danger"><?=__('validation.email')?></span>
                          </div>
                          <div  class="form-group">
                              <?php
            					echo $this->Form->input(
            					  'subject',
            					  array(
            						'placeholder' => __('form.placeholder.subject').'',
            						'value' => isset($this->request->data['Contact']['subject']) ? $this->request->data['Contact']['subject'] : null,
            					  )
            					);
            					?>
                          </div>
                          <div class="form-group">
                              <?php
                              echo $this->Form->input(
                                  'message',
                                  array(
                                      'placeholder' => __('form.placeholder.message'),
                                      'type' => 'textarea',
                                      'name' => 'message',
                                      'id' => 'message',
                                      'class' => 'form-control',
                                      'rows' => 5,
                                      'value' => isset($this->request->data['Contact']['message']) ? $this->request->data['Contact']['message'] : null
                                  )
                              );
                              ?>
                          </div>


                          <div class="form-group">
                              <input type="checkbox" name="agreement" id="agreement" >
                              <label for="agreement"><?= __('form.label.policy') ; ?></label>
                          </div>

                          <?php echo $this->Form->submit(__('form.submit.send'), array('class' => 'btn', 'div' => 'form-group text-center')); ?>

                          <div class="g-recaptcha" data-sitekey="<?= Configure::read('recaptcha.site') ?>" data-size="invisible" data-callback="formSubmitContact"></div>

                          <?php echo $this->Form->end(); ?>
                  </div>
              </div>
              <div class="col-lg-5 d-flex flex-column">
                  <div class="white-bg p-mid mb-4еу">
                      <h4><?= __('contact.title.getintouch'); ?></h4>
                      <p><?= __('contact.text01.getintouch'); ?></p>
                      <p><?= __('contact.text02.getintouch'); ?></p>
                      <p><?= __('contact.text03.getintouch'); ?></p>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <section id="join-us">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="color-bg">
                      <div class="row">
                          <div class="col-lg-8 offset-lg-2 text-center">
                              <h3><?= __('contact.title.banner'); ?></h3>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>





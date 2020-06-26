<div class="section-header bg-avantages inv">
  <div class="container">

    <div class="row">
      <div class="col-xl-7 col-lg-8">
        <h1 class="h2 text-red"><?= __('header.title.claim'); ?></h1>
        <p></p>
      </div>
    </div>

  </div>
</div>

<div class="container">
  <?php echo $this->Session->flash(); ?>
</div>

<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="h4 text-red mb-3 font-weight-normal"><?= __('form.title.claim'); ?></h2>
        <?php
        echo $this->Form->create(
          'Claim',
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
          <div class="col-lg-6">
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
          <div class="col-lg-6">
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
        </div>

        <?php
        echo $this->Form->input(
          'email',
          array(
            'placeholder' => __('form.placeholder.email').' *',
            'value' => isset($this->request->data['Contact']['email']) ? $this->request->data['Contact']['email'] : null
          )
        );

        echo $this->Form->input(
          'message',
          array(
            'placeholder' => __('form.placeholder.message').' *',
            'type' => 'textarea',
            'rows' => 3,
            'value' => isset($this->request->data['Contact']['message']) ? $this->request->data['Contact']['message'] : null
          )
        );

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
        <?php echo $this->Form->submit(__('form.submit.send'), array('class' => 'btn btn-danger btn-lg', 'div' => 'form-group submit')); ?>
        <div class="g-recaptcha" data-sitekey="<?= Configure::read('recaptcha.site') ?>" data-size="invisible" data-callback="formSubmitClaim"></div>
        <?php echo $this->Form->end(); ?>
      </div>

      <div class="col-md-6">
        <div class="box-custom h-auto mt-3 mt-md-0">
          <div data-aos="fade-left">
            <p><?= __('section.claim.informations.text.p1', Configure::read('Site.url2')); ?></p>
            <p><?= __('section.claim.informations.text.p2', Configure::read('Site.url2')); ?></p>
            <p class="mb-0"><?= __('section.claim.informations.text.p3', Configure::read('Site.url2')); ?> <a href="mailto:<?= Configure::read('Contact.email'); ?>"><?= Configure::read('Contact.email'); ?></a>.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

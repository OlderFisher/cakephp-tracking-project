<div class="section-header bg-avantages inv">
  <div class="container">

    <h2 class="h2 text-red"><span class="secondary-color"><?= __('header.title.retrieve_password.request'); ?></span></h2>
    <p><?= __('header.description.retrieve_password.request'); ?></p>

  </div>
</div>

<div class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">

        <div class="box-custom">
          <?php
          echo $this->Form->create(
            'RetrievePassword',
            array(
              'type' => 'POST',
              'data-aos' => 'fade-down',
              'inputDefaults' => array(
                'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                'div' => array(
                  'class' => 'form-group'
                ),
                'class' => 'form-control',
                'label' => false,
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger'))
              )
            )
          );

          echo $this->Form->input(
            'email',
            array(
              'label' => __('form.label.email_used'),
              'placeholder' => __('form.placeholder.email_example'),
              'value' => isset($this->request->data['RetrievePassword']['email']) ? $this->request->data['RetrievePassword']['email'] : null,
            )
          );

          echo $this->Form->submit(
            __('form.submit.send'),
            array(
              'class' => 'btn btn-warning',
              'div' => 'form-group text-center'
            )
          );

          echo $this->Form->end();
          ?>

        </div>

      </div>
    </div>
  </div>
</div>

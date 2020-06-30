<!-- PAGE HEADER -->
<section id="page-header">
  <div class="container" style="overflow-x: hidden">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="my-4"><span class="secondary-color"><?= __('login.title.login'); ?></span></h2>
        <p><?= __('login.text.login'); ?></p>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT SECTION -->
<section id="login" class="py-2 pb-5">
  <div class="container p-4 rounded-lg">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6 bg-light">
        <div class="login-container p-4">

            <?php
            echo $this->Form->create(
              'Customer',
              array(
                'type' => 'POST',
                'url' => array('controller' => 'users', 'action' => 'login', 'language' => $this->Session->read('Config.language')),
                'inputDefaults' => array(
                  'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                  'div' => array(
                    'class' => 'form-group login-form'
                  ),
                  'class' => 'needs-validation form-control',
                  'error' => array('attributes' => array('wrap' => 'span', 'style' => 'color:red;'))
                )
              )
            );
            ?>
            <div class="row">
              <div class="col-md-12">

                <?php
                echo $this->Form->input(
                  'email',
                  array(
                    'label' => '<h6>' . __('form.label.email') . '</h6>',
                    'placeholder' => __('form.placeholder.email_example'),
                    'required' => true,
                  )
                );
                ?>

              </div>
              <div class="col-md-12 pb-2">

                <?php
                echo $this->Form->input(
                  'password',
                  array(
                    'label' => '<h6>' . __('form.label.password') . '</h6>',
                    'placeholder' => "********",
                    'required' => true,
                  )
                );
                ?>

                <?php /*
                <small class="text-left"><a href="<?= $this->Html->url(array('controller' => 'retrievePasswords', 'action' => 'index', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('login.link.forgotpassword'); ?></a></small>
                */ ?>
                <!-- <br> -->
                <small class="text-left"><?= __('login.text.notregistered'); ?> <a href="<?= $this->Html->url(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language'))); ?>" class="text-warning"><?= __('login.link.track'); ?></a></span></small>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">

                <?php
                echo $this->Form->submit(
                  __('form.submit.login'),
                  array(
                    'class' => 'btn btn-2 text-white text-center',
                    'div' => 'form-group text-center pt-2'
                  )
                );
                ?>

              </div>
            </div>

            <?php echo $this->Form->end(); ?>

          </div>
      </div>

      <div class="col-lg-6 d-none d-lg-block pl-5 secondary-background">
      <img src="/img/trackerly_<?= Configure::read('Config.language') ?>.png"` class="img-fluid pl-4" width="300px" alt="trackerly home page screen">
      </div>

    </div>
  </div>
</section>

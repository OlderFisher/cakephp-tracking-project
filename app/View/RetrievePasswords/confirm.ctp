<div class="section-header bg-avantages inv">
  <div class="container">

    <h2 class="h2 text-red"><span class="secondary-color"><?= __('header.title.retrieve_password.confirm'); ?></span></h2>

  </div>
</div>

<div class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">

        <div class="shadow-lg p-4 border-rounded bg-light text-center">
          <div data-aos="fade-down">
            <h3><?= __('section.retrieve_password.sent.title'); ?></h3>
            <p><?= __('section.retrieve_password.sent.text'); ?></p>
            <a class="btn btn-success" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'login', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('nav.login'); ?></a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

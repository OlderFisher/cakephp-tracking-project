<!-- PAGE HEADER -->
<section id="page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="h2 text-red my-4"><span class="secondary-color"><?= __('header.title.paiement_confirmation'); ?></span></h2>
      </div>
    </div>
  </div>
</section>

<section id="subscription">
  <div class="section py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9 col-md-10">

          <div class="bg-light shadow-lg p-4 rounded text-center">

            <h2 class="h3"><?= __('section.paiement_confirmation.thanks.title'); ?></h2>
            <p><?= __('section.paiement_confirmation.thanks.text'); ?></p>
            <a class="btn btn-1" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'login', 'language' => $this->Session->read('Config.language'), $idLogin, $tokenLogin)); ?>"><?= __('nav.login'); ?></a>

          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="section py-3">
    <div class="container">
      <div class="card card-primary">
        <div class="card-body bg-light">
          <div class="text-center">
            <h3 class="h4"><?= __('section.paiement_confirmation.contact.mail'); ?> <a href="mailto:<?php echo Configure::read('Contact.email'); ?>"><?php echo Configure::read('Contact.email'); ?></a></h3>
            <p class="h5"><?= __('section.paiement_confirmation.contact.transaction_descriptor'); ?> <b><?php echo Configure::read('Payment.description'); ?></b></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

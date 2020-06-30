<!-- PAGE HEADER -->
<section id="page-header" class="payment">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="my-4"><span><?= __('payment.title.signup'); ?></span></h2>
      </div>
    </div>
  </div>
</section>

<section id="payment" class="content pb-5 pt-2">
  <div class="section-sm">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-8 col-xl-6 pt-2">
          <div class="card payment-card rounded mb-4">
            <div class="payment-header">
              <h5 class="text-center"><?= __('payment.title.total'); ?> <?= configure::read('currencies')[$this->Session->read('Config.currency')]['price']['trial']; ?></h5>
            </div>
            <div class="card-body payment-form">

              <?php
              echo $this->Form->create(
                'Paiement',
                array(
                  'type' => 'POST',
                  'inputDefaults' => array(
                    'format' => array('before', 'label', 'input', 'between', 'error', 'after'),
                    'class' => 'form-control needs-validation',
                    'div' => array(
                      'class' => 'form-group'
                    ),
                    'label' => false,
                    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger'))
                  )
                )
              );
              ?>

                <figure class="mt-4">
                  <h6><i class="fas fa-lock primary-color"></i> <?= __('payment.title.securepay'); ?>
                    <img class="img-fluid float-right" src="/img/payment_cards.png" alt="visa and mastercard">
                  </h6>
                </figure>

              <?php
              if (isset($formAlreadySubmit) && !empty($formAlreadySubmit)) {
                echo $this->Form->input('Form.submit', array(
                  'type' => 'hidden',
                  'value' => 1,
                ));
              }

              echo $this->Form->input(
                'Card.name',
                array(
                  'placeholder' => __('form.placeholder.cardholder'),
                  'value' => isset($this->request->data['Card']['name']) ? $this->request->data['Card']['name'] : null,
                )
              );
              ?>

              <div class="row">
                <div class="col-md-12 col-lg-12">

                  <?php
                  echo $this->Form->input(
                    'Card.number',
                    array(
                      'placeholder' => '1234 1234 1234 1234',
                      'value' => isset($this->request->data['Card']['number']) ? $this->request->data['Card']['number'] : null,
                    )
                  );
                  ?>

                </div>
                <div class="col-md-6 col-lg-6">

                  <?php
                  echo $this->Form->input(
                    'Card.date_expire',
                    array(
                      'placeholder' => __('form.placeholder.expriation_date'),
                      'value' => isset($this->request->data['Card']['date_expire']) ? $this->request->data['Card']['date_expire'] : null,
                    )
                  );
                  ?>

                </div>

              <div class="col-md-6 col-lg-6">

                <?php
                echo $this->Form->input(
                  'Card.cvv',
                  array(
                    'placeholder' => __('form.placeholder.cvv'),
                    'value' => isset($this->request->data['Card']['cvv']) ? $this->request->data['Card']['cvv'] : null,
                    'maxlength' => 3,
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'right',
                    'title' => __('form.tooltip.cvv')
                  )
                );
                ?>

              </div>
              </div>

              <div class="text-center mt-4">
                <button class="btn btn-payment btn-success" id="submitBtn" type="submit"> <?= __('payment.button.pay'); ?></button>

                <p class="pt-3"><i class="fas fa-lock primary-color"></i> <?= __('section.paiement.purchase.secure_paiement'); ?></p>
              </div>

              <?php echo $this->Form->end(); ?>

            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-6 pt-2">
          <div class="card rounded shadow-sm mb-2 reduced-m">
              <div class="card-body p-2">
                <div class="row">
                  <div class="col-md-12 col-lg-12">
                    <div class="text-center">
                      <img id="carrier-logo" src="<?=
                        $trackparcel['TrackParcel']['carrier_code'] ?
                            str_replace('{code}', $trackparcel['TrackParcel']['carrier_code'], Configure::read('aftership.logo_url'))
                            : '/img/fedex_logo.png'
                        ?>" width="100px" class="img-fluid" alt="logo">
                      <p id="carrier-name" class="mb-0"><?=
                        $trackparcel['TrackParcel']['carrier_name'] ?
                            $trackparcel['TrackParcel']['carrier_name']
                            : 'FedEx'
                      ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <div class="card rounded shadow-sm reduced-m">
            <div class="card-body p-2">
              <div class="title-header pt-2">
                <figure>
                  <h5 class="text-center"> <?= __('payment.title.ordersum'); ?></h5>
                </figure>
              </div>
              <ul class="list-payment list-unstyled">
                <li class="py-2">
                    <div class="row">
                        <div class="col-2">
                          <img src="/img/globe.svg" class="custom-img">
                        </div>
                        <div class="col-10 pl-0 align-items-center d-flex">
                            <p class="pl-0 mb-0 shrink">
                              <?= __('payment.text.premiumsubone'); ?>
                            </p>
                        </div>
                    </div>
                </li>
                <li class="py-2">
                    <div class="row">
                        <div class="col-2">
                          <img src="/img/ear.svg" class="custom-img">
                        </div>
                        <div class="col-10 pl-0 align-items-center d-flex">
                            <p class="pl-0 mb-0 shrink">
                              <?= __('payment.text.customerservice'); ?>
                            </p>
                        </div>
                    </div>
                </li>
                <li class="py-2">
                    <div class="row">
                        <div class="col-2">
                          <img src="/img/search-checkmark.png" class="custom-img">
                        </div>
                        <div class="col-10 pl-0 align-items-center d-flex">
                            <p class="pl-0 mb-0 shrink">
                            <?= __('payment.text.offerperiod', Configure::read('currencies')[$this->Session->read('Config.currency')]['price']['trial'], Configure::read('currencies')[$this->Session->read('Config.currency')]['price']['month']); ?>
                              </p>
                        </div>
                    </div>
                </li>
                <li class="py-2">
                        <div class="row">
                            <div class="col-2">
                              <img src="/img/exit.svg" class="custom-img">
                            </div>
                            <div class="col-10 pl-0 align-items-center d-flex">
                                <p class="pl-0 mb-0 shrink">
                                  <?= __('payment.text.unsubscribeservice'); ?>
                                </p>
                            </div>
                        </div>
                    </li>
              </ul>
              <hr>
              <p class="mb-2 px-1 shrink"><span> <?= __('payment.text.descriptor'); ?> <strong><?php echo Configure::read('Site.name'); ?></strong> </span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

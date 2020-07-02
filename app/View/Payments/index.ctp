<!-- PAGE HEADER -->
<section class="head" id="order">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1><?= __('payment.title.ordersum'); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-7 mb-4">
                <div class="white-bg">
                    <div class="bg-head">
                        <?= __('payment.title.total'); ?> <?= configure::read('currencies')[$this->Session->read('Config.currency')]['price']['trial']; ?>
                        </b>
                    </div>
                    <div class="p-sm">
                        <?php
                         echo $this->Form->create(
                            'Paiement',
                            array(
                                'type' => 'POST',
                                'inputDefaults' => array(
                                'format' => array('before', 'label', 'input', 'between', 'error', 'after'),
                                'class' => 'needs-validation',
                                'div' => array(
                                'class' => ''
                                ),
                                'label' => false,
                                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger'))
                             )
                            )
                         );
                        ?>
                        <div class="form-group">
                            <img src="/img/lock.svg" class="mr-2 mt-3" alt="">
                            <span> <?= __('payment.title.securepay'); ?></span>
                            <img src="/img/cards.svg" class="p-absolute m-r" alt="">
                        </div>

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
                                'div' => 'form-group',
                                'class' => 'form-control',
                                'value' => isset($this->request->data['Card']['name']) ? $this->request->data['Card']['name'] : null,
                            )
                        );
                        ?>

                        <?php
                        echo $this->Form->input(
                            'Card.number',
                            array(
                                'div' => 'form-group',
                                'class' => 'form-control',
                                'placeholder' => '1234 1234 1234 1234',
                                'value' => isset($this->request->data['Card']['number']) ? $this->request->data['Card']['number'] : null,
                            )
                        );
                        ?>
                        <div class="form-group d-flex flex-row justify-content-between cvv-grid">
                            <?php
                            echo $this->Form->input(
                                'Card.date_expire',
                                array(
                                    'class' => 'form-control',
                                    'placeholder' => __('form.placeholder.expriation_date'),
                                    'value' => isset($this->request->data['Card']['date_expire']) ? $this->request->data['Card']['date_expire'] : null,
                                )
                            );
                            ?>
                            <?php
                            echo $this->Form->input(
                                'Card.cvv',
                                array(
                                    'placeholder' => __('form.placeholder.cvv'),
                                    'value' => isset($this->request->data['Card']['cvv']) ? $this->request->data['Card']['cvv'] : null,
                                    'maxlength' => 3,
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'right',
                                    'class' => 'form-control',
                                    'title' => __('form.tooltip.cvv')
                                )
                            );
                            ?>

                            <img src="/img/info.svg" class="p-absolute b-r" alt="">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agreement" id="agreement">
                                <label for="agreement">I declare that I have read and accepted the <a href="terms-and-conditions.html">T&amp;C</a></label>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn" type="submit" id="submitBtn">
                                    <img src="/img/lock-white.svg" class="mt-3 mr-2" alt="">
                                    <?= __('payment.button.pay'); ?>
                                </button>
                            </div>



                        <?php echo $this->Form->end(); ?>

                    </div>
                </div>
            </div>


            <div class="col-xl-5 mb-4">

                <div class="white-bg">
                    <!-- Place Parcel operator logo and Name-->
                        <div class="p-sm pb-1">
                            <div class="card-body p-2">
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
                    <!-- Parcel operator block end       -->
                        <hr>

                    <div class="p-sm pb-1">
                        <h4 class="fw-600"><?= __('payment.title.signup'); ?></h4>
                        <ul class="mt-4">
                            <li>
                                <?= __('payment.text.premiumsubone'); ?>
                            </li>
                            <li>
                                <?= __('payment.text.customerservice'); ?>
                            </li>
                            <li>
                                <?= __('payment.text.offerperiod', Configure::read('currencies')[$this->Session->read('Config.currency')]['price']['trial'], Configure::read('currencies')[$this->Session->read('Config.currency')]['price']['month']); ?>
                            </li>
                            <li>
                                <?= __('payment.text.unsubscribeservice'); ?>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div class="p-sm pt-3">
                        <p> <?= __('payment.text.descriptor'); ?> <strong><?php echo Configure::read('Site.name'); ?></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


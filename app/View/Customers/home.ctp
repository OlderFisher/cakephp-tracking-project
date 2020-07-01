

<section class="head" id="home">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-xl-6 col-lg-7 col-md-12 d-flex flex-column justify-content-center h-100">
                <h1><?= __('home.title.parceltrack') ?></h1>
                <p class="strong color"><?= __('home.title.easytrack') ?></p>
                <?php
                echo $this->Form->create(
                    'TrackParcel',
                    array(
                        'type' => 'POST',
                        'class' => 'track-form',
                        'inputDefaults' => array(
                            'format' => array('before', 'label', 'input', 'between', 'error', 'after'),
                            'class' => '',
                            'div' => false,
                            'label' => false,
                            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger'))
                        )
                    )
                );

                ?>

                <div class="form-group">

                <?php
                echo $this->Form->input(
                    'num_parcel',
                    array(
                        'type' => 'text',
                        'class' => 'form-control',
                        'id' => 'search',
                        'oninput' => "myDisplay()",
                        'placeholder' => __('form.placeholder.trackpackage'),
                        'required' => true,
                        'autofocus' => false,
                        'pattern' => "^[A-Za-z0-9]{1,30}$",
                        'value' => NULL
                    )
                );
                ?></div>
                    <div class="form-group" id="secondInput">
                        <?php
                        echo $this->Form->input(
                            'Customer.email',
                            array(
                                'type' => 'text',
                                'class' => 'form-control',
                                'placeholder' => __('form.placeholder.email'),
                                'required' => true,
                                'pattern' => "^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                            )
                        );
                        ?>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>

                        <?php
                        echo $this->Form->input(
                            'Customer.cgv',
                            array(
                                'format' => array('before','input','between', 'label', 'error', 'after'),
                                'class' => 'custom-control-input',
                                'label' => array(
                                    'text' => __('form.label.tos', '<a href="'.$this->Html->url(array('controller' => 'pages', 'action' => 'cgv', 'language' => $this->Session->read('Config.language'))).'" target="_blank">'.__('link.tos').'</a>'),
                                    'class' => 'custom-control-label',
                                    'style' => 'font-size:11px;'
                                ),
                                'div' => array(
                                    'class' => 'custom-control custom-checkbox home-customer-cgv'
                                )
                            )
                        );
                        ?>
                    


                <button id="submitBtn" type="submit" class="btn"><img src="/img/tools-and-utensils.svg" alt=""></button>
                </div>


                <?=
                $this->Form->input(
                    'carrier',
                    array(
                        'type' => 'hidden',
                        'value' => NULL
                    )
                )
                ?>

                <?php echo $this->Form->end(); ?>

            </div>
            <div class="col-xl-6 col-lg-5 col-md-8 offset-md-2 offset-lg-0 home-img d-flex flex-column justify-content-center h-100">
                <img src="/img/home.svg" alt="">
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="white-bg p-big text-center d-flex flex-column">
                    <img src="/img/pin.svg" alt="">
                    <h4><?= __('home.title.track') ?></h4>
                    <p><?= __('home.text.track') ?></p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="white-bg p-big text-center d-flex flex-column">
                    <img src="/img/shipping-and-delivery.svg" alt="">
                    <h4><?= __('home.title.packages') ?></h4>
                    <p><?= __('home.text.packages') ?></p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="white-bg p-big text-center d-flex flex-column">
                    <img src="/img/world-wide.svg" alt="">
                    <h4><?= __('home.title.globally') ?></h4>
                    <p><?= __('home.text.globally') ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3><?= __('about.title.howtousegeoservice'); ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-4">
                <p><?= __('about.text01.howtousegeoservice'); ?></p>
                <p><?= __('about.text02.howtousegeoservice'); ?></p>
                <p><?= __('about.text03.howtousegeoservice'); ?></p>
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <img src="/img/how-to.svg" alt="">
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h4><?= __('home.title.steps') ;?></h4>
            </div>
            <div class="col-lg-12">
                <div class="row steps-container">
                    <div class="step-item col-lg-3 mb-4">
                        <div class="number">01</div>
                        <p><?= __('home.text01.steps') ;?></p>
                    </div>
                    <div class="step-item col-lg-3 mb-4">
                        <div class="number">02</div>
                        <p><?= __('home.text02.steps') ;?></p>
                    </div>
                    <div class="step-item col-lg-3 mb-4">
                        <div class="number">03</div>
                        <p><?= __('home.text03.steps') ;?></p>
                    </div>
                    <div class="step-item col-lg-3">
                        <div class="number">04</div>
                        <p><?= __('home.text04.steps') ;?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pattern-left">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3><?= __('home.title.subscription') ;?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-5 offset-xl-1 col-lg-6 offset-lg-0">
                <div class="white-bg p-mid">
                    <ul>
                        <li><?= __('home.subscription.text01') ;?> </li>
                        <li><?= __('home.subscription.text02') ;?> </li>
                        <li><?= __('home.subscription.text03') ;?> </li>
                        <li><?= __('home.subscription.text04') ;?> </li>
                        <li><?= __('home.subscription.text05') ;?> </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6">
                <p class="mt-5"><?= __('home.subscription.text06') ;?></p>
                <a href="#" class="btn"><?= __('home.subscription.locate') ;?></a>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3><?= __('about.title.intrlpackagetracking'); ?></h3>
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <p><?= __('about.text.intrlpackagetracking'); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%201.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%202.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%203.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%204.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%205.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%206.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%207.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%208.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%209.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%2010.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%2011.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%2012.png" alt="">
            </div>
        </div>
    </div>
</section>

<section>
<div class="container">
    <div class="row">
        <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 text-center">
            <h3><?= __('about.title.trackshipments'); ?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <p><?= __('about.text01.trackshipments'); ?></p>
            <p><?= __('about.text02.trackshipments'); ?></p>
        </div>
        <div class="col-lg-6">
            <img src="/img/OBJECTS.svg" alt="">
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade d-flex " id="loadMe" tabindex="-1" role="dialog" aria-labelledby="modalLoading" aria-hidden="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content p-big text-center">
        <h4 class="mb-4"><?= __('home.title.searching') ?></h4>
        <img class="loading-animation mb-4" src="img/loading.svg" alt="">
        <p><?= __('home.text.redirect') ?></p>
        <small><?= __('home.text.search') ?>...</small>
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


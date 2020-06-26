<section id="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 text-center">
                <h2 class="my-4"><span class="secondary-color"><?= __('header.title.tracking'); ?></span></h2>
            </div>
        </div>
        <div class="row">
        <div class="col-12 col-md-10 col-lg-8 m-auto text-left">
          <?php
          echo $this->Form->create(
            'TrackParcel',
            array(
              'type' => 'POST',
              'class' => 'p-4',
              'inputDefaults' => array(
                'format' => array('before', 'label', 'input', 'between', 'error', 'after'),
                'class' => 'form-control',
                'div' => false,
                'label' => false,
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger'))
              )
            )
          );
          ?>
          <h5><?= __('home.title.trackpackage') ?></h5>
          <div class="form-group">
            <div class="input-group mycustom">
              <?php
              echo $this->Form->input(
                'num_parcel',
                array(
                  'type' => 'text',
                  'class' => 'form-control',
                  'placeholder' => __('form.placeholder.trackpackage'),
                  'required' => true,
                  'autofocus' => true,
                  'pattern' => "^[A-Za-z0-9]{1,30}$",
                  'value' => NULL
                )
              );
              ?>
                <div class="row justify-content-center">
                    <div class="input-group-prepend">
                        <button id="submitBtn" type="submit" class="btn btn-2 text-white btn-sm rounded-0" id="inputGroupPrepend2"><?= __('home.button.findpackage') ?></button>
                    </div>
                </div>
            </div>
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
        </div>

    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row py-4 justify-content-center">
                <div class="dropdown filter-tabs pb-2 show">
                    <a class="btn btn-filter dropdown-toggle text-dark" type="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= __('tracking.filter') ?>
                    </a>
                    <div id="nav-tab" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li class="nav-custom active"><a href="#" identifier="all" class="dropdown-item identifier"><?= __('tracking.filter.all') ?></a></li>
                        <!-- <li class="nav-custom"><a href="#" identifier="pending" class="dropdown-item identifier"><?= __('tracking.filter.pending') ?></a></li>
                        <li class="nav-custom"><a href="#" identifier="notfound" class="dropdown-item identifier" href="#"><?= __('tracking.filter.notfound') ?></a></li> -->
                        <li class="nav-custom"><a href="#" identifier="transit" class="dropdown-item identifier" href="#"><?= __('tracking.filter.transit') ?></a></li>
                        <!-- <li class="nav-custom"><a href="#" identifier="pickup" class="dropdown-item identifier" href="#"><?= __('tracking.filter.pickup') ?></a></li> -->
                        <li class="nav-custom"><a href="#" identifier="delivered" class="dropdown-item identifier" href="#"><?= __('tracking.filter.delivered') ?></a></li>
                        <!-- <li class="nav-custom"><a href="#" identifier="undelivered" class="dropdown-item identifier" href="#"><?= __('tracking.filter.undelivered') ?></a></li>
                        <li class="nav-custom"><a href="#" identifier="exception" class="dropdown-item identifier" href="#"><?= __('tracking.filter.exception') ?></a></li>
                        <li class="nav-custom"><a href="#" identifier="expired" class="dropdown-item identifier" href="#"><?= __('tracking.filter.expired') ?></a></li> -->
                    </div>
                </div>
                <ul id="nav-tab" class="nav nav-tabs pb-4">
                    <li class="nav-custom active"><a href="#" identifier="all" class=" identifier all"><?= __('tracking.filter.all') ?></a></li>
                    <!-- <li class="nav-custom"><a href="#" identifier="pending" class=" identifier pending"><?= __('tracking.filter.pending') ?></a></li>
                    <li class="nav-custom"><a href="#" identifier="notfound" class=" identifier notfound"><?= __('tracking.filter.notfound') ?></a></li> -->
                    <li class="nav-custom"><a href="#" identifier="transit" class=" identifier transit"><?= __('tracking.filter.transit') ?></a></li>
                    <!-- <li class="nav-custom"><a href="#" identifier="#pickup" class="identifier pickup"><?= __('tracking.filter.pickup') ?></a></li> -->
                    <li class="nav-custom"><a href="#" identifier="delivered" class=" identifier delivered"><?= __('tracking.filter.delivered') ?></a></li>
                    <!-- <li class="nav-custom"><a href="#" identifier="undelivered" class=" identifier undelivered"><?= __('tracking.filter.undelivered') ?></a></li>
                    <li class="nav-custom"><a href="#" identifier="exception" class=" identifier exception"><?= __('tracking.filter.exception') ?></a></li>
                    <li class="nav-custom"><a href="#" identifier="expired" class=" identifier expired"><?= __('tracking.filter.expired') ?></a></li> -->
                </ul>
            <br>

            <div class="col-md-10">
            <!-- <div class="tab-content">
                <div class="tab-pane active" id="all"> -->
                    <div class="panel-group" id="accordion" aria-multiselectable="true">
                        <?php $nums = [] ?>
                        <?php foreach($trackings as $tracking): ?>
                            <?php if ( $this->Session->check($tracking['TrackParcel']['num_parcel'])
                                    && (
                                        ( $tracking['TrackParcel']['api'] == 'trackingmore' && $this->Session->read($tracking['TrackParcel']['num_parcel'])['tracking']['data']['items'][0]['status'] == 'delivered' )
                                        || ( $tracking['TrackParcel']['api'] == 'aftership' && strtolower($this->Session->read($tracking['TrackParcel']['num_parcel'])['tracking']['data']['tracking']['tag']) == 'delivered' )
                                    )
                                ): ?>
                                <?= $this->element('tracking_'.$tracking['TrackParcel']['api'], $this->Session->read($tracking['TrackParcel']['num_parcel'])) ?>
                            <?php else: ?>
                                <?php $nums[] = $tracking['TrackParcel']['num_parcel'] ?>
                                <div class="panel panel-default panel-loading pb-2">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">
                                            <div class="row justify-content-center">
                                                <div class="loader"></div>
                                            </div>
                                        </h6>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <div class="panel panel-default panel-loading panel-loading-system pb-2" style="display: none;">
                            <div class="panel-heading">
                                <h6 class="panel-title">
                                    <div class="row justify-content-center">
                                        <div class="loader"></div>
                                    </div>
                                </h6>
                            </div>
                        </div>
                    </div>
                <!-- </div>
            </div> -->
        </div>
    </div>
</section>

<?php if ($nums): ?>
    <?php $this->Html->scriptStart(array('inline' => false, 'block' => 'scriptBottom')); ?>
        var nums = ["<?= implode($nums, '","') ?>"];
        nums.forEach(function (num) {
            $.ajax({
                url: getParcelUrl + num,
                success: function(response, status, xhr) {
                    if (isJson(response)) {
                        alert(JSON.parse(response).message);
                    }
                    else {
                        $('.panel-group').find('.panel-loading').first().remove();
                        $('.panel-group').prepend(response);
                    }
                }
            });
        })
    <?php $this->Html->scriptEnd(); ?>
<?php endif; ?>


<section class="head" id="home">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-xl-6 col-lg-7 col-md-12 d-flex flex-column justify-content-center h-100">
                <h1><?= __('home.title.parceltrack') ?></h1>
                <p class="strong color"><?= __('home.title.easytrack') ?></p>
               <?php $formparams = [
                  'type'=>'POST',
                  'class'=>'track-form',
                  'inputDefaults'=>[
                    'format'=>['before','label','input','between','error','after'],
                    'class'=>'form-control',
                    'div'=>false,
                    'label'=>false,
                    'error'=>[
                      'attributes'=>[
                        'wrap'=>'span',
                        'class'=>'text-danger'
                        ]
                      ]
                    ]
                  ];
                echo $this->Form->create('TrackParcel',$formparams); ?>
                <div class="form-group">
                  <?php echo $this->Form->input('num_parcel',[
                    'type'=>'text',
                    'class'=>'form-control',
                    'placeholder'=>__('form.placeholder.trackpackage'),
                    'required'=>true,'autofocus'=>true,
                    'pattern'=>"^[A-Za-z0-9]{1,30}$",
                    'value'=>NULL
                  ]); ?>
                <button class="btn"id="submitBtn"type="submit"><img alt=""src="/img/tools-and-utensils.svg"></button></div>
                <span style="display:none" id="track-invalid" class="text-danger"><?=__('validation.track')?></span>
                <?=$this->Form->input('carrier',['type'=>'hidden','value'=>NULL])?><?php echo $this->Form->end(); ?>
            </div>
            <div class="col-xl-6 col-lg-5 col-md-8 offset-md-2 offset-lg-0 home-img d-flex flex-column justify-content-center h-100">
                <img src="/img/home.svg" alt="">
            </div>
        </div>
    </div>
</section>  
  

<section class=" ">
    <div class="container">
        <div class="row justify-content-center filter-container">
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
            </div>
            <div class="row py-4 justify-content-center filter-container">
                <ul id="nav-tab" class="filternav nav nav-tabs pb-4">
                    <li class="nav-custom active"><a   identifier="all" class=" identifier all"><?= __('tracking.filter.all') ?></a></li>
                    <!-- <li class="nav-custom"><a href="#" identifier="pending" class=" identifier pending"><?= __('tracking.filter.pending') ?></a></li>
                    <li class="nav-custom"><a href="#" identifier="notfound" class=" identifier notfound"><?= __('tracking.filter.notfound') ?></a></li> -->
                    <li class="nav-custom"><a   identifier="transit" class=" identifier transit"><?= __('tracking.filter.transit') ?></a></li>
                    <!-- <li class="nav-custom"><a href="#" identifier="#pickup" class="identifier pickup"><?= __('tracking.filter.pickup') ?></a></li> -->
                    <li class="nav-custom"><a   identifier="delivered" class=" identifier delivered"><?= __('tracking.filter.delivered') ?></a></li>
                    <!-- <li class="nav-custom"><a href="#" identifier="undelivered" class=" identifier undelivered"><?= __('tracking.filter.undelivered') ?></a></li>
                    <li class="nav-custom"><a href="#" identifier="exception" class=" identifier exception"><?= __('tracking.filter.exception') ?></a></li>
                    <li class="nav-custom"><a href="#" identifier="expired" class=" identifier expired"><?= __('tracking.filter.expired') ?></a></li> -->
                </ul>
            <br>
            
            </div>
            <div class="row py-4 justify-content-center filter-container">

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

 
<?php switch ($tracking['data']['items'][0]['status']):
    case 'notfound_': ?>
        <p>Not found</p>
    <?php break;default: ?>
        <div class="panel panel-default <?= $tracking['data']['items'][0]['status'] ?> pb-2">
            <div class="panel-heading" id="heading<?= $trackparcel['TrackParcel']['id'] ?>">
                <h6 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $trackparcel['TrackParcel']['id'] ?>" aria-expanded="true" aria-controls="collapse<?= $trackparcel['TrackParcel']['id'] ?>">
                        <span class="badge <?= $tracking['data']['items'][0]['status'] ?>"><?= __('tracking.status.'.$tracking['data']['items'][0]['status']) ?></span> <?= $tracking['data']['items'][0]['tracking_number'] ?>
                    </a>
                </h6>
            </div>

            <div id="collapse<?= $trackparcel['TrackParcel']['id'] ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?= $trackparcel['TrackParcel']['id'] ?>">
                <div class="panel-body pl-2">
                    <div class="timeline">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pl-2 pt-2">
                                    <ul class="list-inline mx-auto my-0">
                                        <li class="list-inline-item p-2"><p><strong><?= __('tracking.label.carrier') ?></strong> <?= $trackparcel['TrackParcel']['carrier_name'] ?></p></li>
                                        <li class="list-inline-item p-2"><p><strong><?= __('tracking.label.origin') ?></strong> <?= isset($tracking['data']['items'][0]['original_country']) ? $tracking['data']['items'][0]['original_country'] : 'n/a' ?></p></li>
                                        <li class="list-inline-item p-2"><p><strong><?= __('tracking.label.destination') ?></strong> <?= isset($tracking['data']['items'][0]['destination_country']) ? $tracking['data']['items'][0]['destination_country'] : 'n/a' ?></p></li>
                                    </ul>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <?php if (isset($tracking['data']['items'][0]['origin_info']['trackinfo'])) : ?>
                            <?php foreach( $tracking['data']['items'][0]['origin_info']['trackinfo'] as $trackinfo ): ?>
                                <div class="row">
                                    <div class="col-auto text-center flex-column d-none d-sm-flex">
                                        <div class="row h-20">
                                            <div class="col ">&nbsp;</div>
                                            <div class="col">&nbsp;</div>
                                        </div>
                                        <h6 class="m-2">
                                            <span class="badge badge-pill bg-light border">&nbsp;</span>
                                        </h6>
                                        <div class="row h-20">
                                            <div class="col border-right">&nbsp;</div>
                                            <div class="col">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="col py-2">
                                        <div class="pt-3">
                                            <div class="float-right text-muted">
                                                <p><?= $trackinfo['Date'] ?></p>
                                            </div>
                                            <h6 class="card-title"><?= $trackinfo['StatusDescription'] ?></h6>
                                            <p class="card-text"><?= $trackinfo['Details'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php elseif (isset($tracking['data']['items'][0]['destination_info']['trackinfo'])) : ?>
                            <?php foreach( $tracking['data']['items'][0]['destination_info']['trackinfo'] as $trackinfo ): ?>
                                <div class="row">
                                    <div class="col-auto text-center flex-column d-none d-sm-flex">
                                        <div class="row h-20">
                                            <div class="col ">&nbsp;</div>
                                            <div class="col">&nbsp;</div>
                                        </div>
                                        <h6 class="m-2">
                                            <span class="badge badge-pill bg-light border">&nbsp;</span>
                                        </h6>
                                        <div class="row h-20">
                                            <div class="col border-right">&nbsp;</div>
                                            <div class="col">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="col py-2">
                                        <div class="pt-3">
                                            <div class="float-right text-muted">
                                                <p><?= $trackinfo['Date'] ?></p>
                                            </div>
                                            <h6 class="card-title"><?= $trackinfo['StatusDescription'] ?></h6>
                                            <p class="card-text"><?= $trackinfo['Details'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
<?php endswitch; ?>

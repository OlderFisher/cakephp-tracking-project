<?php
    switch (strtolower($tracking['data']['tracking']['tag'])) {
        case 'intransit':
            $status = 'transit';
            break;

        case 'inforeceived':
            $status = 'transit';
            break;

        case 'outfordelivery':
            $status = 'transit';
            break;

        case 'failedattempt':
            $status = 'undelivered';
            break;

        case 'availableforpickup':
            $status = 'pickup';
            break;

        default:
            $status = strtolower($tracking['data']['tracking']['tag']);
            break;
    }
?>

<?php switch ($tracking['data']['tracking']['tag']):
    case 'notfound_': ?>
        <p>Not found</p>
    <?php break;default: ?>
        <div class="panel panel-default <?= $status ?> pb-2">
            <div class="panel-heading" id="heading<?= $trackparcel['TrackParcel']['id'] ?>">
                <h6 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $trackparcel['TrackParcel']['id'] ?>" aria-expanded="true" aria-controls="collapse<?= $trackparcel['TrackParcel']['id'] ?>">
                        <span class="badge <?= $status ?>"><?= __('tracking.status.'.$status) ?></span> <?= $trackparcel['TrackParcel']['num_parcel'] ?>
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
                                        <li class="list-inline-item p-2"><p><strong><?= __('tracking.label.origin') ?></strong> <?= isset($tracking['data']['tracking']['origin_country_iso3']) ? $tracking['data']['tracking']['origin_country_iso3'] : 'n/a' ?></p></li>
                                        <li class="list-inline-item p-2"><p><strong><?= __('tracking.label.destination') ?></strong> <?= isset($tracking['data']['tracking']['destination_country_iso3']) ? $tracking['data']['tracking']['destination_country_iso3'] : 'n/a' ?></p></li>
                                    </ul>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <?php if (isset($tracking['data']['tracking']['checkpoints'])) : ?>
                            <?php foreach( array_reverse($tracking['data']['tracking']['checkpoints'], true) as $trackinfo ): ?>
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
                                                <p><?= date('Y-m-d h:i T', strtotime($trackinfo['checkpoint_time'])) ?></p>
                                            </div>
                                            <h6 class="card-title"><?= $trackinfo['subtag_message'] ?>, <?= $trackinfo['location'] ?></h6>
                                            <p class="card-text"><?= $trackinfo['message'] ?></p>
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

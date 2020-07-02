<section id="page-header" class="user-details-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="my-4"><span class="secondary-color"><?= __('header.title.request_form'); ?></span></h2>
            </div>
        </div>
    </div>
</section>

<section id="customer-service" class="user-details-block  py-5">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-lg-10 mx-auto">
                <?php if (isset($allTickets) && !empty($allTickets)): ?>
                    <h4 class="mb-4 text-left"><?= __('section.list_request.title'); ?></h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered bg-white mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"><?= __('table.label.category_subject'); ?></th>
                                    <th scope="col"><?= __('table.label.date'); ?></th>
                                    <th scope="col"><?= __('table.label.status'); ?></th>
                                    <th scope="col"><?= __('table.label.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($allTickets as $key => $value): ?>
                                    <tr>
                                        <td>
                                        <?php
                                            switch ($value['ReqCategorie']['id']) {
                                                case 10:
                                                    echo __('request.category.info');
                                                    break;

                                                case 11:
                                                    echo __('request.category.termination');
                                                    break;
                                            }
                                            echo " / ".$value['ReqTicket']['subject'];
                                        ?>
                                        </td>
                                        <td>
                                            <?= date("d/m/Y", strtotime($value['ReqTicket']['created'])); ?>
                                        </td>
                                        <td>
                                            <?php
                                                switch ($value['ReqStatus']['id']) {
                                                    case 1:
                                                        echo __('request.status.open');
                                                        break;

                                                    case 2:
                                                        echo __('request.status.wait_customer');
                                                        break;

                                                    case 3:
                                                        echo __('request.status.wait_sav');
                                                        break;

                                                    case 4:
                                                        echo __('request.status.close');
                                                        break;
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo $this->Html->url(array('controller' => 'requests', 'action' => 'detailRequest', 'language' => $this->Session->read('Config.language'), $value['ReqTicket']['id'])); ?>" class="btn btn-sm btn-warning text-white btn-no-rounded"><?= __('table.see_detail'); ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

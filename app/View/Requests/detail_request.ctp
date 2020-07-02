<section id="page-header" class="user-details-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="my-4"><span class="secondary-color"><?= __('header.title.request_detail', $ticket['ReqTicket']['id']) ?></span></h2>
            </div>
        </div>
    </div>
</section>

<section id="customer-service" class="user-details-block  py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div>
                    <h3 class="d-inline-block"><?= $ticket['ReqTicket']['subject']; ?></h3>
                    <?php
                        switch ($ticket['ReqTicket']['status_id']) {
                            case 1:
                                echo '<span class="badge badge-success align-top">';
                                echo __('request.status.open');
                                echo '</span>';
                                break;

                            case 2:
                                echo '<span class="badge badge-warning align-top">';
                                echo __('request.status.wait_customer');
                                echo '</span>';
                                break;

                            case 3:
                                echo '<span class="badge badge-warning align-top">';
                                echo __('request.status.wait_sav');
                                echo '</span>';
                                break;

                            case 4:
                                echo '<span class="badge badge-danger align-top">';
                                echo __('request.status.close');
                                echo '</span>';
                                break;
                        }
                    ?>
                    <span class="badge badge-secondary align-top">
                      <?php echo date("d/m/Y", strtotime($ticket['ReqTicket']['created'])); ?>
                    </span>
                </div>

                <p class="text-secondary"><?= nl2br($ticket['ReqTicket']['content']); ?></p>

                <div class="float-right">
                    <a class="btn btn-secondary btn-sm" href="<?php echo $this->Html->url(array('controller' => 'requests', 'action' => 'listRequest', 'language' => $this->Session->read('Config.language'))); ?>">
                        <?= __('section.request_detail.back_ticket'); ?>
                    </a>
                </div>

                <?php if ($ticket['ReqTicket']['status_id'] != 4): ?>
                    <div class="mb-2">
                        <a class="btn btn-danger btn-sm" onclick="return confirm('<?= __('section.request_detail.ask_close_ticket'); ?>');" href="<?php echo $this->Html->url(array('controller' => 'requests', 'action' => 'closeTicket', 'language' => $this->Session->read('Config.language'), $ticket['ReqTicket']['id'])); ?>">
                            <?= __('section.request_detail.close_ticket'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-10 mx-auto my-5">
                <h3><?= __('section.comments.title'); ?></h3>

                <div class="card rounded mb-4">
                    <div class="card-body">
                        <?=
                            $this->Form->create(
                                'ReqMessage',
                                array(
                                    'type' => 'POST',
                                    'inputDefaults' => array(
                                        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                                        'div' => array(
                                            'class' => 'mb-2'
                                        ),
                                        'class' => 'form-control',
                                        'label' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger'))
                                    )
                                )
                            )
                        ?>

                            <?=
                                $this->Form->input(
                                    'content',
                                    array(
                                        'label' => array(
                                            'text' => __('form.label.message'),
                                            'class' => 'mb-0',
                                        ),
                                        'rows' => 3,
                                    )
                                )
                            ?>
                            <div class="text-center">
                                <button type="submit" class="btn btn-2 text-white text-center"><?= __('form.submit.reply'); ?></button>
                            </div>

                        <?= $this->Form->end(); ?>

                        <hr class="mt-4">

                        <?php if (isset($allMessages) && !empty($allMessages)): ?>
                            <?php foreach ($allMessages as $key => $value): ?>
                                <div class="media mb-3">
                                    <p class="h2">
                                        <?php if ($value['ReqMessage']['send'] == "customer"): ?>
                                            <i class="fa fa-user-circle text-secondary mr-2"></i>
                                        <?php else: ?>
                                            <i class="fa fa-user-circle text-primary mr-2"></i>
                                        <?php endif; ?>
                                    </p>
                                    <div class="media-body">
                                        <div class="">
                                            <span class="h5 font-weight-normal">
                                                <?php
                                                    if ($value['ReqMessage']['send'] == "customer") {
                                                        echo $value['Customer']['first_name'];
                                                    } else {
                                                        echo $value['User']['first_name'];
                                                    }
                                                ?>
                                            </span>
                                            <small class="text-secondary ml-2"><i class="fa fa-calendar"></i> <?php echo date("d/m/Y H:i:s", strtotime($value['ReqMessage']['created'])); ?></small>
                                        </div>
                                        <p class="card-text"><?= nl2br($value['ReqMessage']['content']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="h4"><?= __('section.comments.wait_answer'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

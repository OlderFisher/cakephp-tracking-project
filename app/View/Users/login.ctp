<!-- PAGE HEADER -->


<section class="head" id="login">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3 class="mb-2"><?= __('login.title.login'); ?></h3>
                <p><?= __('login.text.login'); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                <div class="white-bg mt-5">
                    <div class="p-sm">
                        <?php
                        echo $this->Form->create(
                            'Customer',
                            array(
                                'type' => 'POST',
                                'url' => array('controller' => 'users', 'action' => 'login', 'language' => $this->Session->read('Config.language')),
                                'inputDefaults' => array(
                                    'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                                    'div' => array(
                                        'class' => 'form-group login-form'
                                    ),
                                    'class' => 'needs-validation form-control',
                                    'error' => array('attributes' => array('wrap' => 'span', 'style' => 'color:red;'))
                                )
                            )
                        );
                        ?>

                            <?php
                            echo $this->Form->input(
                                'email',
                                array(
                                    'label' => '',
                                    'placeholder' => __('form.placeholder.username_example'),
                                    'required' => true,
                                    'div' => 'form-group',
                                )
                            );
                            ?>


                            <?php
                            echo $this->Form->input(
                                'password',
                                array(
                                    'label' => '',
                                    'placeholder' => __('form.label.password'),
                                    'required' => true,
                                    'div' => 'form-group',
                                )
                            );
                            ?>

                        <small class="text-left"><?= __('login.text.notregistered'); ?> <a href="<?= $this->Html->url(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language'))); ?>" class="text-warning"><?= __('login.link.track'); ?></a></span></small>

                            <?php
                            echo $this->Form->submit(
                                __('form.submit.login'),
                                array(
                                    'class' => 'btn',
                                    'div' => 'form-group text-center '
                                )
                            );
                            ?>

                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>







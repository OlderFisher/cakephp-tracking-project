<!-- PAGE HEADER -->
<section id="page-header" class="user-details-header">
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1 class="my-4"><span class="secondary-color"><?= __('header.title.profile'); ?></span></h1>
    </div>
  </div>
</div>
</section>

<!-- Customer Service SECTION -->
<section id="customer-service" class=" user-details-block py-5">
    <div class="container" style="overflow-x: hidden">
      <div class="row">
          <div class="col-lg-8 p-2 mx-auto">
            <div class="card rounded mb-4">
              <div class="card-body ">

                    <?=
                        $this->Form->create(
                          'Customer',
                          array(
                            'type' => 'POST',
                            'class' => 'contact-form',
                            'inputDefaults' => array(
                              'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                              'div' => array(
                                'class' => 'form-group'
                              ),
                              'class' => 'form-control',
                              'error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger'))
                            )
                          )
                        )
                    ?>

                        <div class="row">
                          <div class="col-md-6">
                            <?=
                                $this->Form->input(
                                  'first_name',
                                  array(
                                    'label' => __('form.label.firstname'),
                                    'value' => isset($customer['Customer']['first_name']) ? $customer['Customer']['first_name'] : null
                                  )
                                )
                            ?>
                          </div>
                          <div class="col-md-6">
                            <?=
                                $this->Form->input(
                                  'last_name',
                                  array(
                                    'label' => __('form.label.lastname'),
                                    'value' => isset($customer['Customer']['last_name']) ? $customer['Customer']['last_name'] : null
                                  )
                                )
                            ?>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <?=
                                $this->Form->input(
                                  'password',
                                  array(
                                    'label' => __('form.label.password').' <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="'.__('form.label.password.requirements').'"></i>',
                                  )
                                )
                            ?>
                          </div>
                          <div class="col-md-6">
                            <?=
                                $this->Form->input(
                                  'phone',
                                  array(
                                    'label' => __('form.label.phone'),
                                    'value' => isset($customer['Customer']['phone']) ? $customer['Customer']['phone'] : null
                                  )
                                )
                            ?>
                          </div>
                        </div>

                        <?=
                            $this->Form->input(
                              'Address.street',
                              array(
                                'label' => __('form.label.address'),
                                'value' => isset($customer['Address']['street']) ? $customer['Address']['street'] : null
                              )
                            )
                        ?>

                        <div class="row">
                          <div class="col-md-6">
                            <?=
                                $this->Form->input(
                                  'Address.post_code',
                                  array(
                                    'label' => __('form.label.npa'),
                                    'value' => isset($customer['Address']['post_code']) ? $customer['Address']['post_code'] : null
                                  )
                                )
                            ?>
                          </div>
                          <div class="col-md-6">
                            <?=
                                $this->Form->input(
                                  'Address.city',
                                  array(
                                    'label' => __('form.label.city'),
                                    'value' => isset($customer['Address']['city']) ? $customer['Address']['city'] : null
                                  )
                                )
                            ?>
                          </div>
                        </div>

                        <?=
                            $this->Form->submit(
                              __('form.submit.save'),
                              array(
                                'class' => 'btn btn-2 text-white text-center',
                                'div' => 'form-group text-center'
                              )
                            )
                        ?>
                    <?php echo $this->Form->end(); ?>
              </div>
           </div>
         </div>
      </div>
    </div>
</section>

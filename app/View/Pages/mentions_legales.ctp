  <section class="head" id="order">
      <div class="container">
          <div class="row">
              <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                  <div class="text-center">
                      <h1 class="fw-600"><?= __('header.title.legal_notice'); ?></h1>
                  </div>

  
            <h3 class="sm"> <?= __('section.legal_notice.site_edition.title'); ?></h3>
            <p><?= __('section.legal_notice.site_edition.company', Configure::read('Company.name_ltd' ), Configure::read('Company.inc_number'), Configure::read('Company.address')); ?> </p>
            <p><?= __('section.legal_notice.site_edition.vat'); ?> <?php echo Configure::read('Company.vat_number');?></p>
          	<h3 class="sm">
			      	<?= __('section.legal_notice.host.title'); ?>
		      	</h3>
          	<p><?= __('section.legal_notice.host.company', Configure::read('Site.url2')); ?>
    			  <br>
    			  <?= __('section.legal_notice.address'); ?> 
            </p>
            <p><?= __('form.label.phone'); ?> <?php echo Configure::read('Config.phone');?></p>

          	<h3 class="sm">
            	<?= __('section.legal_notice.contact.title'); ?>
			      </h3>
          	<p><?= __('form.label.email'); ?> <?php echo Configure::read('Contact.email_site');?></p>

              </div>
          </div>
      </div>
  </section>



 
	
	 
 

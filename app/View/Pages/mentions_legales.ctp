<section class="head">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3><?= __('header.title.legal_notice'); ?></h3>
        </div>
    </div>
    <div class="container" style="overflow-x: hidden">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12 pt-4 pb-4" dataa-aos="fade-right">
            <h4> <?= __('section.legal_notice.site_edition.title'); ?></h4>
            <p><?= __('section.legal_notice.site_edition.company', Configure::read('Company.name_ltd'), Configure::read('Company.inc_number'), Configure::read('Company.address')); ?> </p>
            <p><?= __('section.legal_notice.site_edition.vat'); ?> <?php echo Configure::read('Company.vat_number');?></p>
          	<h4>
			      	<?= __('section.legal_notice.host.title'); ?>
		      	</h4>
          	<p><?= __('section.legal_notice.host.company', Configure::read('Site.url2')); ?>
    			  <br>
    			  <?= __('section.legal_notice.address'); ?> 
            </p>
            <p><?= __('form.label.phone'); ?> <?php echo Configure::read('Config.phone');?></p>

          	<h4>
            	<?= __('section.legal_notice.contact.title'); ?>
			      </h4>
          	<p><?= __('form.label.email'); ?> <?php echo Configure::read('Contact.email_site');?></p>	
		  </div>
		</div>
	  </div>
    </div>
  </section>

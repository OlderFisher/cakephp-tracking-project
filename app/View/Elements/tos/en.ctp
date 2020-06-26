</header>
  <!-- PAGE HEADER -->
  <section id="page-header">
    <div class="container" style="overflow-x: hidden">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="my-4"><span class="secondary-color"><?= __d('tos', 'title'); ?></span></h2>
          <p class="small font-italic text-center"><?= __d('tos', 'effective') ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- Terms SECTION -->
  <section id="terms" class="py-4">
    <div class="container" style="overflow-x: hidden">
      <div class="row">
        <div class="col-md-12">

        	<p><?= __d('tos', 'description.1', Configure::read('Site.name2')); ?></p>
            <p class="text-uppercase"><?= __d('tos', 'description.2', Configure::read('Site.name2'), Configure::read('Company.name_ltd'), Configure::read('Company.inc_number'), Configure::read('Company.address')); ?></p>
            <p><?= __d('tos', 'description.3', Configure::read('Site.name2')); ?></p>

			<h4><?= __d('tos', '1.definition.title'); ?></h4>

			<p>
			  <?= __d('tos', '1.definition.us', Configure::read('Site.name2'), Configure::read('Company.name_ltd')); ?>
			</p>

			<p>
			 <?= __d('tos', '1.definition.site', Configure::read('Site.name2'), $this->Html->link(Router::url('/', true))); ?>
			</p>

			<p>
			  <?= __d('tos', '1.definition.services', Configure::read('Site.name2')); ?>
			</p>

			<p>
			  <?= __d('tos', '1.definition.platform'); ?>
			</p>

			<p>
			  <?= __d('tos', '1.definition.you'); ?>
			</p>

			<p>
			  <?= __d('tos', '1.definition.party', Configure::read('Site.name2')); ?>
			</p>

            <p><?= __d('tos', '1.definition.third_party', Configure::read('Site.name2')); ?></p>
            <p><?= __d('tos', '1.definition.content'); ?></p>
            <p><?= __d('tos', '1.definition.supbscription_period'); ?></p>
            <p><?= __d('tos', '1.definition.subscription_fee'); ?></p>
            <p><?= __d('tos', '1.definition.effective_date'); ?></p>
            <p><?= __d('tos', '1.definition.confidential_information'); ?></p>

			<h4><?= __d('tos', '2.general_provisions.title', Configure::read('Site.name2')); ?></h4>

			<h5><?= __d('tos', '2.general_provisions.subtitle.a'); ?></h5>

			<p>
			  <?= __d('tos', '2.general_provisions.1'); ?>
			</p>

			<p>
			  <?= __d('tos', '2.general_provisions.2'); ?>
			</p>

			<h5><?= __d('tos', '2.general_provisions.subtitle.b'); ?></h5>

			<p>
			  <?= __d('tos', '2.general_provisions.3', Configure::read('Site.name2')); ?>
			</p>

			<p>
			  <?= __d('tos', '2.general_provisions.4', Configure::read('Site.name2')); ?>
			</p>
            <p><?= __d('tos', '2.general_provisions.5', Configure::read('Site.name2')); ?></p>

			<h5><?= __d('tos', '2.general_provisions.subtitle.c'); ?></h5>

			<p>
			  <?= __d('tos', '2.general_provisions.6'); ?>
			</p>
            <p><?= __d('tos', '2.general_provisions.7'); ?></p>

			<h5><?= __d('tos', '2.general_provisions.subtitle.d'); ?></h5>

			<p>
			  <?= __d('tos', '2.general_provisions.8'); ?>
			</p>
            <p><?= __d('tos', '2.general_provisions.9'); ?></p>

			<h5><?= __d('tos', '2.general_provisions.subtitle.e'); ?></h5>

			<p>
			  <?= __d('tos', '2.general_provisions.10'); ?>
			</p>
            <ol class="ml-3 list-unstyled">
                <li><p><?= __d('tos', '2.general_provisions.10.1'); ?></p></li>
                <li><p><?= __d('tos', '2.general_provisions.10.2'); ?></p></li>
                <li><p><?= __d('tos', '2.general_provisions.10.3'); ?></p></li>
                <li><p><?= __d('tos', '2.general_provisions.10.4'); ?></p></li>
                <li><p><?= __d('tos', '2.general_provisions.10.5'); ?></p></li>
                <li><p><?= __d('tos', '2.general_provisions.10.6'); ?></p></li>
                <li><p><?= __d('tos', '2.general_provisions.10.7'); ?></p></li>
                <li><p><?= __d('tos', '2.general_provisions.10.8'); ?></p></li>
            </ol>

			<h5><?= __d('tos', '2.general_provisions.subtitle.f'); ?></h5>

			<p>
			  <?= __d('tos', '2.general_provisions.11', Configure::read('Site.name2')); ?>
			</p>
            <p><?= __d('tos', '2.general_provisions.12', '<a href="mailto:'.Configure::read('Contact.email_site').'">'.Configure::read('Contact.email_site').'</a>'); ?></p>


			<h4><?= __d('tos', '3.intellectual_property.title'); ?></h4>

            <h5><?= __d('tos', '3.intellectual_property.subtitle.a'); ?></h5>
			<p>
			  <?= __d('tos', '3.intellectual_property.1', Configure::read('Site.name2')); ?>
			</p>

			<p>
			  <?= __d('tos', '3.intellectual_property.2', Configure::read('Site.name2')); ?>
			</p>

			<h5>
			  <?= __d('tos', '3.intellectual_property.subtitle.b'); ?>
      		</h5>

			<p>
			  <?= __d('tos', '3.intellectual_property.3', Configure::read('Site.name2')); ?>
			</p>

            <h5><?= __d('tos', '3.intellectual_property.subtitle.c'); ?></h5>
            <p><?= __d('tos', '3.intellectual_property.4'); ?></p>
            <ol class="ml-3 list-unstyled">
                <li><p><?= __d('tos', '3.intellectual_property.4.1'); ?></p></li>
                <li><p><?= __d('tos', '3.intellectual_property.4.2'); ?></p></li>
                <li><p><?= __d('tos', '3.intellectual_property.4.3'); ?></p></li>
                <li><p><?= __d('tos', '3.intellectual_property.4.4'); ?></p></li>
                <li><p><?= __d('tos', '3.intellectual_property.4.5'); ?></p></li>
                <li><p><?= __d('tos', '3.intellectual_property.4.6'); ?></p></li>
            </ol>
            <p><?= __d('tos', '3.intellectual_property.5', '<a href="mailto:'.Configure::read('Contact.email_site').'">'.Configure::read('Contact.email_site').'</a>'); ?></p>

			<div class="q-title"><?= __d('tos', '4.payment_and_pricing.title'); ?></div>

			<p>
			  <?= __d('tos', '4.payment_and_pricing.1'); ?>
			</p>

			<p>
			  <?= __d('tos', '4.payment_and_pricing.2'); ?>
			</p>

			<p>
			  <?= __d('tos', '4.payment_and_pricing.3'); ?>
			</p>

			<p>
			  <?= __d('tos', '4.payment_and_pricing.4'); ?>
			</p>

			<p>
			  <?= __d('tos', '4.payment_and_pricing.5'); ?>
			</p>


			<h4><?= __d('tos', '5.third_party.title'); ?></h4>

			<p>
			  <?= __d('tos', '5.third_party.1', Configure::read('Site.name2')); ?>
			</p>

			<p>
			  <?= __d('tos', '5.third_party.2'); ?>
			</p>

			<h4><?= __d('tos', '6.cancellation.title'); ?></h4>

			<p>
			  <?= __d('tos', '6.cancellation.1'); ?>
			</p>

			<p>
			  <?= __d('tos', '6.cancellation.2'); ?>
			</p>

			<p>
			  <?= __d('tos', '6.cancellation.3', '<a href="mailto:'.Configure::read('Contact.email_site').'">'.Configure::read('Contact.email_site').'</a>'); ?>
			</p>


			<h4><?= __d('tos', '7.refund.title'); ?></h4>

			<p>
			  <?= __d('tos', '7.refund.1', '<a href="mailto:'.Configure::read('Contact.email_site').'">'.Configure::read('Contact.email_site').'</a>'); ?>
			</p>
            <p><?= __d('tos', '7.refund.2'); ?></p>
            <p><?= __d('tos', '7.refund.3', Configure::read('Site.name2')); ?></p>


			<h4><?= __d('tos', '8.indemnity.title'); ?></h4>

			<p>
			  <?= __d('tos', '8.indemnity.1', Configure::read('Site.name2')); ?>
            </span>


			<h4><?= __d('tos', '9.limitation_of_liability.title'); ?></h4>

			<p class="text-uppercase">
			  <?= __d('tos', '9.limitation_of_liability.1', Configure::read('Site.name2')); ?>
			</p>
            <p class="text-uppercase"><?= __d('tos', '9.limitation_of_liability.2', Configure::read('Site.name2')); ?></span>
            <p><?= __d('tos', '9.limitation_of_liability.3', Configure::read('Site.name2')); ?></span>


			<h4><?= __d('tos', '10.changes.title'); ?></h4>

			<p class="text-uppercase">
			  <?= __d('tos', '10.changes.1', Configure::read('Site.name2')); ?>
			</p>


			<h4><?= __d('tos', '11.laws.title'); ?></h4>

			<p>
			  <?= __d('tos', '11.laws.1', Configure::read('Site.name2')); ?>
			</p>

			<h4><?= __d('tos', '12.final_provisions.title'); ?></h4>

			<p>
			  <?= __d('tos', '12.final_provisions.1'); ?>
			</p>

			<p>
			  <?= __d('tos', '12.final_provisions.2'); ?>
			</p>

			<p>
			  <?= __d('tos', '12.final_provisions.3'); ?>
			</p>
            <p><?= __d('tos', '12.final_provisions.4'); ?></p>


			<h4><?= __d('tos', '13.legally_mandatory_information.title'); ?></h4>
			<p>
				<?= __d('tos', '13.legally_mandatory_information.1'); ?>
			</p>
            <p><?= __d('tos', '13.legally_mandatory_information.2'); ?></p>
            <p><?= __d('tos', '13.legally_mandatory_information.3', '<a href="mailto:'.Configure::read('Contact.email_site').'">'.Configure::read('Contact.email_site').'</a>'); ?></p>
    	</div>
       </div>
    </div>
  </section>

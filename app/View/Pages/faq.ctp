    <!-- PAGE HEADER -->
    <section id="page-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="my-4"><span class="secondary-color"><?= __('faq.title.faq'); ?></span></h2>
            <p>
			  <?= __('faq.text.theteams', Configure::read('Site.url2')); ?>
            </p>
          </div>
        </div>
      </div>
    </section>

  <!-- SERVICES SECTION -->
  <section id="services" class="py-2">
    <div class="container" style="overflow-x: hidden">
      <div class="row">
        <div class="col-md-12 pt-4" data-aos="fade-right">
          <h4><?= __('faq.title.whereis'); ?></h4>
          <p>
		    <?= __('faq.text.whereis'); ?>
          </p>
          <p><?= __('faq.text.day1'); ?></p>
          <p><?= __('faq.text.day2'); ?></p>
          <p><?= __('faq.text.day2_4'); ?></p>
          <p>
		    <?= __('faq.text.oncepackage'); ?>
		  </p>
          <p><?= __('faq.text.day4_10'); ?></p>
          <p><?= __('faq.text.day10_15'); ?></p>
          <p><?= __('faq.text.day15_30'); ?></p>
          <p><?= __('faq.text.day60'); ?></p>
          <p>
		    <?= __('faq.text.oncepackagearrived'); ?>
		  </p>
          
        </div>
        <div class="col-md-12 pt-4" data-aos="fade-right">
          <h4><?= __('faq.title.whatislocation'); ?></h4>
          <p>
		    <?= __('faq.text.internationalpackages'); ?>
		  </p>
          <p>
		    <?= __('faq.text.packagescanned'); ?>
		  </p>
          <p>
		    <?= __('faq.text.later'); ?>
		  </p>
          
        </div>
        <div class="col-md-12 pt-4" data-aos="fade-right">
          <h4><?= __('faq.title.statusnotfound'); ?></h4>
          <p>
			<?= __('faq.text.statusnotfound'); ?>
		  </p>
          <p>
		    <?= __('faq.text.wait1_2days'); ?>
		  </p>
        </div>
      </div>
        <div class="row">
          <div class="col-md-12 pt-4" data-aos="fade-right">
            <div data-aos="fade-right">
            <h4><?= __('faq.title.notreceive'); ?></h4>
            <p>
			  <?= __('faq.text.refund'); ?>
			</p>
            <p>
			  <?= __('faq.text.trackingwebsite', Configure::read('Site.url2')); ?>
			</p>
            </div>
              <br>
            <div data-aos="fade-right">
              <h4><?= __('faq.title.changeaddress'); ?></h4>
              <p>
			    <?= __('faq.text.changeaddress'); ?>
			  </p>
              <br>
            </div>
            <div data-aos="fade-right">
              <h4><?= __('faq.title.packagestuck'); ?></h4>
              <p>
			    <?= __('faq.text.packagestuck_p1'); ?>
			  </p>
              <p>
			    <?= __('faq.text.packagestuck_p2'); ?>
			  </p>
              <p>
			    <?= __('faq.text.packagestuck_p3'); ?>
			  </p>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 pt-4" data-aos="fade-right">
            <div data-aos="fade-right">
              <h4><?= __('faq.title.whichcarriers'); ?></h4>
              <p>
				<?= __('faq.text.whichcarriers'); ?>
			  </p>
            </div>
              <br>
            <div data-aos="fade-right">
              <h4><?= __('faq.title.cainiao'); ?></h4>
              <p>
			    <?= __('faq.text.cainiao_p1'); ?>
			  </p>
              <p>
			    <?= __('faq.text.cainiao_p2'); ?>
			  </p>
              <br>
            </div>
            <div data-aos="fade-right">
              <h4><?= __('faq.title.statement', Configure::read('Site.url2')); ?></h4>
              <p>
			    <?= __('faq.text.statement', Configure::read('Site.url2')); ?>
			  </p>
            </div>
            <br>
            <div data-aos="fade-right">
              <h4><?= __('faq.title.cancel', Configure::read('Site.url2')); ?></h4>
              <p>
			    <?= __('faq.text.cancel_part1', Configure::read('Site.url2')); ?>
				<a href="<?= $this->Html->url(array('controller' => 'terminations', 'action' => 'index', 'language' => $this->Session->read('Config.language'))); ?>"> <?= __('faq.link.cancel'); ?> </a> 
				<?= __('faq.text.cancel_part2', Configure::read('Site.url2')); ?>
			  </p>
            </div>
            <br>
          </div>
        
        </div>
      </div>
  </section>

  <section id="contact-home">
    <div class="container m-auto p-5">
      <div class="row">
        <div class="col-md-12 text-center text-white">
          <h3 class="text-center text-light p-3"><?= __('home.title.lovetohear') ?></h3>
          <a class="btn btn-1" href="<?= $this->Html->url(array('controller' => 'contacts', 'action' => 'index', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('home.link.getintouch') ?></a>
        </div>
      </div>
    </div>
  </section>

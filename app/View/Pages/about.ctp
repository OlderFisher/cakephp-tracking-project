    <!-- PAGE HEADER -->
    <section id="page-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="my-4">
            <?= __('about.title.whywerehere'); ?>
          </h2>
          </div>
        </div>
      </div>
    </section>

  <!-- ABOUT SECTION -->
  <section id="about" class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-6 pt-2" data-aos="zoom-out">
          <img src="/img/whychooseus.png" alt="phone map" class="about-image pl-5">
        </div>
        <div class="col-md-12 col-lg-6 pt-4 pb-4">
          <p>
		      <?= __('about.text.nowadays', Configure::read('Site.url2')); ?>
		      </p>

          <p>
		      <?= __('about.text.ourtrackingsolution'); ?>
		      </p>

          <p>
		      <?= __('about.text.team', Configure::read('Site.url2')); ?>
		      </p>
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

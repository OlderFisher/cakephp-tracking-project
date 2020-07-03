
  <!-- PAGE HEADER -->

  <section class="head" id="order">
      <div class="container">
          <div class="row">
              <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                  <div class="text-center">
                      <h1 class="fw-600"><?= __d('policy', 'title'); ?></h1>
                  </div>

                  <h3 class="sm"><?= __d('policy', 'general_provisions.title'); ?></h3>
                  <p><?= __d('policy', 'general_provisions.text.1'); ?></p>
                  <p><?= __d('policy', 'general_provisions.text.2'); ?></p>
                  <p><?= __d('policy', 'general_provisions.text.3', Configure::read('Company.name_ltd'), Configure::read('Company.inc_number'), Configure::read('Company.address'), '<a href="mailto:'.Configure::read('Contact.email_site').'">'.Configure::read('Contact.email_site').'</a>'); ?></p>
			        <?= __d('policy', 'description.p2',
                      '<a href="'.$this->Html->url(array('controller' => 'pages', 'action' => 'cgv', 'language' => $this->Session->read('Config.language'))).'">'.__d('policy', 'tos').'</a>',
                      '<a href="'.$this->Html->url(array('controller' => 'pages', 'action' => 'cookie', 'language' => $this->Session->read('Config.language'))).'">'.__d('policy', 'cookie_policy').'</a>' ); ?>
                  <h3 class="sm"><?= __d('policy', 'collection.title'); ?></h3>
                  <p>
                      <?= __d('policy', 'collection.text.1'); ?>
                  </p>

                  <ul class="simple-list">
                      <li><span><?= __d('policy', 'collection.text.1.li.1'); ?></span></li>
                      <li><span><?= __d('policy', 'collection.text.1.li.2'); ?></span></li>
                      <li><span><?= __d('policy', 'collection.text.1.li.3'); ?></span></li>
                      <li><span><?= __d('policy', 'collection.text.1.li.4'); ?></span></li>
                      <li><span><?= __d('policy', 'collection.text.1.li.5'); ?></span></li>
                      <li><span><?= __d('policy', 'collection.text.1.li.6'); ?></span></li>
                  </ul>

                  <h4><?= __d('policy', 'collection.subtitle.a'); ?></h4>
                  <p><?= __d('policy', 'collection.text.2'); ?></p>

                  <h4><?= __d('policy', 'collection.subtitle.b'); ?></h4>
                  <p><?= __d('policy', 'collection.text.3'); ?></p>
                  <ul class="simple-list">
                      <li><p><?= __d('policy', 'collection.text.3.li.1'); ?></p></li>
                      <li><p><?= __d('policy', 'collection.text.3.li.2', '<a href="mailto:'.Configure::read('Contact.email_site').'">'.Configure::read('Contact.email_site').'</a>'); ?></p></li>
                      <li><p><?= __d('policy', 'collection.text.3.li.3', Configure::read('Site.name2')); ?></p></li>
                  </ul>

                  <h5><?= __d('policy', 'collection.subtitle.c'); ?></h5>
                  <p><?= __d('policy', 'collection.text.5'); ?></p>
                  <p><?= __d('policy', 'collection.text.6'); ?></p>
                  <p><?= __d('policy', 'collection.text.7', Configure::read('Site.name2')); ?></p>

                  <h4><?= __d('policy', 'collection.subtitle.d'); ?></h4>
                  <p><?= __d('policy', 'collection.text.8'); ?></p>

                  <h4><?= __d('policy', 'collection.subtitle.e'); ?></h4>
                  <p><?= __d('policy', 'collection.text.9'); ?></p>

                  <h4><?= __d('policy', 'collection.subtitle.f'); ?></h4>
                  <p><?= __d('policy', 'collection.text.10'); ?></p>
                  <p><?= __d('policy', 'collection.text.11'); ?></p>
                  <p><?= __d('policy', 'collection.text.12'); ?></p>
                  <p><?= __d('policy', 'collection.text.13'); ?></p>
                  <p><?= __d('policy', 'collection.text.14'); ?></p>
                  <p><?= __d('policy', 'collection.text.15'); ?></p>
                  <p><?= __d('policy', 'collection.text.16', '<a href="mailto:'.Configure::read('Contact.email_site').'">'.Configure::read('Contact.email_site').'</a>'); ?></p>

                  <h3 class="sm"><?= __d('policy', 'collection_non_personally.title'); ?></h3>
                  <p><?= __d('policy', 'collection_non_personally.text.1'); ?></p>
                  <p><?= __d('policy', 'collection_non_personally.text.2'); ?></p>

                  <h3 class="sm"><?= __d('policy', 'storage_and_information_transfer.title'); ?></h3>
                  <p><?= __d('policy', 'storage_and_information_transfer.text.1'); ?></p>
                  <p><?= __d('policy', 'storage_and_information_transfer.text.2'); ?></p>
                  <p><?= __d('policy', 'storage_and_information_transfer.text.3'); ?></p>

                  <h3 class="sm"><?= __d('policy', 'third_party.title'); ?></h3>
                  <p><?= __d('policy', 'third_party.text.1'); ?></p>
                  <p><?= __d('policy', 'third_party.text.2'); ?></p>

                  <h3 class="sm"><?= __d('policy', 'information_retention_period.title'); ?></h3>
                  <p><?= __d('policy', 'information_retention_period.text.1'); ?></p>

                  <h3 class="sm"><?= __d('policy', 'information_retention_period.title'); ?></h3>
                  <p><?= __d('policy', 'information_retention_period.text.1'); ?></p>

                  <h3 class="sm"><?= __d('policy', 'user_rights.title'); ?></h3>
                  <p><?= __d('policy', 'user_rights.text.1'); ?></p>

                  <ul class="simple-list">
                      <li><p><?= __d('policy', 'user_rights.text.1.li.1'); ?></p></li>
                      <li><p><?= __d('policy', 'user_rights.text.1.li.2', Configure::read('Site.name2')); ?></p></li>
                      <li><p><?= __d('policy', 'user_rights.text.1.li.3'); ?></p></li>
                      <li><p><?= __d('policy', 'user_rights.text.1.li.4'); ?></p></li>
                      <li><p><?= __d('policy', 'user_rights.text.1.li.5', Configure::read('Site.name2')); ?></p></li>
                      <li><p><?= __d('policy', 'user_rights.text.1.li.6', Configure::read('Site.name2')); ?></p></li>
                      <li><p><?= __d('policy', 'user_rights.text.1.li.7'); ?></p></li>
                  </ul>

                  <h3 class="sm"><?= __d('policy', 'changes.title'); ?></h3>
                  <p><?= __d('policy', 'changes.text.1'); ?></p>

                  <h3 class="sm"><?= __d('policy', 'contact.title'); ?></h3>
                  <p><?= __d('policy', 'contact.text.1', '<a href="mailto:'.Configure::read('Contact.email_site').'">'.Configure::read('Contact.email_site').'</a>'); ?></p>


              </div>
          </div>
      </div>
  </section>



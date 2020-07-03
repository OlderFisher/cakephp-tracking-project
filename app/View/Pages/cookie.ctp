  <!-- PAGE HEADER -->

  <section class="head" id="order">
      <div class="container">
          <div class="row">
              <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                  <div class="text-center">
                      <h1 id="cookie-policy-h" class="fw-600"><?= __d('cookie', 'title'); ?></h1>
                      <p id="cookie-policy-p">
                          <?= __d('cookie', 'effective', Configure::read('Site.url'), '<a href="'.$this->Html->url(array('controller' => 'pages', 'action' => 'cookie', 'language' => $this->Session->read('Config.language'))).'">'.__d('cookie', 'link.cookie_policy').'</a>'); ?>
                      </p>
                  </div>

                      <h3 class="sm"><?= __d('cookie', 'general_information.title'); ?></h3>
                      <p><?= __d('cookie', 'general_information.text.1'); ?></p>
                      <p><?= __d('cookie', 'general_information.text.2'); ?></p>

                      <table class="table table-bordered">
                          <tr>
                              <th><?= __d('cookie', 'th.category'); ?></th>
                              <th><?= __d('cookie', 'th.example'); ?></th>
                          </tr>
                          <tr>
                              <td><?= __d('cookie', 'th.preferences.title'); ?></td>
                              <td><?= __d('cookie', 'th.preferences.text'); ?></td>
                          </tr>
                          <tr>
                              <td><?= __d('cookie', 'th.authentification.title'); ?></td>
                              <td>
                                  <span><?= __d('cookie', 'th.authentication.subtitle.1'); ?></span>
                                  <br>
                                  <?= __d('cookie', 'th.authentication.text.1'); ?>
                                  <br>
                                  <span><?= __d('cookie', 'th.authentication.subtitle.2'); ?></span>
                                  <br>
                                  <?= __d('cookie', 'th.authentication.text.2'); ?>
                              </td>
                          </tr>
                          <tr>
                              <td><?= __d('cookie', 'th.performance.title'); ?></td>
                              <td><?= __d('cookie', 'th.performance.text'); ?></td>
                          </tr>
                          <tr>
                              <td><?= __d('cookie', 'th.analytics.title'); ?></td>
                              <td><?= __d('cookie', 'th.analytics.text'); ?></td>
                          </tr>
                      </table>

                      <p><?= __d('cookie', 'general_information.text.3'); ?></p>
                      <p><?= __d('cookie', 'general_information.text.4'); ?></p>
                      <h3 class="sm"><?= __d('cookie', 'managing_cookie.title'); ?></h3>
                      <p><?= __d('cookie', 'managing_cookie.text.1'); ?></p>
                      <h3 class="sm"><?= __d('cookie', 'contact_information.title'); ?></h3>
                      <p><?= __d('cookie', 'contact_information.text.1', '<a href="mailto:'.Configure::read('Contact.email_site').'">'.Configure::read('Contact.email_site').'</a>'); ?></p>

              </div>
          </div>
      </div>
  </section>




  <!-- Terms SECTION -->
  <section id="terms" class="py-4">
    <div class="container" style="overflow-x: hidden">
        <div class="row">

		  </div>
    </div>
  </section>

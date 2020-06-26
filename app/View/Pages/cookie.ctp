  <!-- PAGE HEADER -->
  <section id="page-header">
    <div class="container" style="overflow-x: hidden">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="mt-4 mb-0"><span class="secondary-color"><?= __d('cookie', 'title'); ?></span></h2>
          <p class="pt-2 pl-2 small font-italic">
            <?= __d('cookie', 'effective', Configure::read('Site.url'), '<a href="'.$this->Html->url(array('controller' => 'pages', 'action' => 'cookie', 'language' => $this->Session->read('Config.language'))).'">'.__d('cookie', 'link.cookie_policy').'</a>'); ?>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Terms SECTION -->
  <section id="terms" class="py-4">
    <div class="container" style="overflow-x: hidden">
        <div class="row">
          <div class="col-md-12 pt-4 pb-4">
			<h4><?= __d('cookie', 'general_information.title'); ?></h4>

			<p>
				<?= __d('cookie', 'general_information.text.1'); ?>
			</p>
			<p>
				<?= __d('cookie', 'general_information.text.2'); ?>
		    </p>
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

			  <p>
				<?= __d('cookie', 'general_information.text.3'); ?>
			  </p>

			  <p>
			  	<?= __d('cookie', 'general_information.text.4'); ?>
			  </p>

			  <h4><?= __d('cookie', 'managing_cookie.title'); ?></h4>
            	<p><?= __d('cookie', 'managing_cookie.text.1'); ?></p>

				<h4><?= __d('cookie', 'contact_information.title'); ?></h4>
            <p><?= __d('cookie', 'contact_information.text.1', '<a href="mailto:'.Configure::read('Contact.email_site').'">'.Configure::read('Contact.email_site').'</a>'); ?></p>
			</div>
		  </div>
    </div>
  </section>

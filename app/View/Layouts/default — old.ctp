<?php
$option_link = '';
if($this->params['controller'] == 'payments') {
  $option_link = '_blank';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  echo $this->Html->charset();
  ?>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="/img/favicon/site.webmanifest">

  <title><?php echo $this->fetch('title'); ?></title>

  <meta name="description" content="<?php echo empty($meta_description) ? NULL : $meta_description ; ?>">

  <script src="https://kit.fontawesome.com/1d8cb88fe1.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  <?php
      echo $this->Html->css('bootstrap.min.css?x='.Configure::read('Variable.css_js'));
      echo $this->Html->css('ekko-lightbox.css?x='.Configure::read('Variable.css_js'));
      echo $this->Html->css('style.css?x='.Configure::read('Variable.css_js'));
      echo $this->Html->css('aos.css');

      echo $this->fetch('meta');
      echo $this->fetch('css');
      echo $this->fetch('script');

      if(isset($noRobot) && $noRobot) {
        echo '<meta name="robots" content="noindex,nofollow" />';
      }
  ?>
  <script src="https://www.google.com/recaptcha/api.js?hl=<?= $this->Session->read('Config.language') ?>"  async defer></script>

  <!-- Google Analytics -->
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-24565425-22', 'auto');
  ga('send', 'pageview');
  </script>
  <!-- End Google Analytics -->

</head>

<body>

    <?php if ($this->params['action'] == 'home'): ?>
    <header class="js--section-header" id="header">
    <?php else: ?>
    <header>
    <?php endif; ?>

        <nav id="navbar" class="navbar navbar-expand-lg bg-white m-auto fixed-top navbar-light">
            <div class="container">
                <a target="<?= $option_link; ?>" href="<?php echo $this->Html->url(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language'))); ?>" <?= __('header.link.home') ?>>
                  <img src="/img/delivery_logo.png" alt="delivery tracker logo" class="nav-logo text-dark" width="80px">
                  <?= Configure::read('Site.name2'); ?>
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                  <?php if ($this->Session->Read('Auth.User') != ''): ?>
                      <li class="nav-item">
                        <a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'index', 'language' => $this->Session->read('Config.language'))); ?>" class="nav-link"><?= __('header.link.profile') ?></a>
                      </li>
                      <li class="nav-item">
                        <a href="<?= $this->Html->url(array('controller' => 'tracking', 'action' => 'dashboard', 'language' => $this->Session->read('Config.language'))); ?>" class="nav-link"><?= __('header.link.tracking') ?></a>
                      </li>
                      <div class="dropdown">
                        <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?= __('header.link.assistance') ?>
                        </a>
                        <div class="dropdown-menu mb-2" href="#" aria-labelledby="dropdownMenuButton">
                          <li>
                            <a class="dropdown-item" href="<?= $this->Html->url(array('controller' => 'requests', 'action' => 'formRequest', 'language' => $this->Session->read('Config.language'))); ?>">Create Request</a>
                          </li>
                          <li>
                           <a class="dropdown-item" href="<?= $this->Html->url(array('controller' => 'requests', 'action' => 'listRequest', 'language' => $this->Session->read('Config.language'))); ?>">Requests List</a>
                          </li>
                        </div>
                      </div>
                      <li class="nav-item text-white">
                        <a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'logout', 'language' => $this->Session->read('Config.language'))); ?>" class="btn btn-nav nav-link"><?= __('header.link.logout') ?></a>
                      </li>
                  <?php else: ?>
                      <li class="nav-item">
                        <a target="<?= $option_link; ?>" href="<?php echo $this->Html->url(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language'))); ?>" class="nav-link"><?= __('header.link.home') ?></a>
                      </li>
                      <li class="nav-item">
                        <a target="<?= $option_link; ?>" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'about', 'language' => $this->Session->read('Config.language'))); ?>" class="nav-link"><?= __('header.link.about') ?></a>
                      </li>
                      <li class="nav-item">
                        <a target="<?= $option_link; ?>" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'faq', 'language' => $this->Session->read('Config.language'))); ?>" class="nav-link"><?= __('header.link.faq') ?></a>
                      </li>
                      <li class="nav-item">
                        <a target="<?= $option_link; ?>" href="<?= $this->Html->url(array('controller' => 'contacts', 'action' => 'index', 'language' => $this->Session->read('Config.language'))); ?>" class="nav-link"><?= __('header.link.contact') ?></a>
                      </li>
                      <li class="nav-item text-white">
                        <a target="<?= $option_link; ?>" href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'login', 'language' => $this->Session->read('Config.language'))); ?>" class="btn btn-nav nav-link"><?= __('header.link.login') ?></a>
                      </li>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
        </nav>

    <?php echo $this->Session->flash(); ?>

    </header>

    <?php echo $this->fetch('content'); ?>

    <!-- Footer -->
    <footer class="text-center p-4 text-md-left bg-light text-muted">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-3 col-xl-3">
          <a target="<?= $option_link; ?>" href="<?php echo $this->Html->url(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language'))); ?>" <?= __('header.link.home') ?>>
            <img src="/img/delivery_logo.png" alt="delivery tracker logo" class="nav-logo text-dark" width="80px">
          </a>
          <span class="text-dark font-weight-bold"><?= Configure::read('Site.name2'); ?></span>
          <!-- <h5 class="mb-3 text-dark"><?= __('footer.title.aboutus', Configure::read('Site.name')) ?></h5> -->
          <!-- <p class="mb-0"><?= __('footer.text.aboutus', Configure::read('Site.name')) ?></p> -->
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3">
          <h5 class="mb-3 mt-4 mt-lg-0 text-dark"><?= __('footer.title.quicklinks') ?></h5>
          <ul class="mb-0 list-unstyled">
            <li>
              <a target="" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'about', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('footer.link.aboutus') ?></a>
            </li>
            <li>
              <a target="" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'faq', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('footer.link.faq') ?></a>
            </li>
            <li>
              <a target="<?= $option_link ?>" href="<?= $this->Html->url(array('controller' => 'terminations', 'action' => 'index', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('footer.link.unsubscribe') ?></a>
            </li>
          </ul>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3">
          <h5 class="mb-3 mt-4 mt-lg-0 text-dark"><?= __('footer.title.legalinfo') ?></h5>
          <ul class="mb-0 list-unstyled">
            <li>
              <a target="" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'cgv', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('footer.link.tandc') ?></a>
            </li>
            <li>
              <a target="" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'cookie', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('footer.link.cookies') ?></a>
            </li>
            <li>
              <a target="" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'mentionsLegales', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('footer.link.legal') ?></a>
            </li>
            <li>
              <a target="" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'policy', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('footer.link.privacy') ?></a>
            </li>
          </ul>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3">
          <h5 class="mb-3 mt-4 mt-lg-0 text-dark"><?= __('footer.title.getintouch') ?></h5>
          <ul class="list-unstyled">
            <li>
              <a href="callto:<?php echo Configure::read('Config.phone'); ?>"><?php echo Configure::read('Config.phone'); ?></a>
            </li>
            <li>
              <a target="<?= $option_link ?>" href="<?= $this->Html->url(array('controller' => 'contacts', 'action' => 'index', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('footer.link.contactform') ?></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="row justify-content-center pt-4">
        <div class="col-6 col-md-6 col-lg-3 p-0">
          <div class="dropdown border border-dark f-dropdowns">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownLanguageLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="flag-icon flag-icon-<?= $this->Session->read('Config.language') ?>"></span> <?= Configure::read('languages')[$this->Session->read('Config.language')] ?>
            </a>
            <div class="dropdown-menu mb-2" aria-labelledby="dropdownLanguage">
              <?php foreach (Configure::read('languages') as $code => $language) { ?>
                <a class="dropdown-item" href="<?= $this->Html->url(array('controller' => 'customers', 'action' => 'home', 'language' => $code)); ?>">
                  <span class="flag-icon flag-icon-<?= $code ?>"></span> <?= $language ?>
                </a>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-6 col-lg-3 mt-md-0 p-0">
          <div class="dropdown border border-dark f-dropdowns">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownCurrencyLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="text-warning"><?= Configure::read('currencies')[$this->Session->read('Config.currency')]['symbol'].strtoupper(Configure::read('currencies')[$this->Session->read('Config.currency')]['code']) ?></span>
              <!-- <?= Configure::read('currencies')[$this->Session->read('Config.currency')]['name'] ?> -->
            </a>
            <div class="dropdown-menu mb-2" aria-labelledby="dropdownCurrency">
              <?php foreach (Configure::read('currencies') as $code => $currency) { ?>
                <a class="dropdown-item text-dark" href="<?= $this->Html->url(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language'), 'currency' => $code)); ?>">
                  <span class="text-warning"><?= $currency['symbol'].strtoupper($currency['code']) ?></span>
                  <!-- <?= $currency['name'] ?> -->
                </a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <?php if (!$cookieMessage): ?>
      <div id="MessageCookie" class="fixed-bottom">
            <div class="bg-light text-dark p-3">
              <div class="container">
                <div class="row justify-content-around align-items-center">
                  <div class="col-12 col-sm-11">
                    <p class="mb-0"> <?= __('cookies.text'); ?>
                    <a href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'cookie', 'language' => $this->Session->read('Config.language'))) ?>"><?= __('cookies.text.link'); ?></a>
                  </p>
                  </div>
                  <div class="col-12 col-sm-1">
                    <button type="button" id="ButtonCookie" class="btn btn-lg btn-warning text-white" name="button">Ok</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>
      <div class="footer-bottom">
        <div class="row">
          <div class="col pt-4 text-center">
            <?php if ($this->params['controller'] == 'payments' && $this->params['action'] == 'index'): ?>
              <p>Copyright &copy; <?= Configure::read('Company.name_ltd')." - ".Configure::read('Company.address'); ?></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    </footer>

    <script type="text/javascript">
      // MESSAGES LOCALES
      var cardNumberInvalidMsg = "<?= __('message.error.card_number_invalid') ?>";
      var tosRequiredMsg = "<?= __('validation.required.tos') ?>";
      var firstnameRequiredMsg = "<?= __('validation.required.firstname') ?>";
      var firstnameMinMsg = "<?= __('validation.min.firstname') ?>";
      var lastnameRequiredMsg = "<?= __('validation.required.lastname') ?>";
      var lastnameMinMsg = "<?= __('validation.min.lastname') ?>";
      var emailRequiredMsg = "<?= __('validation.required.email') ?>";
      var emailEmailMsg = "<?= __('validation.email') ?>";
      var subjectRequiredMsg = "<?= __('validation.required.subject') ?>";
      var subjectMinMsg = "<?= __('validation.min.subject') ?>";
      var messageRequiredMsg = "<?= __('validation.required.message') ?>";
      var messagetMinMsg = "<?= __('validation.min.message') ?>";
      var policyRequiredMsg = "<?= __('validation.required.policy') ?>";
      var passwordRequiredMsg = "<?= __('validation.required.policy') ?>";
      var phoneRequiredMsg = "<?= __('validation.required.phone') ?>";
      var categoryRequiredMsg = "<?= __('validation.required.category') ?>";

      // URLS
      var cookieAcceptUrl = '<?= $this->Html->url(array('controller' => 'customers', 'action' => 'acceptCookie', 'language' => $this->Session->read('Config.language'))); ?>';
      // var noConfirmUrl = '<?= $this->Html->url(array('controller' => 'payments', 'action' => 'noconfirm', 'language' => $this->Session->read('Config.language'))); ?>';
      var detectCarrierUrl = '<?= $this->Html->url(array('controller' => 'tracking', 'action' => 'detectCarrier', 'language' => $this->Session->read('Config.language'), 'number' => '')); ?>';
      var carrierLogoUrl = '<?= Configure::read('aftership.logo_url') ?>';
      var newParcelUrl = '<?= $this->Html->url(array('controller' => 'tracking', 'action' => 'new', 'language' => $this->Session->read('Config.language'), 'number' => '')); ?>';
      var getParcelUrl = '<?= $this->Html->url(array('controller' => 'tracking', 'action' => 'get', 'language' => $this->Session->read('Config.language'), 'number' => '')); ?>';
    </script>

    <?php
      echo $this->Html->script('jquery-3.4.1.min.js?x='.Configure::read('Variable.css_js'));
      echo $this->Html->script('popper.min.js?x='.Configure::read('Variable.css_js'));
      echo $this->Html->script('bootstrap.min.js?x='.Configure::read('Variable.css_js'));
      echo $this->Html->script('cleave.min.js?x='.Configure::read('Variable.css_js'));
      echo $this->Html->script('jquery.validate.min.js?x='.Configure::read('Variable.css_js'));
      echo $this->Html->script('jquery.autotab.min.js?x='.Configure::read('Variable.css_js'));
      echo $this->Html->script('aos.js?x='.Configure::read('Variable.css_js'));
      echo $this->Html->script('main.js?x='.Configure::read('Variable.css_js'));

      echo $this->fetch('scriptBottom');
    ?>

</body>

</html>

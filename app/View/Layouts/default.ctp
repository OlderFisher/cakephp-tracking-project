<?php
$option_link = '';
if ($this->params['controller'] == 'payments') {
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

  <meta name="description" content="<?php echo empty($meta_description) ? null : $meta_description ; ?>">

  <script src="https://kit.fontawesome.com/1d8cb88fe1.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/additional.css">

  <?php
//      echo $this->Html->css('bootstrap.min.css?x='.Configure::read('Variable.css_js'));
        echo $this->Html->css('ekko-lightbox.css?x='.Configure::read('Variable.css_js'));
        echo $this->Html->css('style.css?x='.Configure::read('Variable.css_js'));
        echo $this->Html->css('aos.css');

      echo $this->fetch('meta');
      echo $this->fetch('css');
      echo $this->fetch('script');

      if (isset($noRobot) && $noRobot) {
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

    <nav class="navbar navbar-expand-xl">
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-start">

                    <div class="navbar-brand">
                        <a target="<?= $option_link; ?>" href="<?php echo $this->Html->url(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language'))); ?>" <?= __('header.link.home') ?>>
                            <img class="dark-top-logo" src="/img/logo.svg" alt="delivery tracker logo" class="nav-logo text-dark" width="194px">
                        </a>
                    </div>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <img src="/img/menu.svg" alt="">
                    </button>

                    <div class="collapse navbar-collapse flex-grow-0 justify-content-end ml-auto" id="navbarSupportedContent">
                        <ul class="navbar-nav d-flex justify-content-start">

                        <?php if ($this->Session->Read('Auth.User') != ''): ?>

                        <li class="nav-item align-self-center">
                           <a class="nav-link" target="<?= $option_link; ?>" href="<?= $this->Html->url( array('controller' => 'users', 'action' => 'index', 'language' => $this->Session->read('Config.language'))); ?>"> 
                           <?= __('header.link.profile') ?></a>
                        </li>
                        <li class="nav-item align-self-center">
                           <a class="nav-link" target="<?= $option_link; ?>" href="<?= $this->Html->url(array('controller' => 'tracking', 'action' => 'dashboard', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('header.link.tracking') ?></a>
                        </li>
                        <li class="nav-item align-self-center">
                           <a class="nav-link" target="<?= $option_link; ?>" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'faq', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('header.link.faq') ?></a>
                        </li>                       
                        
                        <div class="nav-item dropdown align-self-center home-dropdown">
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
                      
                        <div class="nav-item contact-item align-self-center d-none d-sm-block">
                            <a href="tel:442033182332"><img src="/img/t-mobile.svg" alt="">+44 2 033 182 332</a>
                        </div>
                        <div class="nav-item align-self-center d-none d-xl-block">
                            <a  class="btn" target="<?= $option_link; ?>" href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'logout', 'language' => $this->Session->read('Config.language'))); ?>" class="btn btn-nav nav-link"><?= __('header.link.logout') ?></a>
                        </div>


                        <?php else: ?>

                             <li class="nav-item align-self-center">
                                 <a class="nav-link" target="<?= $option_link; ?>" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'about', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('header.link.about') ?></a>
                             </li>
                             <li class="nav-item align-self-center">
                                 <a class="nav-link" target="<?= $option_link; ?>" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'faq', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('header.link.faq') ?></a>
                             </li>
                             <li class="nav-item align-self-center">
                                 <a class="nav-link" target="<?= $option_link; ?>" href="<?= $this->Html->url(array('controller' => 'contacts', 'action' => 'index', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('header.link.contact') ?></a>
                             </li>
                         </ul>
                        <div class="nav-item contact-item align-self-center d-none d-sm-block">
                            <a href="tel:442033182332"><img src="/img/t-mobile.svg" alt="">+44 2 033 182 332</a>
                        </div>
                        <div class="nav-item align-self-center d-none d-xl-block">
                            <a  class="btn" target="<?= $option_link; ?>" href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'login', 'language' => $this->Session->read('Config.language'))); ?>" class="btn btn-nav nav-link"><?= __('header.link.login') ?></a>
                        </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </nav>


    </header>
    <div class="session_flash"><?php echo $this->Session->flash(); ?></div>
    <?php echo $this->fetch('content'); ?>

    <!-- Footer -->
    <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg">
            <div class="navbar-brand mb-5">
                <a class="navbar-brand__logo" target="<?= $option_link; ?>" href="<?php echo $this->Html->url(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language'))); ?>" <?= __('header.link.home') ?>>
                    <img src="/img/logo-white.svg" alt="delivery tracker logo" class="nav-logo text-dark" width="80px">
                </a>
            </div>
        </div>

        <div class="col-lg">
          <h4 ><?= __('footer.title.quicklinks') ?></h4>
          <ul>
            <li>
              <a target="" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'about', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('footer.link.aboutus') ?></a>
            </li>
            <li>
              <a target="" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'faq', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('footer.link.faq') ?></a>
            </li>
            <li>
                <a href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'serviceclient', 'language' => $this->Session->read('Config.language'))); ?>"> <?= __('footer.link.serviceclient') ?></a>
            </li>
            <li>
              <a target="<?= $option_link ?>" href="<?= $this->Html->url(array('controller' => 'terminations', 'action' => 'index', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('footer.link.unsubscribe') ?></a>
            </li>
          </ul>
        </div>


        <div class="col-lg">
          <h4><?= __('footer.title.legalinfo') ?></h4>
          <ul>
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


        <div class="col-lg">
          <h4 ><?= __('footer.title.getintouch') ?></h4>
          <ul>
            <li>
              <a href="callto:<?php echo Configure::read('Config.phone'); ?>"><?php echo Configure::read('Config.phone'); ?></a>
            </li>
            <li>
              <a href="mailto:contact@tracker.net">contact@tracker.net</a>
            </li>
            <li>
              <a target="<?= $option_link ?>" href="<?= $this->Html->url(array('controller' => 'contacts', 'action' => 'index', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('footer.link.contactform') ?></a>
            </li>
            <li>
              <a target="<?= $option_link ?>" href="<?= $this->Html->url(array('controller' => 'contacts', 'action' => 'claim', 'language' => $this->Session->read('Config.language'))); ?>"><?= __('footer.link.complaint') ?></a>
            </li>
          </ul>
        </div>

        <div class="col-lg">
           <a class="dropdown" data-toggle="collapse" href="#language" role="button" aria-expanded="false" aria-controls="language">
                <span class="flag-icon flag-icon-<?= $this->Session->read('Config.language') ?>"></span> <?= Configure::read('languages')[$this->Session->read('Config.language')] ?>
           </a>
           <div class="collapse dropdown-collapse" id="language">
                <?php foreach (Configure::read('languages') as $code => $language) { ?>
                    <a class="disabled" href="<?= $this->Html->url(array('controller' => 'customers', 'action' => 'home', 'language' => $code)); ?>">
                        <span class="flag-icon flag-icon-<?= $code ?>"></span> <?= $language ?>
                    </a>
                <?php } ?>
           </div>
              <a class="dropdown mt-4" data-toggle="collapse" href="#currency" role="button" aria-expanded="false" aria-controls="currency">
                  <span><?= Configure::read('currencies')[$this->Session->read('Config.currency')]['symbol'].strtoupper(Configure::read('currencies')[$this->Session->read('Config.currency')]['code']) ?></span>
                  <!-- <?= Configure::read('currencies')[$this->Session->read('Config.currency')]['name'] ?> -->
              </a>
              <div class="collapse dropdown-collapse" id="currency">
                  <?php foreach (Configure::read('currencies') as $code => $currency) { ?>
                      <a class="disabled" href="<?= $this->Html->url(array('controller' => 'customers', 'action' => 'home', 'language' => $this->Session->read('Config.language'), 'currency' => $code)); ?>">
                          <span><?= $currency['symbol'].strtoupper($currency['code']) ?></span>
                          <!-- <?= $currency['name'] ?> -->
                      </a>
                  <?php } ?>
              </div>
          </div>

      </div>
<!--        End of row -->



      <?php if (!$cookieMessage): ?>
      <div id="MessageCookie" class="fixed-bottom" style="display: none">
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script ksrc="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <?php
      echo $this->Html->script('cleave.min.js?x='.Configure::read('Variable.css_js'));
      echo $this->Html->script('jquery.validate.min.js?x='.Configure::read('Variable.css_js'));
      echo $this->Html->script('jquery.autotab.min.js?x='.Configure::read('Variable.css_js'));
      echo $this->Html->script('aos.js?x='.Configure::read('Variable.css_js'));
      echo $this->Html->script('app.js?x='.Configure::read('Variable.css_js'));
      echo $this->Html->script('main.js?x='.Configure::read('Variable.css_js'));

      echo $this->fetch('scriptBottom');
    ?>



</body>

</html>

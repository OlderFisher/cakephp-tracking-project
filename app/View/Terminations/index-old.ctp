<!-- PAGE HEADER -->
<section id="page-header">
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1 class="my-4"><span class="secondary-color"><?= __('termination.title.termination'); ?></span></h1>
    </div>
  </div>
</div>
</section>

<!-- Customer Service SECTION -->
<section id="customer-service" class="py-5">
<div class="container" style="overflow-x: hidden">
  <div class="row">
    <div class="col-md-12">

	  <?php
  	  if(!isset($validated)) {
  		echo $this->element('terminations/term_form');
  	  } else {
  		echo $this->element('terminations/term_success');
  	  }
  	  ?>

    </div>

  </div>
</div>
</section>

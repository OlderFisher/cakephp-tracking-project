<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<section id="page-header">
		<div class="section mt-2">
			<div class="container text-center">
				<!-- <h1 class="text-red font-weight-normal" style="font-size:4.5rem;">Oops! something went wrong</h1> -->
				<!-- <h4 class="text-uppercase" style="font-size:2.5rem"><?= __('section.error.title'); ?></h4> -->
			</div>
		</div>
	</section>

	<div class="section">
		<div class="container">
			<div class="row justify-content-center my-2">
				<div class="col-md-10 col-xl-8 text-center">
					<img src="/img/error-404.png" class="img-fluid error-image py-4">
					<!-- <h4 class="text-uppercase"><?= __('section.error.title'); ?></h4> -->
					<!-- <p class="text-uppercase" style="font-size:2.5rem;"><?= __('section.error.title'); ?></p> -->
				<p class="text-uppercase py-4">
					<a class="btn btn-1" href="/"><?= __('section.error.btn'); ?></a>
				</p>
	  			</div>
	  		</div>
	  	</div>
	</div>

<?php
if (Configure::read('debug') > 0):
	echo $this->element('exception_stack_trace');
endif;
?>

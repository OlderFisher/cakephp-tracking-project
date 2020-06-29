<!-- PAGE HEADER -->

<section class="head" id="cancellation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3><?= __('termination.title.termination'); ?></h3>
                <div class="color-bg">
                    <h4 class="strong"><?= __('termination.subtitle.termination'); ?></h4>
                    <p><?= __('termination.text.termination'); ?></p>
                        <div class="form-group">
                            <?php
                            if(!isset($validated)) {
                                echo $this->element('terminations/term_form');
                            } else {
                                echo $this->element('terminations/term_success');
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>




<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3><?= __('termination.title.intrlpackagetracking'); ?></h3>
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <p><?= __('termination.text.intrlpackagetracking'); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%201.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%202.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%203.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%204.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%205.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%206.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%207.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%208.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%209.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%2010.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%2011.png" alt="">
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 d-flex flex-column justify-content-center text-center mt-4 mb-4">
                <img src="/img/image%2012.png" alt="">
            </div>
        </div>
    </div>
</section>

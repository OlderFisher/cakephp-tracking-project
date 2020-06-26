<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">
  <head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <style media="screen">
      section{
        padding-top: 5rem;
        padding-bottom: 5rem;
        position: relative;
        display: block;
      }
      .text-center{
        text-align: center;
      }
      .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        background-color: transparent;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
      }
      .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
      }
      .btn-primary:hover, .btn-primary.focus, .btn-primary:focus, .btn-primary:active {
        color: #fff;
        background-color: #0069d9;
        border-color: #0062cc;
      }
    </style>
  </head>
  <body>
    <section class="text-center">
      <form action="<?php echo $url; ?>" id="index3dsForm" method="post" accept-charset="utf-8">

        <input type="hidden" name="3DS" id="3DS" value="<?php echo $TroisDS; ?>" />
        <input type="hidden" name="ACSUrl" id="ACSUrl" value="<?php echo $ACSUrl; ?>" />
        <input type="hidden" name="PaReq" id="PaReq" value="<?php echo $PaReq; ?>" />
        <input type="hidden" name="TermUrl" id="TermUrl" value="<?php echo $TermUrl; ?>" />
        <input type="hidden" name="MD" id="MD" value="<?php echo $MD; ?>" />

        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
        <input type="hidden" name="returnUrl" id="returnUrl" value="<?php echo $returnUrl; ?>" />

        <div>
          <button class="btn btn-primary" type="submit">Envoyer</button>
        </div>

      </form>
    </section>

    <?php echo $this->Html->script('jquery-3.4.1.min'); ?>
    <script>
    $( document ).ready(function() {
      document.getElementById('index3dsForm').submit();
    });
    </script>
  </body>
</html>

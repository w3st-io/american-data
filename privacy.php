<?php 

include('header.php');

?>


  <!-- [SPACER] --> 
   <section class="w3l-about-breadcrumb position-relative text-center">
    <div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4">
      <div class="container py-lg-5 py-3">
        <h2 class="title">Privacy policy</h2>
      </div>
    </div>
  </section>
  <!-- //[SPACER] -->
  <!-- /content-6-->
  <section class="w3l-content-6 report-section">

    <div class="container">

        <div class="content-info-in row">
          <div class="col-lg-12">


            <h2>Immediate, and No Questions Asked</h2>
<p>We offer a full refund to all clients. No Questions asked.

You may use our automated support line to issue yourself a full refund.

Refund Email: support@americanvinhistory.com

Alternatively you may request a refund from our live chat located at the bottom right of the website.</p>
          </div>
          



        </div>
   


    </div>

  </section>
 

<?php include('./components/Contact.php'); ?>


<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>

<script type="text/javascript">
  $vinno = $('#vinno').val();

  const settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://vindecoder.p.rapidapi.com/salvage_check?vin="+$vinno,
    "method": "GET",
    "headers": {
      "x-rapidapi-key": "c404ea350amsh3a1bf345dd7386fp1bcde5jsnad8d954aa8d4",
      "x-rapidapi-host": "vindecoder.p.rapidapi.com"
    }
  };


  console.log($vinno);

  $.ajax(settings).done(function (response) {

    if (response.errors) {

      $('#result').html('<p>'+ response.message +'</p>');

    } else {

      
      if (response.is_salvage == true) {
        $('#is_salvage').html('<span class="badge success">' + response.is_salvage + '</span>');
      } else {
        
      }

      $('#f_is_salvage').html(response.is_salvage);

      $('#f_vehicle_title').html(response.info.vehicle_title);
      $('#f_loss_type').html(response.info.loss_type);
      $('#f_mileage').html(response.info.mileage);
      $('#f_primary_damage').html(response.info.primary_damage);
      $('#f_secondary_damage').html(response.info.secondary_damage);

      $('#vehicle_title').html(response.info.vehicle_title);
      $('#loss_type').html(response.info.loss_type);
      $('#mileage').html(response.info.mileage);
      $('#primary_damage').html(response.info.primary_damage);
      $('#secondary_damage').html(response.info.secondary_damage);
      console.log(response);
      console.log(response.info);

    }
  });
</script>

</body>
</html>
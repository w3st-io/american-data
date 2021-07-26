<?php 

$sth = $dbh->prepare("SELECT name, colour FROM fruit");
$sth->execute();

$result = $sth->fetchAll();


include('header.php'); 


print_r($result);

?>

  <!-- about breadcrumb --> 
   <section class="w3l-about-breadcrumb position-relative text-center">
    <div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4">
      <div class="container py-lg-5 py-3">
        <h2 class="title">Welcome</h2>
        <p> to VIN History Report Management Dashboard</p>
      </div>
    </div>
  </section>
  <!-- //about breadcrumb -->
  <!-- /content-6-->
  <section class="w3l-content-6 report-section">

    <div class="container">

        <div class="content-info-in row">
          

          <div class="col-md-12">
            
            <h3 class="pull-left" style="margin-bottom: 20px;">Dashboard of rosy@goodwebsite.com</h3>


            <a href="#" class="btn pull-right btn-primary btn-sm">Logout</a>

            <div class="table-dashbaord">
              
              <table class="table">
                
                <tr>
                  <th>Date</th>
                  <th>Payment status</th>
                  <th>Download Report</th>
                </tr>


                <tr>
                  
                  <td>10-06-2021 6.56pm</td>
                  <td>Completed</td>
                  <td><a href="" class="badge badge-primary">120432043432430434023</a></td>
                </tr>

                 <tr>
                  
                  <td>10-06-2021 6.56pm</td>
                  <td>Completed</td>
                  <td><a href="" class="badge badge-primary">120432043432430434023</a></td>
                </tr>

                 <tr>
                  
                  <td>10-06-2021 6.56pm</td>
                  <td>Completed</td>
                  <td><a href="" class="badge badge-primary">120432043432430434023</a></td>
                </tr>
                 <tr>
                  
                  <td>10-06-2021 6.56pm</td>
                  <td>Completed</td>
                  <td><a href="" class="badge badge-primary">120432043432430434023</a></td>
                </tr>

                 <tr>
                  
                  <td>10-06-2021 6.56pm</td>
                  <td>Completed</td>
                  <td><a href="" class="badge badge-primary">120432043432430434023</a></td>
                </tr>

              </table>

            </div>

          </div>
           
          </div>



        </div>
   


    </div>

  </section>
 
  <?php include('footer.php'); ?>

  
  <?php include('./common/bottom_script.php'); ?>

<script type="text/javascript">
  $vinno = $('#vinno').val();

  const settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://vindecoder.p.rapidapi.com/decode_vin?vin="+$vinno,
    "method": "GET",
    "headers": {
      "x-rapidapi-key": "c404ea350amsh3a1bf345dd7386fp1bcde5jsnad8d954aa8d4",
      "x-rapidapi-host": "vindecoder.p.rapidapi.com"
    }
  };

  $.ajax(settings).done(function (response) {

    if (response.errors) {

      $('#result').html('<p>'+ response.message +'</p>');

    }
    else {
      console.log(response.specification);

      $('#make').html(response.specification.make);
      $('#model').html(response.specification.model);
      $('#engine').html(response.specification.engine);
    }
  });
</script>

</body>
</html>
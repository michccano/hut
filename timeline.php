<?php 
session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Timeline</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="./plugins/summernote/summernote-bs4.css">

  <!-- AdminLTE css -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">


  
<?php include("navbar.php");?>


<?php include("sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Timeline</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Timeline</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">


            <!-- The time line -->
            <div class="timeline" id="timeline_good">



              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red">10 Feb. 2014</span>
              </div>
              <!-- /.timeline-label -->
            
          
            


              <!-- END timeline item -->
              <!-- timeline item -->
            

              <?php //include("tex.php");?>



              <!-- END timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>'


            </div>
          </div>
          <!-- /.col -->

        </div>

        <div class="row" style="width:50%;margin-left:40%;">

        <div class="col-md-2">
          <a id="yes_button" ><i class="far fa-thumbs-up" style="font-size: 48px;"></i>
         <p> <span>Yes</span></p></a>
        </div>
    <div class="col-md-2">
        <a id="no_button"><i class="far fa-thumbs-down" style="font-size: 48px;"></i>
         <p> <span>No</span></p></a>
        </div>
          <div class="col-md-2">
      <i class="far fa-exclamation-triangle" style="font-size: 48px;"></i>
         <p> <span>asdasd</span></p>
        </div>

        </div>



        <div class="row" >

        <div class="col-3">
          <button type="button" class="btn btn-block bg-gradient-danger btn-lg">Looks Good</button>
     
        </div>

  <div class="col-3">
  <button type="button" class="btn btn-block bg-gradient-info btn-lg">Info Acknowledged</button>
        </div>

  <div class="col-3">
<button type="button" class="btn btn-block bg-gradient-warning btn-lg">Needs more information</button>

        </div>

  <div class="col-3">
<button type="button" class="btn btn-block bg-gradient-warning btn-lg">Disagree</button>

        </div>




        </div>


<div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Post a reply to this Huddle Up
                <small></small>
              </h3>
              <!-- tools box -->
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fas fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
              <div class="mb-3" id="summernote">
               
             
            </div>
          </div>
        </div>
        <!-- /.col-->



<div class="row" style="margin-left: 30%;">
  <div class="col-6">
<button type="button" id="submit_post" class="btn btn-block btn-success btn-lg">SUBMIT</button>

        </div>
</div>

      </div>





      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js"></script>
<script src="./plugins/summernote/summernote-bs4.min.js"></script>
<script>



  $(function () {

$('#summernote').summernote();




$("#yes_button").click(function (e){

var settings = {
  "url": "system/addhuddleuppost.php",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded",
    "Authorization": "Bearer "+localStorage.token
  },
  "data":{"id":<?php echo $_GET["id"];?>,"typ":0,"text":" "}
  
};

postNow(settings);

    });


$("#no_button").click(function (e){

var settings = {
  "url": "system/addhuddleuppost.php",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded",
    "Authorization": "Bearer "+localStorage.token
  },
  "data":{"id":<?php echo $_GET["id"];?>,"typ":1,"text":" "}
  
};

postNow(settings);

    });



$("#submit_post").click(function (e){
  var markupStr = $('#summernote').summernote('code');

var settings = {
  "url": "system/addhuddleuppost.php",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded",
    "Authorization": "Bearer "+localStorage.token
  },
  "data":{"id":<?php echo $_GET["id"];?>,"text":markupStr,"typ":2}
  
};

postNow(settings);

    });




var settings = {
  "url": "system/addhuddleuppost.php",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded",
    "Authorization": "Bearer "+localStorage.token
  },
  "data":{"id":<?php echo $_GET["id"];?>}
  
};

postNow(settings);


function postNow(settings){

  $.ajax(settings).done(function (response) {

  var response = JSON.parse(response);
  $("#timeline_good").html("");

  for(var i=0; i<response.length; i++){
 
 if(response[i].typ==0 || response[i].typ==1){
    var tmp55 = "";
    var tmp66 = "";
  if(response[i].typ==0){
    tmp55 = "fa-thumbs-up bg-green";
    tmp66 = "liked";
  }
  else{
    tmp66 = "disliked";
     tmp55 = "fa-thumbs-down bg-red";
  }

         $("#timeline_good").append('<div><i class="far '+tmp55+' "></i><div class="timeline-item"><span class="time"><i class="fas fa-clock"></i> '+response[i].whn+'</span><h3 class="timeline-header no-border"><a href="#">'+response[i].full_name+'</a> '+tmp66+' this huddle up.</h3><div class="timeline-body"><div class="row"><img class="img-circle img-sm" src="dist/img/user3-128x128.jpg" alt="User Image"/></div></div></div></div>');

}


else{

    $("#timeline_good").append('<div><i class="fas fa-comments bg-yellow"></i><div class="timeline-item"><span class="time"><i class="fas fa-clock"></i> '+response[i].whn+'</span><h3 class="timeline-header"><a href="#">'+response[i].full_name+'</a> commented on this Huddle Up.</h3><div class="timeline-body">'+response[i].text+'</div><div class="timeline-footer"><a class="btn btn-warning btn-sm">View comment</a></div></div></div>');

}




  }



});
}

  
    // Summernote
  //  $('.textarea').summernote()
  })
</script>


</body>
</html>

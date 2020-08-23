<?php
session_start();
error_reporting("E_ALL");

//pOp123456P


$_SESSION["user_id"] = 1;

include("./system/config.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql3= "SELECT * from user_profile where user_id=".$_SESSION["user_id"];

$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {

while($row3 = $result3->fetch_assoc()) 
{


$fn = $row3["full_name"];

}

}



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HuddleUpTeam</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
.swal2-container {
  z-index: 20;
}
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
       
          <h4 class="modal-title">Join a Team</h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
   
          <div class="form-group">
  <label for="usr">Key:</label>
  <input type="text" class="form-control" id="keyident">
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="joinTeam()">Join</button>
        </div>
      </div>
    </div>
  </div>


<?php include("navbar.php");?>

<?php include("sidebar.php");?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

               <div class="row">
                      <div class="col-12 d-flex justify-content-end" data-toggle="modal" data-target="#myModal">
          
             <p align-text="right"><a href="#" class="btn btn-sm btn-success">
                     JOIN A TEAM
                  </a></p>
              </div>
            
              
           
               </div>
        <div class="row">
          
<?php


$my_teams = array();
$huddleup_posts = array();


$sql = "SELECT * from team_members where user_id='".$_SESSION["user_id"]."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  

  while($row = $result->fetch_assoc()) 
{

$sql1 = "SELECT * from teams where id='".$row["team_id"]."'";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {

    while($row1 = $result1->fetch_assoc()) 
      { 

array_push($my_teams,array("team_name"=>$row1["team_name"],"id"=>$row1["id"]));
        
  }

}
}
} 

else {
  echo "0 results";
}


foreach($my_teams as $team){

$hups = array();

$sql2 = "SELECT * from huddleup_posts where team_id=".$team["id"];

$result2 = $conn->query($sql2);

$fn = "";
$d = "";

if ($result2->num_rows > 0) {

while($row2 = $result2->fetch_assoc()) 
{

$d = $row2["description"];

$sql3= "SELECT * from user_profile where user_id=".$row2["op_user_id"];

$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {

while($row3 = $result3->fetch_assoc()) 
{


$fn = $row3["full_name"];

}

}


array_push($hups,array("full_name"=>$fn,"description"=>$d,"id"=>$row2["id"]));


}

}

?>
 

          <div class="col-lg-3 col-6 team-card" id="<?php echo $team["id"];?>">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $team["team_name"];?></h3>

                <p></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">
                <!--<i class="fas fa-arrow-circle-right"></i>--></a>
            </div>
          </div>

          <?php

array_push($huddleup_posts,array("team"=>$team["team_name"],"posts"=>$hups));

            }
          ?>


          
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- /.col -->

<?php


foreach($huddleup_posts as $hp_team){

?>

<div class="col-md-3">

<?php

foreach($hp_team["posts"] as $hp){

  ?>
            <div class="row">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="dist/img/user1-128x128.jpg" alt="User Image">
                  <span class="username"><a href="#"><?php echo $hp["full_name"];?></a></span>
                  <span class="description">Shared publicly - 7:30 PM Today</span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Mark as read">
                    <i class="far fa-circle"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- post text -->
                <p><?php echo $hp["description"];?></p>

                <!-- Attachment -->  <!-- 
                <div class="attachment-block clearfix">
                  <img class="attachment-img" src="dist/img/photo1.png" alt="Attachment Image">

                  <div class="attachment-pushed">
                 <h4 class="attachment-heading"><a href="#">Lorem ipsum text generator</a></h4>


                  </div>

                
                </div>  -->


                <!-- /.attachment-block -->

                <!-- Social sharing buttons -->
                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
                <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                <span class="float-right text-muted">45 likes - 2 comments</span>
              </div>


              <!-- /.card-body -->
              <div class="card-footer card-comments" id="post_<?php echo $hp["id"];?>">
               
               <?php for($i=0; $i<5;  $i++){?>
              
               

              <?php }?>

                <!-- /.card-comment -->
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
              
                  <img class="img-fluid img-circle img-sm" src="dist/img/user4-128x128.jpg" alt="Alt Text">
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <input type="text" id="text_<?php echo $hp["id"];?>"  class="text_message form-control form-control-sm" placeholder="Press enter to post comment">
                  </div>
            
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->



          </div>
        <?php }?>

          </div>
   <?php }?>

        </div>


        <div class="row" >
         
        <?php 


        foreach($my_teams as $team){ 


            ?>

        <div class="col-md-3">

            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-exclamation-triangle"></i>
                  Alerts
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">


            <?php 


          $sql3= "SELECT * from huddleup_alerts where team_id=".$team["id"];

          $result3 = $conn->query($sql3);

            if ($result3->num_rows > 0) {
           
            while($row3 = $result3->fetch_assoc()) 
            {


          

            ?>

                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                <?php echo $row3["description"];?>
                </div>


                <!--
                <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-info"></i> Alert!</h5>
                  Info alert preview. This alert is dismissable.
                </div>
                <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                  Warning alert preview. This alert is dismissable.
                </div>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Success alert preview. This alert is dismissable.
                </div>-->



            <?php   

                }

                }
              ?>


              </div>
            
            </div>

          </div>
        <?php }


$conn->close();

        ?>

        



          <!-- /.col -->
        </div>



        <div class="row">

         <div class="col-md-3">



            <div class="row">

            <!-- Line chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Line Chart
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="line-chart" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
        </div>


        <!--
          <div class="row">
          
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Bar Chart
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="bar-chart" style="height: 300px;"></div>
              </div>
             
            </div>
         
              </div>



          
          <div class="row">
             

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                    Area Chart
                  </h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div id="area-chart" style="height: 338px;" class="full-width-chart"></div>
                </div>
            
              </div>



          </div>




          <div class="row">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Donut Chart
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="donut-chart" style="height: 300px;"></div>
              </div>
           
            </div>
       
          </div>
   -->

          </div>


       
        </div>



        <div class="row" style="margin-left:10%;">

          <div class="col-12 col-sm-6 col-md-4  align-items-stretch">
            <div class="card bg-light">
              <div class="card-header text-center border-bottom-0">
             <a href="#" class="btn btn-sm btn-success">
                      CREATE A NEW TEAM
                  </a>
              </div>
            
              
            </div>
          </div>

 <div class="col-12 col-sm-6 col-md-4  align-items-stretch">
            <div class="card bg-light">
              <div class="card-header text-center border-bottom-0">
             <a href="#" class="btn btn-sm btn-success">
                      JOIN A TEAM
                  </a>
              </div>
            
              
            </div>
          </div>




        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="#">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- FLOT CHARTS -->
<script src="plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot-old/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="plugins/flot-old/jquery.flot.pie.min.js"></script>
<!-- Page script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>

  $(".team-card").click(function (e){
   window.location = "team.php?id="+$(this).attr("id");
  });

$(".text_message").keydown(function (e){


if(e.keyCode==13){

var the_id = $(this).attr("id").split("_")[1];

var settings = {
  "url": "system/addcomment.php",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded",
    "Authorization": "Bearer "+localStorage.token
  },
  "data":{"id":the_id,"text":$(this).val()}
  
};

$(this).val("");

$.ajax(settings).done(function (response) {

  var response = JSON.parse(response);
 $("#post_"+the_id).html("");

  for(var i=0; i<response.length; i++){
 
      $("#post_"+the_id).append('<div class="card-comment"><img class="img-circle img-sm" src="dist/img/user3-128x128.jpg" alt="User Image"><div class="comment-text"><span class="username">'+response[i].full_name+'<span class="text-muted float-right">8:03 PM Today</span></span>'+response[i].text+'</div></div>');

  }



});


}

});


function joinTeam(){
  var settings = {
  "url": "system/jointeam.php",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded",
    "Authorization": "Bearer "+localStorage.token
  },
  "data":{"keyident":$("#keyident").val()}
};


$.ajax(settings).done(function (response) {

if(response.message=="Invalid"){
Swal.fire(
  'Team does not exist!',
  '',
  'warning'
);
}

if(response.message=="success"){
  Swal.fire(
  'You joined the team',
  '',
  'success'
);
}


if(response.message=="already"){
    Swal.fire(
  'You are already a member of this team.',
  '',
  'success'
);
}
$(".swal2-contonair").css("z-index",20);

});
}

$(function () {
    

<?php

include("checker.php");





$ttt = "";

foreach($my_teams as $team){

$ttt .= $team["id"].",";
}

$ttt = rtrim($ttt, ",");

echo "var ids=[".$ttt."];"
  ?>


for( var h=0; h<ids.length; h++){


var settings = {
  "url": "system/addcomment.php",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded",
    "Authorization": "Bearer "+localStorage.token
  },

  "data":{"id":ids[h]}
  
};


$.ajax(settings).done(function (response) {

  var response = JSON.parse(response);

  
  for(var i=0; i<response.length; i++){

    var t = "#post_"+ids[h];

        $(t).append('<div class="card-comment"><img class="img-circle img-sm" src="dist/img/user3-128x128.jpg" alt="User Image"><div class="comment-text"><span class="username">'+response[i].full_name+'<span class="text-muted float-right">8:03 PM Today</span></span>'+response[i].text+'</div></div>');

  }



});

}

    /*
     * LINE CHART
     * ----------
     */
    //LINE randomly generated data

    var sin = [],
        cos = []
    for (var i = 0; i < 14; i += 0.5) {
      sin.push([i, Math.sin(i)])
      cos.push([i, Math.cos(i)])
    }
    var line_data1 = {
      data : sin,
      color: '#3c8dbc'
    }
    var line_data2 = {
      data : cos,
      color: '#00c0ef'
    }
    $.plot('#line-chart', [line_data1, line_data2], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#3c8dbc', '#f56954']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2)

        $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
          .css({
            top : item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip').hide()
      }

    })
    /* END LINE CHART */

    /*
     * BAR CHART
     * ---------
     */

     var bar_data = {
      data : [[1,10], [2,8], [3,4], [4,13], [5,17], [6,9]],
      bars: { show: true }
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
         bars: {
          show: true, barWidth: 0.5, align: 'center',
        },
      },
      colors: ['#3c8dbc'],
      xaxis : {
        ticks: [[1,'January'], [2,'February'], [3,'March'], [4,'April'], [5,'May'], [6,'June']]
      }
    })
    /* END BAR CHART */

    /* FULL WIDTH STATIC AREA CHART
     * -----------------
     */
    var areaData = [[2, 88.0], [3, 93.3], [4, 102.0], [5, 108.5], [6, 115.7], [7, 115.6],
      [8, 124.6], [9, 130.3], [10, 134.3], [11, 141.4], [12, 146.5], [13, 151.7], [14, 159.9],
      [15, 165.4], [16, 167.8], [17, 168.7], [18, 169.5], [19, 168.0]]
    $.plot('#area-chart', [areaData], {
      grid  : {
        borderWidth: 0
      },
      series: {
        shadowSize: 0, // Drawing is faster without shadows
        color     : '#00c0ef',
        lines : {
          fill: true //Converts the line chart to area chart
        },
      },
      yaxis : {
        show: false
      },
      xaxis : {
        show: false
      }
    })

    /* END AREA CHART */

    /*
     * DONUT CHART
     * -----------
     */

     var donutData = [
      {
        label: 'Series2',
        data : 30,
        color: '#3c8dbc'
      },
      {
        label: 'Series3',
        data : 20,
        color: '#0073b7'
      },
      {
        label: 'Series4',
        data : 50,
        color: '#00c0ef'
      }
    ]
    $.plot('#donut-chart', donutData, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.5,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    })
    /*
     * END DONUT CHART
     */
    
  })
  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }
</script>
</body>
</html>

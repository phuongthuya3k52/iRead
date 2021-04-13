<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    List Stories | Admin | iRead
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="./assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
<!--  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/bootstrap.min.js"></script> -->
  <script src="./js/jquery-1.12.4.js"></script>
<script src="../js/chosen.jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/csrf.js"></script>
</head>

<?php
  require_once("../db.php");
    session_start();


    if(!isset($_SESSION['username'])){
?>
      <script >
      alert ("You must login to access this page!");
      window.location.replace("./login.php");
    </script>
<?php
  }else if($_SESSION['role'] != "admin"){
?>
      <script >
      alert ("You do not have permission to access this page!");
      window.location.replace("../home.php");
    </script>
<?php    
  }else{
    $sql = "SELECT * FROM story ";
    $row = query($sql);
    $total = count($row);

  }
?>

<body>
  <?php 
    require_once("./left.php");
  ?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php 
        require_once("./header.php");
      ?>
      <!-- End Navbar -->

      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h3 class="card-title ">Total Stories: <?=$total?></h3>
                  <p class="card-category"> The information sheet below shows the list of stories in order from the latest story to older one.</p>  
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          No.
                        </th>
                        <th>
                          Title
                        </th>
                        <th>
                          Category
                        </th>
                        <th>
                          Chapters
                        </th>
                        <th>
                          Votes
                        </th>
                        <th>
                          Views
                        </th>
                        <th>
                          Member
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                        <?php 
                        // Pagination
                
                          $allrow = $total;
                          $pagesize = 10;
                          $allpage = 1;

                          //Calculate how many pages there are all 
                          if($allrow % $pagesize == 0){
                            $allpage = $allrow / $pagesize;
                          }else{
                            $allpage = (int)($allrow / $pagesize) + 1;
                          }

                          $beginrow = 1;
                          $currentpage = 1;

                          // If the current page is page 1, then select from the first row

                          if((!isset($_GET['currentpage'])) || ($_GET['currentpage'] == '1'))
                          {
                            $beginrow = 0;
                            $currentpage = 1;
                          }else{
                          // Select the starting row and get current page
                            $beginrow = ($_GET['currentpage'] - 1) * $pagesize;
                            $currentpage = $_GET['currentpage'];
                          }

                          $sql1= "SELECT * FROM story ORDER BY storyID DESC LIMIT {$beginrow} , {$pagesize}";

                          $row1=query($sql1);  

                          for($i=0; $i < count($row1); $i++)
                          {
                            $storyID = $row1[$i][0];
                            $storyName = decryptString($row1[$i][1]);
                            $storyImage = $row1[$i][4];
                            $viewNumber = $row1[$i][5];
                            $voteNumber = $row1[$i][6];
                            $memberID = $row1[$i][2];
              ?>  
                        <tr>
                          <td><?=$i+1?>
                          </td>
                          <td>
                            <?=$storyName?>
                          </td>
                          <td>
                          <?php
                            $sql2 = "Select * from category INNER JOIN story_category ON category.categoryID = story_category.categoryID WHERE storyID='" .$storyID . "'";

                              $row2 = query($sql2);

                              for ($j=0; $j < count($row2);$j++)
                              {
                          ?>
                            <span class="list-category" style="font-size: 14px; text-align: justify;">
                              <span><a href="./storybycat.php?categoryID=<?=$row2[$j][0]?>"><?=$row2[$j][1]?></a></span>,
                            </span>
                          <?php
                            }
                          ?>
                          </td>
                          <td>
                            <?php
                              $sql3 = "SELECT * FROM chapter WHERE storyID='" .$storyID . "'";
                              $row3 = query($sql3);

                              echo('<a href="./chapterlist.php?storyID='.$storyID.'" >'.count($row3).'</a>');
                            ?>
                          </td>
                          <td>
                            <?=$voteNumber?>
                          </td>
                          <td>
                            <?=$viewNumber?>
                          </td>
                          <td>
                            <?php
                              $sql4 = "SELECT * FROM member WHERE memberID='" .$memberID . "'";
                              $row4 = query($sql4);
                              $memname = $row4[0][1];
                              echo($memname);
                            ?>
                          </td>

                          <td class="text-primary">
                            <a href="#delete_confirm<?=$storyID?>" name="btn_delete" id="btn_delete<?=$storyID?>"data-toggle="modal"><i class="material-icons">&#xE872;</i></a>
                          </td>
                          <!-- Delete confirm modal -->
                          <script type="text/javascript" src="../js/bootstrap-modalmanager.js"></script>
                          <script type="text/javascript" src="../js/bootstrap-modal.js"></script>                         
                          
                          
                          <div class="modal" id="delete_confirm<?=$storyID?>" role="dialog">
                            <div  class="modal-dialog" role="document">
                            <form id="delete_form" class="form" method="GET" action="delete.php">
                              <div class="modal-header">
                                <h2>Delete Story</h2> 
                                <button type="button" class="close" data-dismiss="modal" >
                                  <span aria-hidden="true" style="color: #FF4444; font-size: 44px; font-weight: bold; float: right;cursor:pointer;">&times;</span>
                                </button>                                    
                            </div>
                            <div class="modal-body" style="text-align: center; margin-top:0px">

                             
                              <h3>Are you sure to Delete this story?</h3>
                              <img style="width: 150px; height: 200px;" src="../img/<?=$storyImage?>">
                              <h5><?=$storyName?></h5>
                              <input type="hidden" name="story_id" value="<?=$storyID?>">                  

                              <button type="submit" name="cf_del_story" class="btn btn-primary" onclick="form_sunmit()">Yes</button>&emsp;&emsp;                              
                  
                              <button class="btn" type="button"  data-dismiss="modal" aria-hidden="true">Cancle</button>
                            </div>
                          </form>
                          </div>
                          </div>
                          <script type="text/javascript">
  function form_submit() {
    document.getElementById("delete_form").submit();
   }    
  </script>
                          
                        </tr>
                        <?php
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div>
                  
                </div>
                
              </div>
              <div class=" col-md-12 paging">
                <div class=" pagination pagination-centered" >
                    <ul style="text-align: center; width: 100%; margin-right: 100px;">
                      <li class="disable"><a href="#">Pages</a></li>   
                      <?php
                      // Link pagination
                        for($i = 1; $i <= $allpage; $i++)
                        {
                          if($currentpage == $i){
                        ?>
                            <li class="active"><a href="#"><?=$i?></a></li> 
                        <?php
                          }else{
                        ?>
                            <li class="disable"><a href="storylist.php?currentpage=<?=$i?>"><?php echo $i ." "; ?></a></li>
                        <?php
                          }
                        }
                      ?>
                      <li class="disable"><a href="#">Pages</a></li>
                    </ul>
                </div>
              </div>
                            
          <!--  <script>
                function deleteRow(r) {
                var i = r.parentNode.parentNode.rowIndex;
                document.getElementById("delete").deleteRow(i);
                }
            </script>  -->
            <div class= "col-md-12">    
              <?php require_once("./footer.php");?>
            </div>
          </div>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="./assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="./assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="./assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="./assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="./assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="./assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="./assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="./assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="./assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="./assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="./assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="./assets/js/plugins/arrive.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="./assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="./assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
</body>

</html>
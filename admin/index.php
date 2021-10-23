<?php include "includes/admin_header.php" ?>

    <div id="wrapper">


        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">



            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                       
                        
                    </div>
                </div>
                <!-- /.row -->

                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <!-- php code -->
                        <?php
                        
                            $query = "SELECT * FROM posts";
                            $select_all_posts = mysqli_query($conn,$query);
                            $post_counts = mysqli_num_rows($select_all_posts);

                            echo "<div class='huge'>{$post_counts}</div>";

                        
                        ?>

                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <!-- counting comments -->
                        <?php
                        
                            $query = "SELECT * FROM comments";
                            $select_all_comments = mysqli_query($conn,$query);
                            $comments_count = mysqli_num_rows($select_all_comments);
                            
                            echo "<div class='huge'>{$comments_count}</div>";

                        ?>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <!-- counting users -->
                    <?php
                        
                        $query = "SELECT * FROM users";
                        $select_all_user = mysqli_query($conn,$query);
                        $user_count = mysqli_num_rows($select_all_user);
                        
                        echo "<div class='huge'>{$user_count}</div>";

                    ?>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <!-- category count -->
                    <?php
                        
                        $query = "SELECT * FROM categories";
                        $select_all_category = mysqli_query($conn,$query);
                        $category_count = mysqli_num_rows($select_all_category);
                        
                        echo "<div class='huge'>{$category_count}</div>";

                    ?>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->

<?php

// query to get all posts which is in draft to add them in chart
$query = "SELECT * FROM posts WHERE post_status = 'published'";
$select_all_published_posts = mysqli_query($conn,$query);
$post_published_counts = mysqli_num_rows($select_all_published_posts);


// query to get all posts which is in draft to add them in chart
$query = "SELECT * FROM posts WHERE post_status = 'draft'";
$select_all_draft_posts = mysqli_query($conn,$query);
$post_draft_counts = mysqli_num_rows($select_all_draft_posts);

// query to get all commets which is in draft to add them in chart
$query = "SELECT * FROM comments WHERE comment_status = 'unaprroved'";
$unapproved_comments_query = mysqli_query($conn,$query);
$unapproved_counts = mysqli_num_rows($unapproved_comments_query);

// query to get all users which is in draft to add them in chart
$query = "SELECT * FROM users WHERE user_role = 'subscriber'";
$subscriber_count_query = mysqli_query($conn,$query);
$subscriber_count = mysqli_num_rows($subscriber_count_query);

?>

<!-- This is chart  -->
<div class="row">

<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],

        // Php to Display on chart   
        <?php
        // Creating array to store array 
        
            $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
            $element_count = [$post_counts,$post_published_counts, $post_draft_counts, $comments_count,$unapproved_counts, $user_count, $subscriber_count, $category_count];
            
            for($i = 0; $i<8; $i++){
                // Following is dynamic data fetching from database
                //   ['Posts', 1000],
                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
            }
        
        ?>

          
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>

<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

</div>
<!-- Chart End -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>


<!-- 5 videos done in dashboard -->
<?php
// including database connection.
include 'includes/db.php';

// including header file.
include 'includes/header.php';

// including navigation.
include 'includes/navigation.php';

?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];
                $the_post_author = $_GET['author'];
            }

            $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
            // executing query.
            $select_all_post_query = mysqli_query($conn, $query);

            // fetching query with assoc function, it will return an assosiative array.
            while ($row = mysqli_fetch_assoc($select_all_post_query)) {
                // storing titles of posts to variable.
                $post_title = $row['post_title'];

                // creating variable to store data from db.
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

                // ending php.    
            ?>

                <!-- html code to dynamic post -->
                <!-- we did this to show html. -->
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    All posts by <?php echo $post_author ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <!-- Now we are getting image name from db and place it in image tag. -->
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>


                <!-- re opening php and closing it for {} curly brases. -->
            <?php   }  ?>



            <!-- Blog Comments -->




        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'; ?>


    </div>
    <!-- /.row -->

    <hr>

    <?php

    // including footer.
    include 'includes/footer.php';

    ?>
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

            $query = "SELECT * FROM posts";
            // executing query.
            $select_all_post_query = mysqli_query($conn, $query);

            // fetching query with assoc function, it will return an assosiative array.
            while ($row = mysqli_fetch_assoc($select_all_post_query)) {
                // storing titles of posts to variable.
                $post_title = $row['post_title'];

                // creating variable to store data from db.
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                // truncating means seting paragraph to see only 100 characters in index.php so user needs to click on read more.
                $post_content = substr($row['post_content'], 0, 100);

                $post_status = $row['post_status'];

                if ($post_status == 'published'){

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
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <hr>
                    <!-- Now we are getting image name from db and place it in image tag. -->
                    <a href="post.php?p_id=<?php echo $post_id; ?>">
                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    </a>
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>


                    <!-- re opening php and closing it for {} curly brases. -->
            <?php }
            }  ?>





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
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

                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id ";
                $send_query = mysqli_query($conn, $view_query);
                

            

            $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
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
                

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <!-- Now we are getting image name from db and place it in image tag. -->
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>


                <!-- re opening php and closing it for {} curly brases. -->
            <?php }  
        
        }else{
            header("Location: index.php");
        }
        
        ?>



            <!-- Blog Comments -->


            <?php

            if (isset($_POST['create_comment'])) {

                $the_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){

                    // creating comment to insert in table

                    

                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";

                    $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unaproved', now())";

                    $create_comment_query = mysqli_query($conn, $query);
                    if (!$create_comment_query) {
                        die('Query failed' . mysqli_error($conn));
                    }

                    // Increamenting comment count value when anyone makes comment
                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                    $query .= "WHERE post_id = $the_post_id ";
                    $update_comment_count = mysqli_query($conn, $query);
                }else{
                    echo "<script>alert('Comment field cannot be empty')</script>";
                }

            }



                

            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">

                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>

                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>

                    <div class="form-group">
                        <label for="Comment">Comment</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php
            // to display comments form database to post

            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
            $query .= "AND comment_status = 'approved' ";
            // here we are getting new comments on top by setting it to descending order
            $query .= "ORDER BY comment_id DESC ";
            $select_comment_query = mysqli_query($conn, $query);
            if (!$select_comment_query) {
                die("QUERY FAILED" . mysqli_error($conn));
            }
            while ($row = mysqli_fetch_array($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
                // breaking loop to add html
            ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>



            <?php } ?>



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
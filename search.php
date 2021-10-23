<!-- this file is same as index.php we are copy paste here all file and now we are changing it. -->
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



                    // getting search value from search bar .
                    if(isset($_POST['submit'])){
                        $search = $_POST['search'];

                        // query to select all posts from db where search is like.
                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";

                        // executing query.
                        $search_query = mysqli_query($conn, $query);

                        // If query failed.
                        if(!$search_query){
                            die("Query failed". mysqli_error($conn));
                        }

                        // checking rows from db.
                        $count = mysqli_num_rows($search_query);

                        // displaying data.
                        if($count == 0){
                            echo "<h1> no result </h1>";
                        }else{
                            

                    // fetching query with assoc function, it will return an assosiative array.
                    while($row = mysqli_fetch_assoc($search_query)){
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
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                        <hr>
                        <!-- Now we are getting image name from db and place it in image tag. -->
                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                        <hr>
                        <p><?php echo $post_contentz ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

                           
                        <!-- re opening php and closing it for {} curly brases. -->
        <?php   }  
                        }
                    }
                    ?>


               

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
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

            // Catching get request of pagination 
            // per page how many posts
            $per_page = 10;
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = "";
            }

            // if page is 1 or empty then its homepage
            if($page == "" || $page == 1){
                $page_1 = 0;
            }else{
                $page_1 = ($page * $per_page) - $per_page;
            }

            // Creating count variable for paginations
            $post_query_count = "SELECT * FROM posts";
            $find_count = mysqli_query($conn, $post_query_count);
            $count = mysqli_num_rows($find_count);
            
            // ceil fuctions is in math library 
            // this will round up result in int like: if 4.6 -> $per_page and if 6.3 -> 6
            $count = ceil($count / $per_page);





            $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
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

    <!-- pagination ul -->
    <ul class="pager">

    <?php
        // Creating a links dynamic and sending get request
        for($i = 1; $i<=$count; $i++){
            // to know we are on which page we are adding class active
            if($i == $page){
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            }else{
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }
    
    ?>

    </ul>

    <?php

    // including footer.
    include 'includes/footer.php';

    ?>
<?php

if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
}


$query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
// query to select all from posts, is executed.
$select_posts_by_id = mysqli_query($conn, $query);


// fetching query with assoc function, it will return an assosiative array.
while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    // storing id, titles of posts to variable.
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
}

// Now geting form data.
if (isset($_POST['update_post'])) {
    $post_title = $_POST['title'];
    $post_category = $_POST['post_category'];
    $post_author = $_POST['author'];
    $post_status = $_POST['post_status'];
    // getting image name by FILES superglobal var.
    $post_image = $_FILES['image']['name'];
    // getting image temp location where file is saved on server.
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];


    // inbuilt function, to upload file from temp location to our location.
    move_uploaded_file($post_image_temp, "../images/$post_image");

    // checking if image is not empty.
    // we are getting image name from db. to avoid update image problem.
    if (empty($post_image)) {
        //  if it is empty select it from posts.
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['post_image'];
        }
    }

    // update query.
    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category}', ";
    $query .= "post_date = now(),";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$the_post_id} ";

    $update_query = mysqli_query($conn, $query);
    confirmQuery($update_query);
    echo "<p class='bg-success'>Post Updated! <a href='../post.php?p_id={$the_post_id}'>View Post</a> Or <a href='posts.php'>Edit More Posts</a></p>";
}



?>




<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">posts title</label>
        <input type="text" value="<?php echo $post_title; ?>" value="" class="form-control" name="title">
    </div>

    <div class="form-group">
        <select name="post_category" id="post_category">
            <?php

            $query = "SELECT * FROM categories";
            // query to select all from catagories, is executed.
            $select_categories = mysqli_query($conn, $query);
            confirmQuery($select_categories);
            // fetching query with assoc function, it will return an assosiative array.
            while ($row = mysqli_fetch_assoc($select_categories)) {
                // storing id, titles of category to variable.
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo " <option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>

        </select>

    </div>

    <div class="form-group">
        <label for="title">posts author</label>
        <input type="text" value="<?php echo $post_author; ?>" class="form-control" name="author">
    </div>


    <div class="form-group">
    
    <select name="post_status" id="">
        <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>

        <?php
        
        if($post_status == 'published'){
            echo " <option value='draft'>Draft</option>";

        }else{
            echo " <option value='published'>Publish</option>";
        }
        
        ?>

    </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_status">posts status</label>
        <input type="text" value="<//?php echo $post_status; ?>" class="form-control" name="post_status">
    </div> -->

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">posts tags</label>
        <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">posts content</label>
        <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?>
        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Update Post" name="update_post">
    </div>
</form>
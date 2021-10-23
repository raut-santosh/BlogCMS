<?php

if (isset($_POST['create_post'])) {
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id =  $_POST['post_category'];
    $post_status = $_POST['post_status'];

    // this is to get name and temprory location of file saved in temprory location on server.
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    // php built in function, 
    // This will store that file in images folder.
    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";

    // Concatinating .
    // now() is the php function to format date which will format data and send to database so it looks nice in database also.
    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";

    $create_post_query = mysqli_query($conn, $query);

    confirmQuery($create_post_query);

    echo "<p class='bg-success'>Post Inserted! <a href='../index.php'>View Posts</a> Or <a href='posts.php'>Edit Posts</a></p>";
}

?>



<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">posts title</label>
        <input type="text" class="form-control" name="title">
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
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">

        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>

        </select>

    </div>

    <!-- <div class="form-group">
        <label for="post_image">posts image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="post_image">posts image</label>
        <input type="file" name="image" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
    </div>




    <div class="form-group">
        <label for="post_tags">posts tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">posts content</label>
        <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>        
    </div>
    

    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Publish Post" name="create_post">
    </div>
</form>
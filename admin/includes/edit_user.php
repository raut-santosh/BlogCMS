<?php


if(isset($_GET['edit_user'])){
    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    // query to select all from users, is executed.
    $select_users_query = mysqli_query($conn, $query);
    // fetching query with assoc function, it will return an assosiative array.
    while ($row = mysqli_fetch_assoc($select_users_query)) {
        // storing id, titles of users to variable.
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }



}


if (isset($_POST['edit_user'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname =  $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    // this is to get name and temprory location of file saved in temprory location on server.
    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // php built in function, 
    // This will store that file in images folder.
    // move_uploaded_file($post_image_temp, "../images/$post_image");

    // Encrypt password code
    $query = "SELECT randSalt FROM users";
    $select_randsalt_query = mysqli_query($conn, $query);
    if(!$select_randsalt_query){
        die("Query failed ". mysqli_error($conn));
    }
    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randSalt'];
    // Encrypting password;
    $hashed_password = crypt($user_password, $salt);




    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "user_password = '{$hashed_password}', ";
    $query .= "user_firstname = '{$user_firstname}',";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_image = '{$user_image}' ";
    // $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE user_id = {$the_user_id} ";

    $edit_user_query = mysqli_query($conn, $query);
}

?>



<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Last Name</label>
        <input type="text" value="<?php echo $user_lastname;?>" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <select name="user_role" id="post_category">
           <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
           <?php
           
            if($user_role == 'admin'){
                echo "<option value='subscriber'>subscriber</option>";
            }else{
                echo "<option value='admin'>admin</option>";
            }
           
           ?>
           
           

        </select>

    </div>




<!--     
    <div class="form-group">
        <label for="post_image">posts image</label>
        <input type="file" name="image" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
    </div> -->




    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" value="<?php echo $username;?>" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" value="<?php echo $user_email;?>" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" value="<?php echo $user_password;?>" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Update User" name="edit_user">
    </div>
</form>
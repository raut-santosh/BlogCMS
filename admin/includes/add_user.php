<?php

if (isset($_POST['create_user'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname =  $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    // this is to get name and temprory location of file saved in temprory location on server.
    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // Encrypting password
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));




    // php built in function, 
    // This will store that file in images folder.
    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO users(user_firstname,user_lastname,user_role,username,user_email,user_password) ";

    // Concatinating .
    // now() is the php function to format date which will format data and send to database so it looks nice in database also.
    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}') ";

    $create_user_query = mysqli_query($conn, $query);

    confirmQuery($create_user_query);

    // displaying that user is created

    echo "User Created: " . " " . "<a href='users.php'>View Users</a>";

}

?>



<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <select name="user_role" id="post_category">
           <option value="subscriber">Select Options</option>
           <option value="admin">Admin</option>
           <option value="subscriber">Subscriber</option>

        </select>

    </div>




<!--     
    <div class="form-group">
        <label for="post_image">posts image</label>
        <input type="file" name="image" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
    </div> -->




    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Add User" name="create_user">
    </div>
</form>
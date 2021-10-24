<?php
    
function users_online(){

    if(isset($_GET['onlineusers'])){

        global $conn;

        if(!$conn){
            session_start();
            include("../includes/db.php");
             // inbuilt function which will catch id
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session' ";
            $send_query = mysqli_query($conn, $query);
            $count = mysqli_num_rows($send_query);

            // if user is new then insert 
            if($count == NULL){
                mysqli_query($conn, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
            }else{
                // if user is already have data
                mysqli_query($conn, "UPDATE users_online SET time = '$time' WHERE session = '$session'");

            }
            $users_online_query = mysqli_query($conn, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $count_user = mysqli_num_rows($users_online_query);

        }

       

} //get request isset()
}
users_online();

function confirmQuery($result){
    global $conn;
    if(!$result){
        die("query failed  ". mysqli_error($conn));
    }
    
}


function insert_categories(){
    // global $conn variable.
    global $conn;
     // checking input from cat_box.
 if(isset($_POST['submit'])){
    $cat_title = $_POST['cat_title'];
    // validating data.
    if($cat_title == "" || empty($cat_title)){
        echo "This field should not be empty";
    }else{
        // inserting data into cat table.
        $query = "INSERT INTO categories(cat_title)";
        $query .= "VALUES('{$cat_title}') ";
        // sending query to db.
        $creat_category_query = mysqli_query($conn, $query);
        // checking query is succesful or not.
        if(!$creat_category_query){
            die("QUERY FAILED". mysqli_error($conn));
        }
    }
}

}



function findAllCategories(){
    global $conn;

    $query = "SELECT * FROM categories";
    // query to select all from catagories, is executed.
    $select_categories = mysqli_query($conn, $query);


    // fetching query with assoc function, it will return an assosiative array.
    while($row = mysqli_fetch_assoc($select_categories)){
    // storing id, titles of category to variable.
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
                
    // creating tr and td .
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    // This will put categories.php?delete=3 where 3 is the id of that row in browser, it is setting delete to cat_id.
    // delete=$cat_id is key
    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";
                
    }
}


function deleteCategories(){
    global $conn;
    // This is to get the key of that row.
    // Because get can access data from searchbar.
    if(isset($_GET['delete'])){
    // alias for cat_id.
    $the_cat_id = $_GET['delete'];
    // query to delete that row from category table.
    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
    $delete_query = mysqli_query($conn, $query);
    // When we click on delete btn it is sending the id to browser and thats why we need to double click on it.
    // So this is to solve that problem.
    // We will refresh the page.
    header("Location: categories.php");
    }
}




?>
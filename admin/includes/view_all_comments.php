<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapproved</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $query = "SELECT * FROM comments";
        // query to select all from posts, is executed.
        $select_comments = mysqli_query($conn, $query);


        // fetching query with assoc function, it will return an assosiative array.
        while ($row = mysqli_fetch_assoc($select_comments)) {
            // storing id, titles of posts to variable.
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];


            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";

            // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
            // // query to select all from catagories, is executed.
            // $select_categories_id = mysqli_query($conn, $query);
            // // fetching query with assoc function, it will return an assosiative array.
            // while($row = mysqli_fetch_assoc($select_categories_id)){
            // // storing id, titles of category to variable.
            // $cat_id = $row['cat_id'];
            // $cat_title = $row['cat_title'];


            // echo "<td>{$cat_title}</td>";

            // }


            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";

            // To get post name in referance to so we can go to that post from admin page
            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $select_post_id_query = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            }


            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?approve=$comment_id'>Approved</a></td>";
            echo "<td><a href='comments.php?unaprroved=$comment_id'>Unapproved</a></td>";
            // we are sending delete post id to GET.
            // here edit_post&p_id is to dividing a parameters so we can send multi. parameters to GET.
            echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
            echo "</tr>";
        }

        ?>


    </tbody>
</table>

<?php

// to unaprove comments
if (isset($_GET['unaprroved'])) {
    $the_comment_id = $_GET['unaprroved'];
    $query = "UPDATE comments SET comment_status = 'unaprroved' WHERE comment_id = $the_comment_id ";
    $unaprroved_comment_query = mysqli_query($conn, $query);
    confirmQuery($unaprroved_comment_query);
    header("Location: comments.php");
}

// to aprrove comments
if (isset($_GET['approve'])) {
    $the_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
    $approve_comment_query = mysqli_query($conn, $query);
    confirmQuery($approve_comment_query);
    header("Location: comments.php");
}


// to delete comment from admin side
if (isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
    $delete_query = mysqli_query($conn, $query);
    confirmQuery($delete_query);
    header("Location: comments.php");
}

?>
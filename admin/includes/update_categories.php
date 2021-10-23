<form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Edit Category</label>
                                    <?php
                                        if(isset($_GET['edit'])){
                                            $cat_id = $_GET['edit'];

                                            $query = "SELECT * FROM categories WHERE cat_id = {$cat_id} ";
                                            // query to select all from catagories, is executed.
                                            $select_categories_id = mysqli_query($conn, $query);
                                            // fetching query with assoc function, it will return an assosiative array.
                                            while($row = mysqli_fetch_assoc($select_categories_id)){
                                            // storing id, titles of category to variable.
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            // Breaking loop so we can put some html.
                                        ?>
                                            <!-- when clicked on edit it will show. -->
                                            <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" class="form-control" type="text" name="cat_title"> 
                                            
                                <?php   } }  ?>

                                <?php
                                // Update query.
                                    if(isset($_POST['update_category'])){
                                        // alias for cat_title.
                                        $the_cat_title = $_POST['cat_title'];
                                        // query to delete that row from category table.
                                        $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id} ";
                                        $update_query = mysqli_query($conn, $query);
                                        if(!$update_query){
                                            die("QUERY FAILED". mysqli_error($conn));
                                        }
                                    }
                                    
                                
                                ?>




                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                                </div>
                            </form>
                        </div>
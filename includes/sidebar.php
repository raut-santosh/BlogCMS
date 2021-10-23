<!-- Blog sidebar widget Column. -->
<div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <!-- We are using from to get value of search field. -->
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- search form -->
                    </form>
                    <!-- /.input-group -->
                </div>


                <!-- Login -->
                <div class="well">
                    <h4>LogIn</h4>
                    <!-- We are using from to get value of search field. -->
                    <form action="includes/login.php" method="post">
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Username">
                        
                    </div>

                    <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="Password">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">
                                Login
                            </button>
                        </span>
                    </div>
                    <!-- login -->
                    </form>
                    <!-- /.input-group -->
                </div>



                <!-- Blog Categories Well -->

                <div class="well">
                    <?php
                    
                    $query = "SELECT * FROM categories";
                    // query to select all from catagories, is executed.
                    $select_categories_sidebar = mysqli_query($conn, $query);
    
                    
                    ?>

                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                
                                    // fetching query with assoc function, it will return an assosiative array.
                                    while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                                        // storing titles of category to variable.
                                        $cat_title = $row['cat_title'];
                                        $cat_id = $row['cat_id'];
                    
                                        // creating li because we used <ul> .
                                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    
                                    }
                                
                                ?>

                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>



                <!-- Side Widget Well -->
                <?php
                
                    include 'widget.php';
                
                ?>

            </div>
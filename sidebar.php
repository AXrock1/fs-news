<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->

    <!-- category box -->
    <div class="recent-post-container">
        <h4>Category</h4>
        <div class="recent-post">
            <div class="post-content ">
                <?php
                include "admin/config.php";
                if (isset($_REQUEST['cid'])) {
                    $cid = $_REQUEST['cid'];
                }

                $query =  "SELECT * FROM catagory WHERE catagory_post > 0 ";

                $result = mysqli_query($connection, $query) or die("catagories query failed.");

                if (mysqli_num_rows($result)) {

                    $active = "";
                ?>
                    <ul class='menu '>

                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            if (isset($_REQUEST['cid'])) {
                                if ($row['catagory_id'] == $cid) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                            }

                            echo "<li class='bg-primary'><a class='$active' href='category.php?cid={$row['catagory_id']}'>{$row['catagory_name']}</a></li>";
                        } ?>
                    </ul>

                <?php } ?>

            </div>
        </div>
    </div>
    <!-- category box end -->

    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>

        <?php

        include "admin/config.php";

        $limit = 4;

        $query2 = "SELECT post.post_id, post.post_title, post.post_image, post.post_date, post.post_catagory, catagory.catagory_name FROM post 
LEFT JOIN catagory ON post.post_catagory = catagory.catagory_id 
ORDER BY post.post_id DESC LIMIT {$limit} ";

        $result2 = mysqli_query($connection, $query2) or die("Recent Post Query Failed.");
        $count = mysqli_num_rows($result2);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($result2)) {

        ?>
                <div class="recent-post">
                    <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>">
                        <img src="admin/upload/<?php echo $row['post_image'] ?>" alt="" />
                    </a>

                    <div class="post-content">
                        <h5><a href="single.php?id=<?php echo $row['post_id'] ?>"><?php echo $row['post_title'] ?></a></h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php?cid=<?php echo $row['post_catagory'] ?>'><?php echo $row['catagory_name'] ?></a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $row['post_date'] ?>
                        </span>
                        <a class="read-more" href="single.php?id=<?php echo $row['post_id'] ?>">read more</a>
                    </div>
                </div>

        <?php }
        } ?>

    </div>
    <!-- /recent posts box -->
</div>
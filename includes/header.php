
<div class=nav>
    <h1 class="title">Everyday Music</h1>


    <?php
    // all icons: "https://www.s-ings.com/typicons/"
    $http_query_upload = http_build_query(array("upload" => "yes"));
    ?>
    <a href="index.php?<?php echo $http_query_upload; ?>">
        <img id="upload-button" src="images/upload.svg"></button>
    </a>


    <div class="search">
        <form id="search" action="index.php" method="get">

            <input type="text" id="tag" name="tag" placeholder="Search by tag..." value=<?php echo $tag; ?> >
            <button type="submit"><img id="search-button" src="images/search-icon.png"></button>

        </form>
    </div>

    <a href="index.php"><img id="home-button" src="images/home-icon.svg"></a>

</div>

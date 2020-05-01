
<div class=nav>
    <h1 class="title">Everyday Music</h1>

    <a href="upload.php"><img id="upload-button" class="<?php echo ($title=="Upload")? 'current' : 'upload-button' ?>" src="images/upload.svg"></a>

    <div class="search">
        <form id="search" action="index.php" method="get">

            <input type="text" id="tag" name="tag" placeholder="Search by tag..." />
            <button type="submit"><img id="search-button" src="images/search-icon.png"></button>

        </form>
    </div>

    <a href="index.php"><img id="home-button" class="<?php echo ($title=="Home")? 'current' : 'home-button' ?>" src="images/home-icon.svg"></a>

</div>

<?php include("includes/init.php");
$title = "Search";


// user input search keyword
if (isset($_GET['search'])){
  $do_search = TRUE;

  $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
  $search = trim($search);

  if (empty($search)){
    $do_search = FALSE;
    $show_search_feedback = TRUE;
    $search = NULL;
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="styles/site.css" media="all">

  <title> Composer DB - <?php echo $title; ?></title>
</head>

<body>

  <header>
    <?php include("includes/header.php"); ?>
  </header>

  <main>

     <!-- search bar -->
     <form id="search-bar" action="search.php" method="get">
      <div class="search">
          <input type="text" name="search" id="search" placeholder="Search..." />
          <!-- Source: https://www.iconfinder.com/icons/1608826/search_icon -->
          <button type="submit"><img src="images/search-icon.png" alt="Search"></button>
          <!-- On-screen citation is coded around line 71 below with the prompts for the look of the site.-->

      </div>
    </form>


    <?php
    if ($show_search_feedback) {?>
      <p class="search-feedback">Please enter a search keyword if you want to look up something in the catalog.</p>

    <?php
    } ?>

    <?php
    // search
    if ($do_search){ ?>

      <?php
      $sql = "SELECT * FROM composers WHERE composer LIKE '%'||:search||'%' OR country LIKE '%'||:search||'%' OR era LIKE '%'||:search||'%' OR piece LIKE '%'||:search||'%'";
      $params = [':search' => $search];

    } else {?>

      <div class="prompt">
          <p class="search-page">Source: <cite><a href="https://www.iconfinder.com/icons/1608826/search_icon">Search Icon</a></cite></p>
          <p class="search-page">"Tchaikovsky"</p>
          <p class="search-page">"Romantic"</p>
          <p class="search-page">"Swan Lake"</p>
      </div>

    <?php
    } ?>



    <?php
    // get search result
    $results = exec_sql_query($db, $sql, $params);?>

    <?php
    if ($results) {
      $records = $results -> fetchAll();

      if (count($records) > 0) {
      ?>
        <p class="search-page">Displaying search results for "<?php echo htmlspecialchars($search) ?>"</p>


      <?php
      } else { ?>
        <p class="search-feedback">No matching composer info found :(</p>

      <?php
      }

    } ?>



  </main>


  <footer>
    <?php include("includes/footer.php"); ?>
  </footer>


</body>

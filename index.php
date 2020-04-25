<?php include("includes/init.php");
$title = "Home";

// get all images
$sql = "SELECT file_name FROM images;";
$params = array();
// get an array of results
$all_images = exec_sql_query($db, $sql, $params)->fetchAll();


// a function that takes in db and filter-by tag and return the images requested.
// takes in: db, filter tag (default = all).
// return: list of file names, e.g., ["1.jpg", "2.png"].
function get_all_images_requested ($db, $filter_by = "*"){

};

//display an image
function display_this_image($image){
  $http_query = http_build_query(array('image' => strtolower($image['file_name'])));?>
  <a href="index.php?<?php echo $http_query; ?>">
  <figure>
    <img src="uploads/<?php echo $image['file_name']; ?>"/>
  </figure>
<?php
};

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
    <div class="gallery">
      <?php
      if (count($all_images) > 0) {
        foreach ($all_images as $img) {
          display_this_image($img);
        }

      }; ?>

    </div>



  </main>


  <footer>
    <?php include("includes/footer.php"); ?>
  </footer>


</body>

</html>

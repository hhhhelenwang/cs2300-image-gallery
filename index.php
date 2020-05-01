<?php include("includes/init.php");
$title = "Home";

// get all images
$sql = "SELECT id, file_name FROM images;";
$params = array();
// get an array of results
$all_images = exec_sql_query($db, $sql, $params)->fetchAll();

// a function that takes in db, id, and tag (if applicable)
// and return the images requested.
// takes in: db, filter tag (default = all).
// return: list of file names, e.g., ["1.jpg", "2.png"].
function get_all_images_requested ($db, $id, $tag) {
  // if there is a specific id requested
  if ($id) {
    $view_single_sql = "SELECT file_name, description FROM images WHERE id ==" . ":id;";
    $params = [":id" => intval($id)];
    $requested_images = exec_sql_query($db, $view_single_sql, $params)->fetchAll();
  // if there are tags requested
  } else if ($tag) {
    $view_by_tag_sql = "SELECT file_name, description FROM images WHERE tag LIKE '%'||:tag||'%';";
    $params = [":tag" => $tag];
    $requested_images = exec_sql_query($db, $view_by_tag_sql, $params)->fetchAll();
  }
  return $requested_images;

};

//a function that takes in db and an image id
// and returns a list of tags for this image
function get_tags ($db, $id) {
  $get_tags_sql = "SELECT DISTINCT tags.tag_name from tags INNER JOIN image_tags ON tags.id == image_tags.tag_id INNER JOIN images ON image_tags.image_id == " . ":id";
  $params = [":id" => $id];
  $image_tags = exec_sql_query($db, $get_tags_sql, $params)->fetchAll();
  return $image_tags;
}

//display an image
function display_this_image($image){
  $http_query_image = http_build_query(array('image_id' => $image['id']));?>
  <div class="gird-item">
      <a href="index.php?<?php echo $http_query_image; ?>">
        <img src="uploads/<?php echo $image['file_name']; ?>"/>
      </a>
  </div>
<?php
};

//display a tag
function display_this_tag($tag) {
  $http_query_tag = http_build_query(array('tag_name' => $tag['tag_name']));?>
  <div class="tag-item">
    <a href="index.php?<?php echo $http_query_tag; ?>">
      #<?php echo $tag['tag_name']; ?>
    </a>
</div>
<?php
}

// if there is a request to view a single image
$view_single_image = FALSE;
if (isset($_GET['image_id'])){
  $view_single_image = TRUE;
  $id = $_GET['image_id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="styles/site.css" media="all">

  <title> Everyday Music - <?php echo $title; ?></title>
</head>

<body>

  <header>
    <?php include("includes/header.php"); ?>
  </header>

  <main>

  <?php
    if ($view_single_image) {
      $images = get_all_images_requested($db, $id, null); // the assciative array
      $img = $images[0]; // the image
      $tags = get_tags($db, $id);
      ?>
      <div class=single-image-container>

        <div class="img">
          <img src="uploads/<?php echo $img['file_name'] ?>"/>
        </div>

        <div class="description">
          <p><?php echo $img['description']; ?></p>
        </div>

        <div class="tags">
        <?php foreach ($tags as $tag) {
          display_this_tag($tag);
        } ?>
        </div>

      </div>

    <?php
    } else { ?>
      <div class="gallery">
        <?php
        if (count($all_images) > 0) {
          foreach ($all_images as $img) {
            display_this_image($img);
          }
        }; ?>

    </div>

    <?php
    }?>




  </main>


  <footer>
    <?php include("includes/footer.php"); ?>
  </footer>


</body>

</html>

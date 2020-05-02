<?php
include("includes/init.php");
include("includes/helpers.php");
$title = "Home";
const MAX_FILE_SIZE = 1000000;

$view_single_image = FALSE;
$upload_image = FALSE;
$view_image_by_tag = FALSE;

//if there is a request to view a single image
if (isset($_GET['image_id'])){
  $view_single_image = TRUE;
  $id = $_GET['image_id'];

  $images = get_all_images_requested($db, $id, null); // the assciative array
  $img = $images[0]; // the image
  $tags = get_tags($db, $id);

}

$edit_image = FALSE;
$delete_image = FALSE;
if (isset($_POST['edit'])) {
  $edit_image = TRUE;

}

if (isset($_GET['new_tags'])){
  $new_tags = strtolower(filter_input(INPUT_POST, 'new-tags', FILTER_SANITIZE_STRING));
  $new_tags_not_trimed = explode(";", $tags_input);
  // source: https://www.php.net/manual/en/function.explode.php
  $new_tags = array();
  foreach ($tags_not_trimed as $tag) {
    array_push($tags, trim($tag));
  }

  add_new_tags($db, $id, $new_tags);

}


//if there is a request to view images by a tag
if (isset($_GET['tag'])) {
  $view_image_by_tag = TRUE;

  $tag = $_GET['tag'];
  $tag_id = get_tag_id($db, $tag);
  $images_by_tag = get_all_images_requested($db, null, $tag_id);
}

// if there is a request to upload an image
if (isset($_GET['upload'])) {
  $upload_image = TRUE;

  $image_uploaded = FALSE;

  // if there is a upload (post request)
  if (isset($_POST["image_upload"])){
    $info = $_FILES["image"];

    if ($info["error"] == UPLOAD_ERR_OK){
      $file_name = basename($info["name"]);
      $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

      $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

      $tags_input = strtolower(filter_input(INPUT_POST, 'tags', FILTER_SANITIZE_STRING));
      $tags_not_trimed = explode(";", $tags_input);
      // source: https://www.php.net/manual/en/function.explode.php
      $tags = array();
      foreach ($tags_not_trimed as $tag) {
        array_push($tags, trim($tag));
      }

      $store_image_sql = "INSERT INTO images (file_name, file_ext, description) VALUES (:file_name, :file_ext, :description);";
      $store_image_params = [
        ":file_name" => $file_name,
        ":file_ext" => $file_ext,
        ":description" => $description
      ];

      // if the image is stored successfully into images table
      if (exec_sql_query($db, $store_image_sql, $store_image_params)) {
        $image_id = $db->lastInsertId();
        $new_file_name = $image_id . "." . $file_ext;
        $new_path = "uploads/" . $new_file_name;
        move_uploaded_file($info["tmp_name"], $new_path);

        $update_file_name_sql = "UPDATE images SET file_name = :new_file_name WHERE id == :id;";
        $update_file_name_params = [":new_file_name" => $new_file_name, ":id" => $image_id];
        exec_sql_query($db, $update_file_name_sql, $update_file_name_params);

        add_new_tags($db, $image_id, $tags);


      }
    }
  }
}


// get all images
$sql = "SELECT id, file_name FROM images;";
$params = array();
// get an array of results
$all_images = exec_sql_query($db, $sql, $params)->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="styles/site.css" media="all">

  <title>Everyday Music</title>
</head>

<body>

  <header>
    <?php include("includes/header.php"); ?>
  </header>

  <main>

  <?php
    if ($view_single_image) {
      ?>
      <div class=single-image-container>
        <div class="img">
          <img src="uploads/<?php echo $img['file_name'] ?>"/>
        </div>

        <div class="description-tags">

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
        if ($edit_image) { ?>
          <div class="edit-tag">
            <form id="edit-tag" action=<?php echo "index.php?image_id=" . $id;?> method="post">
              <label for="new-tags">Add a tag:</label>
              <input type="text" id="new-tags" name="new-tags"/>
              <button type="submit" name="new-tags"><img id="submit" src="images/check.svg"></button>
              <!-- icon: "https://www.s-ings.com/typicons/" -->
            </form>
          </div>

        <?php
        } else { ?>
          <div class="dropdown">
            <div class="dropdown-content">
              <form id="edit" action=<?php echo "index.php?image_id=" . $id; ?>  method="post">
                <input type="hidden" name="edit" value="yes"/>
                <button type="submit"><img id="edit" src="images/edit.svg"></button>
                <!-- icon: "https://www.s-ings.com/typicons/" -->
              </form>
              <form id="delete" action="index.php" method="post">
                <!-- <input type="submit" name="delete" -->
                <button type="submit" name="delete"><img id="delete" src="images/trash.svg"></button>
                <!-- icon: "https://www.s-ings.com/typicons/" -->
              </form>
            </div>
          </div>
        <?php
        } ?>
      </div>

    <?php
    } else if ($view_image_by_tag) { ?>
      <div class="gallery">
        <?php
        if (count($images_by_tag) > 0) {
          foreach ($images_by_tag as $img) {
            display_this_image($img);
          }
        }; ?>

      </div>

    <?php
    } else if ($upload_image) { ?>
      <div class="upload-container">
        <form id="upload-image" method="post" enctype="multipart/form-data" action="index.php?upload=yes">

        <div class="image-preview">
           <input id="image" type="file" name="image">
        </div>

        <div class="description-tags">
          <div class="upload-description">
            <label for="description">Say something:</label>
            <input id="description" type="text" name="description">
          </div>

          <div class="upload-tags">
            <label for="tags">Hashtag...(seperate with ";")</label>
            <input id="tags" type="text" name="tags">
          </div>

        </div>

        <div class="submit">
          <button name="image_upload" type="submit"><img id="uploadimage" src="images/upload.svg"/><button>
        </div>

        </form>

    </div>

    <?php
    }

    else { ?>
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


<cite>Source: <a href="https://www.s-ings.com/typicons/">All icons</a></cite>
<cite>Seed data: created by Helen Wang</cite>
<cite>Seed data: <a href="https://courses.lumenlearning.com/musicappreciation_with_theory/chapter/symphony-orchestras/">the first pic</a></cite>

  </main>


  <footer>
    <?php include("includes/footer.php"); ?>
  </footer>


</body>

</html>

<?php include("includes/init.php");
$title = "Upload";

const MAX_FILE_SIZE = 1000000;





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
    <div class="upload-container">
        <form id="upload-image" method="post" enctype="multipart/form-data" action="upload.php">

        <div class="image-preview">
           <input id="image" type="file" name="image">
        </div>

        <div class="description">
          <label for="description">Say something:</label>
          <input id="description" type="textarea" name="description">
        </div>

        <div class="tags">
          <label for="tags">Hashtag...</label>
          <input id="tags" type="text" name="tags">
        </div>

        <div class="submit">
          <button name="image_upload" type="submit"><img src="images/upload.svg"/><button>
        </div>

        </form>

    </div>



  </main>

  <footer>
    <?php include("includes/footer.php"); ?>
  </footer>

</body>

</html>

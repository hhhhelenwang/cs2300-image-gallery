<?php include("includes/init.php");
$title = "Add";

// initialise user input values
$composer ='';
$country = '';
$era = '';
$piece = '';

// for validation
$show_form = TRUE;

// for showing corrective feedback
$show_composer_feedback = FALSE;
$show_country_feedback = FALSE;
$show_era_feedback = FALSE;
// piece is optional, no validation needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $is_valid_insert = TRUE;

  // take in and sanitize user inputs
  $composer = filter_input(INPUT_POST, 'composer', FILTER_SANITIZE_STRING);
  $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
  $era = filter_input(INPUT_POST, 'era', FILTER_SANITIZE_STRING);
  $piece = filter_input(INPUT_POST, 'piece', FILTER_SANITIZE_STRING);

  // validate user inputs: composer, country, era not empty
  if (empty($composer)) {
    $is_valid_insert = FALSE;
    $show_composer_feedback = TRUE;

  }

  if (empty($country)) {
    $is_valid_insert = FALSE;
    $show_country_feedback = TRUE;
  }

  if (empty($era)) {
    $is_valid_insert = FALSE;
    $show_era_feedback = TRUE;

  }

  // if insert is not valid, continue to show form
  $show_form = !$is_valid_insert;

}

// insert
if ($is_valid_insert){
  $sql = "INSERT INTO composers (composer, country, era, piece) VALUES (:composer, :country, :era, :piece)";
  $params = [':composer' => $composer, ':country' => $country, ':era' => $era, ':piece' => $piece];

  if(exec_sql_query($db, $sql, $params)){
    $show_form = FALSE;
  } else {
    $show_form = TRUE;
  }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="styles/site.css" media="all">

  <title> Composer DB - <C?php echo $title; ?></title>
</head>

<body>

  <header>
    <?php include("includes/header.php"); ?>
  </header>

  <main>

  <?php
  if ($show_form){ ?>

    <p class="add-page">Don't see your beloved composer? Add it here!</p>

    <form id="insert_form" action="add.php" method="post">

      <!-- Feedback - Composer -->
      <?php
      if ($show_composer_feedback){ ?>
        <div class="group_label_input">
          <p class="feedback">Please provide the name of composer.</p>
        </div>
      <?php
      } ?>

      <div class="group_label_input">
        <label for="composer">Composer:</label>
        <input id="composer" type="text" name="composer" placeholder="Pyotr Ilyich Tchaikovsky" value="<?php echo htmlspecialchars($composer); ?>"/>
      </div>

      <!-- Feedback - Country -->
      <?php
      if ($show_country_feedback){ ?>
        <div class="group_label_input">
          <p class="feedback">Please provide the composer's country.</p>
        </div>
      <?php
      } ?>

      <div class="group_label_input">
        <label for="country">Country:</label>
        <input id="country" type="text" name="country" placeholder="Russia" value="<?php echo htmlspecialchars($country); ?>"/>
      </div>

      <!-- Feedback - Era -->
      <?php
      if ($show_era_feedback){ ?>
        <div class="group_label_input">
          <p class="feedback">Please provide the composer's era.</p>
        </div>
      <?php
      } ?>

      <div class="group_label_input">
        <label for="era">Era:</label>
        <input id="era" type="text" name="era" placeholder="Romantic" value="<?php echo htmlspecialchars($era); ?>"/>
      </div>


      <!--Piece is optional -->
      <div class="group_label_input">
        <label for="piece">Famous Piece (Optional):</label>
        <input id="piece" type="text" name="piece" placeholder="Swan Lake, Op. 20" value="<?php echo htmlspecialchars($piece); ?>"/>
      </div>

      <div class="group_label_input">
        <input type="submit" value="Submit"/>
      </div>

    </form>

  <?php
  } else {
    $sql = "SELECT composer, country, era, piece FROM composers;";
    $results = exec_sql_query($db, $sql);
    ?>

    <p class="add-page">Information of <?php echo $composer; ?> has been added!</p>



  <?php
  } ?>


  </main>


  <footer>
    <?php include("includes/footer.php"); ?>
  </footer>


</body>

<?php include("includes/init.php");
$title = "Home"; ?>

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

    <?php
    $sql = "SELECT composer, country, era, piece FROM composers;";
    $result = exec_sql_query($db, $sql);
    ?>



    </table>
    <cite>Source: <a href="http://artquiz.sourceforge.net/cmap/">The List of Composers is in reference from here</a></cite>

  </main>


  <footer>
    <?php include("includes/footer.php"); ?>
  </footer>


</body>

</html>

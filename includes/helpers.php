<?php
// all helper functions


// a function that takes in db, id, and tag (if applicable)
// and return the images requested.
// takes in: db, filter tag (default = all).
// return: the associative array of images.
function get_all_images_requested ($db, $id, $tag_id) {
  // if there is a specific id requested
  if ($id) {
    $view_single_sql = "SELECT file_name, description FROM images WHERE id ==:id;";
    $params = [":id" => intval($id)];
    $requested_images = exec_sql_query($db, $view_single_sql, $params)->fetchAll();
  // if there are tags requested
  } else if ($tag_id) {
    $view_by_tag_sql = "SELECT DISTINCT file_name, description FROM images INNER JOIN image_tags ON images.id == image_tags.image_id INNER JOIN tags ON image_tags.tag_id == :tag_id;";
    $params = [":tag_id" => $tag_id];
    $requested_images = exec_sql_query($db, $view_by_tag_sql, $params)->fetchAll();
  }
  return $requested_images;
}


// a function to retreive all exisiting tags in the database
function get_existing_tags ($db) {
  $existing_tags = array();
  $existing_tags_pairs = exec_sql_query($db,"SELECT tag_name FROM tags;",array())->fetchAll();
  foreach ($existing_tags_pairs as $tag_pair) {
    array_push($existing_tags, $tag_pair['tag_name']);
  }
  return $existing_tags;
}

// a function to retrieve all tags for an image
function get_existing_tags_this_image ($db, $id) {
  $existing_tags_this_image = array();
  $sql = "SELECT tag_name FROM tags INNER JOIN image_tags ON tags.id == image_tags.tag_id INNER JOIN images ON image_tags.image_id == :image_id;";
  $params = [":image_id" => $id];
  $existing_tags_pairs = exec_sql_query($db, $sql ,$params)->fetchAll();
  foreach ($existing_tags_pairs as $tag_pair) {
    array_push($existing_tags_this_image, $tag_pair['tag_name']);
  }
  return $existing_tags_this_image;
}

//a function that takes in db and an image id
// and returns a list of tags for this image
function get_tags ($db, $id) {
  $get_tags_sql = "SELECT DISTINCT tags.tag_name from tags INNER JOIN image_tags ON tags.id == image_tags.tag_id INNER JOIN images ON image_tags.image_id == :id;";
  $params = [":id" => $id];
  $image_tags = exec_sql_query($db, $get_tags_sql, $params)->fetchAll();
  return $image_tags;
}

// a function that takes in db and a tag
// and returns the tag id
function get_tag_id ($db, $tag) {
  $sql_get_tag_id = "SELECT id FROM tags WHERE tag_name == :tag;";
  $params_get_tag_id = [":tag" => $tag];
  $result = exec_sql_query($db, $sql_get_tag_id, $params_get_tag_id)->fetchAll();
  $tag_id = $result[0]['id'];
  return $tag_id;

}

// a function that adds a list of tags to an image
function add_new_tags ($db, $image_id, $tags) {
  $existing_tags = get_existing_tags($db);
  $existing_tags_this_image = get_existing_tags_this_image($db, $image_id);
  // store each tag
  foreach ($tags as $t) {

    if ((!in_array($t, $existing_tags)) and !in_array($t, $existing_tags_this_image) and ($t != "")) {
      $store_this_tag_sql = "INSERT INTO tags (tag_name) VALUES (:tag_name);";
      $store_this_tag_params = [":tag_name" => $t];
      exec_sql_query($db, $store_this_tag_sql, $store_this_tag_params);
      $tag_id = $db->lastInsertId();
      $image_tags_sql = "INSERT INTO image_tags (image_id, tag_id) VALUES (:image_id, :tag_id);";
      $image_tags_params = [":image_id" => $image_id, ":tag_id" => $tag_id];
      exec_sql_query($db, $image_tags_sql, $image_tags_params);
    }

    if ((in_array($t, $existing_tags)) and (!in_array($t, $existing_tags_this_image))){
      $tag_id = get_tag_id($db, $t);
      $image_tags_sql = "INSERT INTO image_tags (image_id, tag_id) VALUES (:image_id, :tag_id);";
      $image_tags_params = [":image_id" => $image_id, ":tag_id" => $tag_id];
      exec_sql_query($db, $image_tags_sql, $image_tags_params);
    }

  }
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
}

//display a tag
function display_this_tag($tag) {
  $http_query_tag = http_build_query(array('tag' => $tag['tag_name']));?>
  <div class="tag-item">
    <a href="index.php?<?php echo $http_query_tag; ?>">
      #<?php echo $tag['tag_name']; ?>
    </a>
  </div>
<?php
} ?>

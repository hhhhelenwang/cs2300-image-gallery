# Project 3: Design Journey

Be clear and concise in your writing. Bullets points are encouraged.

**Everything, including images, must be visible in VS Code's Markdown Preview.** If it's not visible in Markdown Preview, then we won't grade it.

# Design & Plan (Milestone 1)

## Describe your Gallery (Milestone 1)
> What will your gallery be about? 1 sentence.
- A music-themed image gallery that welcomes musicians and music-passionates to share their daily experience with music through photos and short captions such as practicing an instrument, going to a live concert, or walking pass some street buskers.

> Will you be using your existing Project 1 or Project 2 site for this project? If yes, which project?
- I will be using my Project 2.
- Preserve the music theme.
- Preserve the main site design. This includes the header, nav bar, footer, and background.
- Re-designed the individual pagesto suit the need of an image gallery. The original pages are the database display, search page, and add-entry page. These will be removed. Instead the front page will be displaying all sheet music thumbnails. Search functionality will be built into this front page as well.

> If using your existing Project 1 or Project 2, please upload sketches of your final design here.
- Here is the design of my Project 2. How this design evolves to an image gallery will be in the next section.
- ![page 1](page1.jpg)
- ![page 2](page2.jpg)
- ![page 3](page3.jpg)

## Target Audience(s) (Milestone 1)
> Tell us about your target audience(s).
- Music passianates who value a sense of community. Users are meant to find contents that they are intrested in and instantly identifies with as music passionate.

## Design Process (Milestone 1)
> Document your design process. Show us the evolution of your design from your first idea (sketch) to design you wish to implement (sketch). Show us the process you used to organize content and plan the navigation (card sorting), if applicable.
> Label all images. All labels must be visible in VS Code's Markdown Preview.
> Clearly label the final design.
- Idea listings
- ![idea listings](p3-pg1.jpg)

- Rough sketches
- ![rough sketches](p3-pg2.jpg)

- Final designs
- ![final designs](p3-pg3.jpg)
- ![final designs](p3-pg4.jpg)
- ![final designs](p3-pg5.jpg)


## Design Patterns (Milestone 1)
> Explain how your site leverages existing design patterns for image galleries.
> Identify the parts of your design  that leverage existing design patterns and justify their usage.
> Most of your site should leverage existing patterns. If not, fully explain why your design is a special case (you need to have a very good reason here to receive full credit)
- The view-all-images page displays the images in a grid style. This is common in web image gallery like pinterest and the web-page version of instagram. This way of displaying images allow users to easily have an overview of all images.
- The view-single-image page is a floating window above whatever page the user was on. Image is dispayed on the left, descriptions and tags on the right. This is a common feature in image gallery such as pinterest as well. This gives the user a good look at the enlarged image and its infor as well. It also gives user a sense that they can easily return to the old page (and they can).
- My gallery largely make use of icons instead of words. This is also common designs in image gallery. The icons are chosen to be intuitive so users can easily understand them without going through words.
- The delete funtion is hidden in a drop-down menu in the view-single-image page so it is hard to access. Its red color alarms user when they want to click the button. It also comes with a confirm message so user don't delete photos by accidence.


## Requests (Milestone 1)
> Identify and plan each request you will support in your design.
> List each request that you will need (e.g. view image details, view gallery, etc.)
> For each request, specify the request type (GET or POST), how you will initiate the request: (form or query string param URL), and the HTTP parameters necessary for the request.

Example:
- Request: view movie details
  - Type: GET
  - Params: id _or_ movie_id (movies.id in DB)

- Request: view single image
  - Type: GET
  - Params: id or image_id

- Request: upload image
  - Type: POST
  - through form

- Request: delete image
  - Type: POST
  - through form (button)

- Request: view by tag
 - Type: GET
 - Params: id or tags_id

- Request: add a tag
  - Type: POST
  - through form

- Request: delete a tag
  - TYPE: POST
  - through form (button)


## Database Schema Design (Milestone 1)
> Plan the structure of your database. You may use words or a picture.
> Make sure you include constraints for each field.

> Hint: You probably need `images`, `tags`, and `image_tags` tables.

> Hint: For foreign keys, use the singular name of the table + _id. For example: `image_id` and `tag_id` for the `image_tags` table.


Example:
```
movies (
id : INTEGER {PK, U, Not, AI}
field2 : ...
...
)
```
```
images (
  id: INTEGER {PK, U, Not, AI}
  file_name: TEXT {Not}
  file_ext: TEXT {Not}
  description: TEXT {}
)

tags (
  id: INTEGER {PK, U, Not, AI}
  tag_name: TEXT {Not}
)

image-tags (
  id: INTEGER {PK, U, Not, AI}
  image_id: INTEGER {Not}
  tag_id: INTEGER {Not}
)
```


## Database Query Plan (Milestone 1)
> Plan your database queries. You may use natural language, pseudocode, or SQL.
> Using your request plan above, plan all of the queries you need.

- view all images
  ```sql
  SELECT id, file_name FROM images;
  ```

- view a single image
  ```sql
    SELECT file_name, description FROM images WHERE id == <a given id>;
  ```

- view by tag
  ```sql
  SELECT file_name, description FROM images WHERE tag LIKE '%<a given tag>%';
  ```

- retrieve all tags for one image
  ```sql
  SELECT DISTINCT tags.tag_name from tags INNER JOIN image_tags ON tags.id == image_tags.tag_id INNER JOIN images ON image_tags.image_id == <a given id>;
  ```

- upload an image (insert image, insert tag, insert image_tags relation)
 ```sql
 INSERT INTO images (file_name, file_ext, description) VALUES (<given filename>, <given file_ext>, <given description>);

 INSERT INTO tags (tag_name) VALUES (<given tag>);

 SELECT id FROM images WHERE file_name == <the filename just stored>

 SELECT id FROM tags WHERE tag_name == <the tag just stored>

 (store the image_id and tag_id into two variables)

 INSERT INTO image_tags (image_id, tag_id) VALUES (<the image id just retrieved>, <the tag id just retrieved>);
 ```

- delete an image
  ```sql
  DELETE FROM images WHERE id == <given id>;

  DELETE FROM tags INNER JOIN image_tags ON tags.id == image_tags.tag_id INNER JOIN images ON image_tags.image_id == <a given id>;
  ```

- add a tag to an image
  ```sql
  INSERT INTO tags (tag_name) VALUES (<the given tag name>);

  SELECT id FROM tags WHERE tag_name == <the tag just stored>;

  INSERT INTO image_tags (image_id, tag_id) VALUES (<the image id>, <the tag id just retrieved>);

  ```

- delete a tag from an image
  ```sql
  DELETE FROM tags WHERE id == <given id>;

  DELETE FROM tags INNER JOIN image_tags ON tags.id == image_tags.tag_id INNER JOIN images ON image_tags.image_id == <a given id>;
  ```

## Code Planning (Milestone 1)
> Plan what top level PHP pages you'll need.
- home page (all images + view by tag + upload + view single image)


> Plan what partials you'll need.
- header + nav bar partials: includes search bar + upload icon
- footer partials
- helper functions

> Plan any PHP code you'll need.

Example:
```
Put all code in between the sets of backticks: ``` code here ```
```
- view single image
```
if (isset($_GET['image_id'])){
  $view_single_image = TRUE;
  $id = $_GET['image_id'];

  get_all_images_requested
  get single image
  get the tags
}

```
- view by tag
```
if (isset($_GET['tag'])) {
  $view_image_by_tag = TRUE;
  get_all_images_requested
}
```

- upload
```
if (isset($_GET['upload'])) {
  $upload_image = TRUE;

  $image_uploaded = FALSE;

  // if there is a upload (post request)
  if (isset($_POST["image_upload"])){
    $info = $_FILES["image"];

    if ($info["error"] == UPLOAD_ERR_OK){
      store file name from $info;
      store file ext from info;

      get description from input

      get tags
      sanitize tags
      put tags into an array

      store image info in to images table

      if the image is stored successfully into images table {
        form path to store image on server

        check all tags, if the tag does not exist in database, add tag to database

        if tag is not a tag of this image, add tag to this image


      }
    }
  }
}
```



# Complete & Polished Website (Final Submission)

## Gallery Step-by-Step Instructions (Final Submission)
> Write step-by-step instructions for the graders.
> For each set of instructions, assume the grader is starting from index.php.

Viewing all images in your gallery:
1. Go to index.php (home)
2.

View all images for a tag:
1. at the search bar in the nav bar, type in the tag you want to view
2. click the search icon

View a single image and all the tags for that image:
1. click any image displayed
2. it brings you to view-single-image page and displays all info

How to upload a new image:
1. click the upload button on the nav bar
2. click "browse" to select your file
3. type in description
4. type in tags, seperate two tags with ";"
5. hit the upload button

How to delete an image:
1.
2.

How to view all tags at once:
1.
2.

How to add a tag to an existing image:
1. click an image on the home page and go to view-single-image page
2. click the edit icon on the top-right. it looks like a pen and a piece of paper
3. in the input space that pops out, enter the tags you want to add, seperate two tags with ";"
4. hit the "ok" button which looks like a tick

How to remove a tag from an existing image:
1.
2.


## Reflection (Final Submission)
> Take this time to reflect on what you learned during this assignment. How have you improved since starting this class?
- I leanred to manage a project that is much larger in scale compared to previous assignments. I am now more familiar with development with databases.
- I learned that failing to manage my time leads to serious consequences because I could not implement all required functionalities before deadline.

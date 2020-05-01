-- TODO: Put ALL SQL in between `BEGIN TRANSACTION` and `COMMIT`
BEGIN TRANSACTION;

-- TODO: create tables

-- CREATE TABLE `examples` (
-- 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
-- 	`name`	TEXT NOT NULL
-- );


CREATE TABLE images (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    file_name TEXT NOT NULL,
    file_ext TEXT NOT NULL,
    description TEXT
);

CREATE TABLE tags (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    tag_name TEXT NOT NULL
);

CREATE TABLE image_tags (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    image_id INTEGER NOT NULL,
    tag_id INTEGER NOT NULL
);


-- TODO: initial seed data

-- INSERT INTO `examples` (id,name) VALUES (1, 'example-1');
-- INSERT INTO `examples` (id,name) VALUES (2, 'example-2');

-- images
INSERT INTO images (id, file_name, file_ext, description) VALUES (1, "1.jpg", "jpg", "Orchestra");
INSERT INTO images (id, file_name, file_ext, description) VALUES (2, "2.png", "png", "On stage");
INSERT INTO images (id, file_name, file_ext, description) VALUES (3, "3.png", "png", "Leipzig Gewandhaus Orchestra");
INSERT INTO images (id, file_name, file_ext, description) VALUES (4, "4.png", "png", "Sight from the backstage");
INSERT INTO images (id, file_name, file_ext, description) VALUES (5, "5.png", "png", "My uniform for the concert!");
INSERT INTO images (id, file_name, file_ext, description) VALUES (6, "6.png", "png", "Guqin");
INSERT INTO images (id, file_name, file_ext, description) VALUES (7, "7.png", "png", "Inside the practice room");
INSERT INTO images (id, file_name, file_ext, description) VALUES (8, "8.png", "png", "Inside the studio!");
INSERT INTO images (id, file_name, file_ext, description) VALUES (9, "9.png", "png", "Guzheng");
INSERT INTO images (id, file_name, file_ext, description) VALUES (10, "10.png", "png", "Prep for the rehearsal!");

-- tags
INSERT INTO tags (id, tag_name) VALUES (1, "instrument");
INSERT INTO tags (id, tag_name) VALUES (2, "concert");
INSERT INTO tags (id, tag_name) VALUES (3, "practice");
INSERT INTO tags (id, tag_name) VALUES (4, "rehearsal");
INSERT INTO tags (id, tag_name) VALUES (5, "onstage");

-- image_tags
INSERT INTO image_tags (id, image_id, tag_id) VALUES (1, 1, 2);
INSERT INTO image_tags (id, image_id, tag_id) VALUES (2, 1, 5);
INSERT INTO image_tags (id, image_id, tag_id) VALUES (3, 2, 5);
INSERT INTO image_tags (id, image_id, tag_id) VALUES (4, 3, 2);
INSERT INTO image_tags (id, image_id, tag_id) VALUES (5, 4, 5);
INSERT INTO image_tags (id, image_id, tag_id) VALUES (6, 5, 2);
INSERT INTO image_tags (id, image_id, tag_id) VALUES (7, 6, 1);
INSERT INTO image_tags (id, image_id, tag_id) VALUES (8, 7, 3);
INSERT INTO image_tags (id, image_id, tag_id) VALUES (9, 8, 3);
INSERT INTO image_tags (id, image_id, tag_id) VALUES (10, 9, 1);
INSERT INTO image_tags (id, image_id, tag_id) VALUES (11, 10, 4);



COMMIT;

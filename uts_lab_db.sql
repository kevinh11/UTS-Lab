CREATE DATABASE todo_list;
DROP DATABASE todo_list;
USE todo_list;
DROP TABLE todo_items;
CREATE TABLE USERS(
  user_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  user_name VARCHAR(20) NOT NULL,
  user_pass VARCHAR(30) NOT NULL
); 
CREATE TABLE todo_items (
  task_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  task_name VARCHAR(100),
  task_status VARCHAR(20),
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES USERS (user_id)
);








<?php

class Post
{
    private $db;

    public $title;
    public $content;
    public $author;

    public function __construct()
    {
        $this->db = Flight::db();
    }

    public function allPosts()
    {
        $query = $this->db->query("SELECT * FROM posts");
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function createPost()
    {
        $query = $this->db->prepare("INSERT INTO posts (title, content, author) VALUES(?, ?, ?)");

        // Биндим параметры
        $query->bindParam(1, $this->title);
        $query->bindParam(2, $this->content);
        $query->bindParam(3, $this->author);

        // Выполняем запрос
        $result = $query->execute();

        // Проверяем результат выполнения
        if ($result) {
            return true;
        } else {
            // Обработка ошибок
            echo "Ошибка при создании поста: " . $query->errorInfo()[2];
            return false;
        }
    }
    public function updatePost($id)
    {
        $query = $this->db->prepare("UPDATE posts SET title = ?, content = ?, author = ? WHERE id = ?");

        // Биндим параметры
        $query->bindParam(1, $this->title);
        $query->bindParam(2, $this->content);
        $query->bindParam(3, $this->author);
        $query->bindParam(4, $id);

        // Выводим данные для проверки
        echo "Title: " . $this->title . "<br>";
        echo "Content: " . $this->content . "<br>";
        echo "Author: " . $this->author . "<br>";
        echo "ID: " . $id . "<br>";

        // Выполняем запрос
        $result = $query->execute();

        return $result;
    }

    public function findById($id)
    {
        $query = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
        $query->execute([$id]);

        $row = $query->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function deletePost($id)
    {
        $query = $this->db->query("DELETE FROM posts WHERE id='$id'");
    }
}

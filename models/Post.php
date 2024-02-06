<?php

include('BaseModel.php');

class Post
{
    private $db;
    private $base;

    public $title;
    public $content;
    public $author;

    public function __construct()
    {
        $this->db = Flight::db();
        $this->base = new BaseModel('posts');
    
    }

    // public function allPosts()
    public function all()
    {
        // $query = $this->db->query($this->base->findAll());
        // $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        $rows = $this->base->findAll();
        // var_dump($rows);
        return $rows;
    }

    // public function createPost()
    public function create()
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
    // public function updatePost($id)
    // {
    //     $query = $this->db->prepare("UPDATE posts SET title = ?, content = ?, author = ? WHERE id = ?");

    //     // Биндим параметры
    //     $query->bindParam(1, $this->title);
    //     $query->bindParam(2, $this->content);
    //     $query->bindParam(3, $this->author);
    //     $query->bindParam(4, $id);

    //     // Выводим данные для проверки
    //     echo "Title: " . $this->title . "<br>";
    //     echo "Content: " . $this->content . "<br>";
    //     echo "Author: " . $this->author . "<br>";
    //     echo "ID: " . $id . "<br>";

    //     // Выполняем запрос
    //     $result = $query->execute();

    //     return $result;
    // }

    public function update($id)
    {
        $this->base->updateById($id, 'title', $this->title);
        $this->base->updateById($id, 'content', $this->content);
        $this->base->updateById($id, 'author', $this->author);
    }

    public function findById($id)
    {
        // $query = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
        // $query->execute([$id]);

        // $row = $query->fetch(PDO::FETCH_ASSOC);

        $row = $this->base->findById($id);

        return $row;
    }

    public function delete($id)
    {
        // $query = $this->db->query("DELETE FROM posts WHERE id='$id'");
        $this->base->deleteById($id);
    }
}

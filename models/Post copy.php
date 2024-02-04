<?php

class Post
{
    public $title;
    public $content;
    public $author;

    public function createPost()
    {
        $db = Flight::db();

        $query = $db->prepare("INSERT INTO posts (title, content, author) VALUES(?, ?, ?)");

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

    
}


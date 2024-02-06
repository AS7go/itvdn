<?php

include("././models/Post.php");

class PostRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Post();
    }

    public static function create($data)
    {
        $post = new Post();
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->author = $data['author'];
        $post->create();
    }
    public static function update($data)
    {
        $post = new Post();
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->author = $data['author'];
        $post->update($data['id']);

        // $result = $post_updated->update($id);
    }

    public static function delete($id)
    {
        $post = new Post();
        $post->delete($id);
    }
    public static function all()
    {
        $posts = new Post();
        $posts=$posts->all();
        return $posts;

    }

    public static function findPost($id)
    {
        $post = new Post();
        $post_data = $post->findById($id);
        return $post_data;
    }
}

<?php

include("././models/Post.php");
include("././models/BaseModel.php");

class BlogController
{
    public static function create()
    {
        $base_model = new BaseModel('posts');
        // $response = $base_model->findById(2);
        // $response = $base_model->findAll();
        // $response = $base_model->findWhereEquals('author', 'Author 2');
        // $response = $base_model->deleteById(3);
        // $response = $base_model->deleteWhere('author', 'аааа');
        $response = $base_model->updateById(6, 'title', 'Title 6');
        echo $response;

        $request = Flight::request();

        $message = '';

        if (!empty($request->data->content)) {

            $post = new Post();
            $post->title = $request->data->title;
            $post->content = $request->data->content;
            $post->author = $request->data->author;
            $post->createPost();

            $message = 'Пост успешно создан';
        }

        Flight::view()->display('post/create.php', [
            'message' => $message
        ]);
    }

    public static function update($id)
    {
        $request = Flight::request();

        $post = new Post();
        $post_data = $post->findById($id);

        $message = '';

        if (!empty($request->data->content)) {
            $post_updated = new Post();
            $post_updated->title = $request->data->title;
            $post_updated->content = $request->data->content;
            $post_updated->author = $request->data->author;

            $result = $post_updated->updatePost($id);

            $message = 'Пост успешно обновлен';
        }

        Flight::view()->display('post/update.php', [
            'title' => $post_data['title'],
            'content' => $post_data['content'],
            'author' => $post_data['author'],
            'message' => $message,
            'id' => $id
        ]);
    }

    public static function show($id)
    {
        $post = new Post();
        $post_data = $post->findById($id);

        Flight::view()->display('post/show.php', [
            'title' => $post_data['title'],
            'content' => $post_data['content'],
            'author' => $post_data['author']
        ]);
    }
    public static function delete($id)
    {
        $post = new Post();
        $post_data = $post->deletePost($id);

        echo "Пост успешно удален";
    }
    public static function list()
    {
        $posts = new Post();
        $list_posts = $posts->allPosts();

        Flight::view()->display('post/list.php', [
            'list_posts' => $list_posts
        ]);
    }
}

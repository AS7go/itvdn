<?php

// include("././models/Post.php");
include("././repositories/PostRepository.php");
// include("././models/BaseModel.php");

class BlogController
{
    public static function create()
    {
        $request = Flight::request();

        $message = '';

        if (!empty($request->data->content)) {

            PostRepository::create([
                'title' => $request->data->title,
                'content' => $request->data->content,
                'author' => $request->data->author

            ]);


            $message = 'Пост успешно создан';
        }

        Flight::view()->display('post/create.php', [
            'message' => $message
        ]);
    }

    public static function update($id)
    {
        $request = Flight::request();

        $post = PostRepository::findPost($id);

        $message = '';

        if (!empty($request->data->content)) {
            PostRepository::update([
                'id'=>$id,
                'title' => $request->data->title,
                'content' => $request->data->content,
                'author' => $request->data->author

            ]);

            $message = 'Пост успешно обновлен';
        }
        Flight::view()->display('post/update.php', [
            'title' => $post['title'],
            'content' => $post['content'],
            'author' => $post['author'],
            'message' => $message,
            'id' => $id
        ]);
    }

    public static function show($id)
    {
        // $post = new Post();
        // $post_data = $post->findById($id);
        
        $post = PostRepository::findPost($id);
        
        Flight::view()->display('post/show.php', [
            'title' => $post['title'],
            'content' => $post['content'],
            'author' => $post['author']
        ]);
        
        // Flight::view()->display('post/show.php', [
        //     'title' => $post_data['title'],
        //     'content' => $post_data['content'],
        //     'author' => $post_data['author']
        // ]);
    }
    public static function delete($id)
    {
        // $post = new Post();
        // $post_data = $post->delete($id);

        PostRepository::delete($id);

        echo "Пост успешно удален";
    }
    public static function list()
    {
        // $posts = new Post();
        // $list_posts = $posts->all();

        $list_posts = PostRepository::all();

        Flight::view()->display('post/list.php', [
            'list_posts' => $list_posts
        ]);
    }
}

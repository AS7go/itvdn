<form action="/post/create" method="POST">
    <div>
        <label>Заголовок: </label>
        <input type="text" name="title" />
    </div>
    <div>
        <label>Автор: </label>
        <input type="text" name="author" />
    </div>
    <div>
        <label>Содержимое поста: </label>
        <textarea name="content"></textarea>
    </div>
    <div>
        <input type="submit" value="Создать пост" />
    </div>
</form>

{% if ( message !='') %}
    {{ message }}
{% endif %}
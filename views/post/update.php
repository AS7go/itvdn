<form action="/post/update/{{ id }}" method="POST">
    <div>
        <label>Заголовок: </label>
        <input type="text" name="title" value="{{ title }}" />
    </div>
    <div>
        <label>Автор: </label>
        <input type="text" name="author" value="{{ author }}" />
    </div>
    <div>
        <label>Содержимое поста: </label>
        <textarea name="content">{{ content }}</textarea>
    </div>
    <div>
        <input type="submit" value="Обновить пост" />
    </div>
</form>

{% if ( message != '') %}
    {{ message }}
{% endif %}

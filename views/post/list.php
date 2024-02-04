{% for post in list_posts %}
    <h1>{{post['title']}}</h1>
    <p><b>Автор: </b>{{ post['author'] }}</p>
    <p>{{ post['content']}}</p>
    <a href="/post/update/{{post['id']}}">Редактровать</a>
    <a href="/post/show/{{post['id']}}">Посмотреть пост</a>
    <a href="/post/delete/{{post['id']}}">Удалить</a>
    <hr>
{% endfor %}
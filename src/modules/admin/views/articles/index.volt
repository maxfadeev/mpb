{% extends "layouts/layout.volt" %}

{% block title %}Admin{% endblock %}

{% block container %}
    {% for article in articles %}
        <p>{{ article.title }}
            <a href="{{ url("/articles/delete/id") }}/{{ article.id }}/{{ token }}">delete</a>
            <a href="{{ url("/articles/edit/id") }}/{{ article.id }}">edit</a>
        </p>
    {% endfor %}
    <a href="{{ url("/articles/add") }}">Add new</a>
{% endblock %}
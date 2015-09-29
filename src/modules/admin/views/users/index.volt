{% extends "layouts/layout.volt" %}

{% block title %}Users list{% endblock %}

{% block container %}
    {% for user in users %}
        <p>{{ user.login }}
            <a href="{{ url("/users/delete/id") }}/{{ user.id }}/{{ token }}">delete</a>
            <a href="{{ url("/users/edit/id") }}/{{ user.id }}">edit</a>
        </p>
    {% endfor %}
    <a href="{{ url("/users/add") }}">Add new</a>
{% endblock %}
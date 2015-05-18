{% extends "layouts/layout.volt" %}

{% block title %}Admin{% endblock %}

{% block content %}
    {{ content() }}
    {% for user in users %}
        <p>{{ user.login }}
            <a href="{{ url("/users/delete/id") }}/{{ user.id }}/{{ token }}">delete</a>
            <a href="{{ url("/users/edit/id") }}/{{ user.id }}">edit</a>
        </p>
    {% endfor %}
{% endblock %}
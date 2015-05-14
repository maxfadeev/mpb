{% extends "../../../templates/layout.volt" %}

{% block title %}Admin{% endblock %}

{% block content %}
    {{ content() }}
    {% for user in users %}
        <p>{{ user.login }}<a href="{{ url("/users/delete/id") }}/{{ user.id }}/{{ token }}">delete</a></p>
    {% endfor %}
{% endblock %}
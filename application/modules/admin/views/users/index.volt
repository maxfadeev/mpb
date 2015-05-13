{% extends "../../../templates/layout.volt" %}

{% block title %}Admin{% endblock %}

{% block content %}
    {{ content() }}
    {% for user in users %}
        <p>{{ user.login }}<a href="{{ url("a/users/delete/id") }}/{{ user.id }}/{{ security.getToken() }}">delete</a></p>
    {% endfor %}
{% endblock %}
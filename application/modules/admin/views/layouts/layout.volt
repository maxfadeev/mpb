{% extends "../../../templates/layout.volt" %}

{% block head %}
    <link href="http://cdn.everything.io/kickstart/3.x/css/kickstart.min.css" rel="stylesheet" />
    <link href="/css/main.css" rel="stylesheet" />
{% endblock %}

{% block title %}Admin{% endblock %}

{% block navigation %}
    <a href="{{ url("/users") }}">Users</a>
    <a href="{{ url("/articles") }}">Articles</a>
    <a href="{{ url("") }}">Dashboard</a>
{% endblock %}
{% block content %}
{% endblock %}

{% block scripts %}
    <script src='http://cdn.everything.io/kickstart/3.x/js/kickstart.min.js'></script>
{% endblock %}
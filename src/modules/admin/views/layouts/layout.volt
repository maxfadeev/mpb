{% extends "../../../templates/layout.volt" %}

{% block head %}
    <link href="http://cdn.everything.io/kickstart/3.x/css/kickstart.min.css" rel="stylesheet" />
    <link href="/css/main.css" rel="stylesheet" />
{% endblock %}

{% block container %}
    <div id="header">
        {% if auth.getIdentity() %}
            <a href="{{ url("/logout") }}">Logout</a>
        {% endif %}
    </div>
    <nav>
        <a href="{{ url("/users") }}">Users</a>
        <a href="{{ url("/articles") }}">Articles</a>
        <a href="{{ url("") }}">Dashboard</a>
    </nav>
{% endblock %}

{% block scripts %}
    <script src='http://cdn.everything.io/kickstart/3.x/js/kickstart.min.js'></script>
{% endblock %}

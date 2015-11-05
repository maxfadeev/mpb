{% extends "../../../templates/layout.volt" %}

{% block head %}
    <link href="/css/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="/bower_components/trumbowyg/dist/ui/trumbowyg.min.css">
{% endblock %}

{% block header %}
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
    <script src='/bower_components/jquery/dist/jquery.min.js'></script>
    <script src='/bower_components/trumbowyg/dist/trumbowyg.min.js'></script>
    <script src='/js/main.js'></script>
{% endblock %}

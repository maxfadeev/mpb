<!DOCTYPE html>
<html>
    <head>
        {% block head %}
            <link href="/public/css/main.css" rel="stylesheet" media="all" />
        {% endblock %}
        <title>{% block title %}{% endblock %} - Blog</title>
    </head>
    <body>
        <div id="header">
            <a href="{{ url("a/logout") }}">Logout</a>
        </div>
        <div id="content">
            {% block content %}{% endblock %}
        </div>

        <div id="footer">
            {% block footer %}{% endblock %}
        </div>
    </body>
</html>
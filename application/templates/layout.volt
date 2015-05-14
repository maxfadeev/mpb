<!DOCTYPE html>
<html>
    <head>
        {% block head %}
        <link href="http://cdn.everything.io/kickstart/3.x/css/kickstart.min.css" rel="stylesheet" />
        <link href="/public/css/main.css" rel="stylesheet" />
        {% endblock %}
        <title>{% block title %}{% endblock %} - Blog</title>
    </head>
    <body>
        <div id="header">
            {% if auth.getIdentity() %}
            <a href="{{ url("/logout") }}">Logout</a>
            {% endif %}
        </div>
        <div id="content">
            {% block content %}
            {% endblock %}
        </div>

        <div id="footer">
            {% block footer %}
            {% endblock %}
        </div>
        <script type='text/javascript' src='http://cdn.everything.io/kickstart/3.x/js/kickstart.min.js'></script>
    </body>
</html>
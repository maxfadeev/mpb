<!DOCTYPE html>
<html>
    <head>
        {% block head %}
        {% endblock %}
        <title>{% block title %}{% endblock %} - Blog</title>
    </head>
    <body>
        <div id="content">
            {% block content %}{% endblock %}
        </div>

        <div id="footer">
            {% block footer %}{% endblock %}
        </div>
    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        {% block head %}
            <title>{% block title %}{% endblock %} - Blog</title>
        {% endblock %}
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
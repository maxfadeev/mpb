<!DOCTYPE html>
<html>
    <head>
        {% block head %}
        {% endblock %}
        <title>{% block title %}{% endblock %}</title>
    </head>
    <body>
        <div id="header">
            {% if auth.getIdentity() %}
            <a href="{{ url("/logout") }}">Logout</a>
            {% endif %}
        </div>
        <div id="content">
            {% block navigation %}
            {% endblock %}
            {% block content %}
            {% endblock %}
        </div>

        <div id="footer">
            {% block footer %}
            {% endblock %}
        </div>
        {% block scripts %}
        {% endblock %}
    </body>
</html>
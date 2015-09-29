<!DOCTYPE html>
<html>
    <head>
        {% block head %}
        {% endblock %}
        <title>{% block title %}{% endblock %}</title>
    </head>
    <body>
        <div id="container">
            {% block container %}
            {% endblock %}
        </div>
        <footer>
            {% block footer %}
            {% endblock %}
        </footer>
        {% block scripts %}
        {% endblock %}
    </body>
</html>
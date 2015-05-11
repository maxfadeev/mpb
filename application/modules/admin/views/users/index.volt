{% extends "../../../templates/layout.volt" %}

{% block title %}Admin{% endblock %}

{% block content %}
    {{ content() }}
    {% for user in users %}
        <p>{{ user.login }}</p>
    {% endfor %}
{% endblock %}
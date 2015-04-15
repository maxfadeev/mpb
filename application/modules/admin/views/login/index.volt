{% extends "../../../templates/layout.volt" %}

{% block title %}Admin{% endblock %}

{% block content %}
    {{ content() }}
    <form method="post">
        {{ form.render('login') }}
        {{ form.render('password') }}
        {{ form.render('submit') }}
    </form>
{% endblock %}
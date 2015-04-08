{% extends "../../../templates/layout.volt" %}

{% block title %}Admin{% endblock %}

{% block content %}
    <form method="post">
        {# login #}
        {{ form.label('login') }}
        {{ form.render('login') }}
        {# email #}
        {{ form.label('email') }}
        {{ form.render('email') }}
        {# password #}
        {{ form.label('password') }}
        {{ form.render('password') }}
        {{ form.render('confirmPassword') }}

        {# CSRF security token #}
        <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}" />

        {{ form.render('submit') }}
    </form>
{% endblock %}
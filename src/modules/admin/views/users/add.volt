{% extends "layouts/layout.volt" %}

{% block title %}Create a new user{% endblock %}

{% block container %}
    {{ content() }}
    <form method="post">
        {# login #}
        {{ form.messages('login') }}
        {{ form.label('login') }}
        {{ form.render('login') }}
        {# email #}
        {{ form.messages('email') }}
        {{ form.label('email') }}
        {{ form.render('email') }}
        {# password #}
        {{ form.messages('password') }}
        {{ form.label('password') }}
        {{ form.render('password') }}
        {{ form.render('confirmPassword') }}
        {# role #}
        {{ form.label('role') }}
        {{ form.render('role') }}

        {# CSRF security token #}
        {{ form.messages('csrf') }}
        {{ form.render('csrf', ['name': security.getTokenKey(), 'value': security.getToken()]) }}

        {{ form.render('submit') }}
    </form>
    <a href="{{ url("/users") }}">Cancel</a>
{% endblock %}

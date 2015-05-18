{% extends "layouts/layout.volt" %}

{% block title %}Admin{% endblock %}

{% block content %}
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
        {{ form.messages('changePassword') }}
        {{ form.label('changePassword') }}
        {{ form.render('changePassword') }}
        {{ form.render('confirmChangePassword') }}
        {# role #}
        {{ form.label('role') }}
        {{ form.render('role') }}
        {# status #}
        {{ form.label('status') }}
        {{ form.render('status') }}

        {# CSRF security token #}
        {{ form.messages('csrf') }}
        {{ form.render('csrf', ['name': security.getTokenKey(), 'value': security.getToken()]) }}

        {{ form.render('submit') }}
    </form>
{% endblock %}
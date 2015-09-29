{% extends "layouts/layout.volt" %}

{% block title %}Admin{% endblock %}

{% block container %}
    <form method="post">
        {# login #}
        {{ form.messages('title') }}
        {{ form.label('title') }}
        {{ form.render('title') }}
        {# email #}
        {{ form.messages('text') }}
        {{ form.label('text') }}
        {{ form.render('text') }}

        {# CSRF security token #}
        {{ form.messages('csrf') }}
        {{ form.render('csrf', ['name': security.getTokenKey(), 'value': security.getToken()]) }}

        {{ form.render('submit') }}
    </form>
{% endblock %}
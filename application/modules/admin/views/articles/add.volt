{% extends "layouts/layout.volt" %}

{% block head %}
    <link href="http://cdn.everything.io/kickstart/3.x/css/kickstart.min.css" rel="stylesheet" />
    <link href="/css/main.css" rel="stylesheet" />
    <link href="/vendor/wysiwygjs/src/wysiwyg-editor.css" rel="stylesheet" />
{% endblock %}

{% block title %}Admin{% endblock %}

{% block content %}
    {{ content() }}
    <form method="post">
        {# login #}
        {{ form.messages('title') }}
        {{ form.label('title') }}
        {{ form.render('title') }}
        {# email #}
        {{ form.messages('text') }}
        {{ form.label('text') }}
        <div id="text-container">
        {{ form.render('text') }}
        </div>
        {# CSRF security token #}
        {{ form.messages('csrf') }}
        {{ form.render('csrf', ['name': security.getTokenKey(), 'value': security.getToken()]) }}

        {{ form.render('submit') }}
    </form>
{% endblock %}

{% block scripts %}
    <script src="//code.jquery.com/jquery-2.1.4.js"></script>
    <script src='/vendor/wysiwygjs/src/wysiwyg.js'></script>
    <script src='/vendor/wysiwygjs/src/wysiwyg-editor.js'></script>
    <script src='/js/main.js'></script>
{% endblock %}
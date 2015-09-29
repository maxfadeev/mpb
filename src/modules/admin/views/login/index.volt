{% extends "layouts/layout.volt" %}

{% block title %}Admin{% endblock %}

{% block container %}
    <div id="login-block">
        <form method="post">
            {{ form.render('login') }}
            {{ form.render('password') }}
            {{ form.render('submit') }}
        </form>
    </div>
{% endblock %}
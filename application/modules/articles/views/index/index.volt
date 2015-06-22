{% for article in articles %}
    <h2>{{ article.title }}</h2>
    <div>{{ article.text }}</div>
{% endfor %}
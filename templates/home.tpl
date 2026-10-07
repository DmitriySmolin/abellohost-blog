<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="container">
    <header class="header">
        <h1>Blog</h1>
    </header>

    {foreach $categories as $item}
        <section class="category">
            <div class="category__header">
                <h2>{$item.category.name}</h2>
                <p>{$item.category.description}</p>
            </div>
            <div class="article-list">
                {foreach $item.articles as $article}
                    <article class="article-card">
                        <h3 class="article-card__title">
                            <a href="/article.php?id={$article.id}">
                                {$article.title}
                            </a>
                        </h3>
                    </article>
                {/foreach}
            </div>
            <div class="actions">
                <a class="button" href="/category.php?id={$item.category.id}">
                    All articles
                </a>
            </div>
        </section>
    {/foreach}
</div>
</body>
</html>
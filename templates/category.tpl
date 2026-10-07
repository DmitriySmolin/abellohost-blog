<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$category.name}</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="container">
    <p class="actions">
        <a class="button" href="/">Home</a>
    </p>
    <header class="header">
        <h1>{$category.name}</h1>
        <p>{$category.description}</p>
    </header>

    <div class="sort">
        <a href="?id={$category.id}&sort=date">
            Sort by date
        </a>
        <a href="?id={$category.id}&sort=views">
            Sort by views
        </a>
    </div>

    <div class="article-list">
        {foreach $articles as $article}
            <article class="article-card">
                <h2 class="article-card__title">
                    <a href="/article.php?id={$article.id}">
                        {$article.title}
                    </a>
                </h2>

                <p class="article-card__description">
                    {$article.description}
                </p>
            </article>
        {/foreach}
    </div>

    <nav class="pagination">
        {for $i = 1 to $totalPages}
            <a href="?id={$category.id}&page={$i}&sort={$sort}">
                {$i}
            </a>
        {/for}
    </nav>
</div>
</body>
</html>
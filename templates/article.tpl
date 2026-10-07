<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title}</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="container">
    <p class="actions">
        <a class="button" href="/">Home</a>
    </p>
    <article class="article">
        <h1>{$article.title}</h1>

        <div class="article__meta">
            Views: {$article.views}
        </div>

        <p>{$article.description}</p>

        <img
                class="article__image"
                src="{$article.image}"
                alt="{$article.title}"
        >

        <div>
            {$article.content}
        </div>

        <p class="article__meta">
            Published: {$article.published_at}
        </p>

        <p>
            Categories:
            {foreach $categories as $category}
            <a href="/category.php?id={$category.id}">
                {$category.name}
                </a>{if !$category@last}, {/if}
            {/foreach}
        </p>
    </article>

    <section class="category">
        <h2>Related articles</h2>

        <div class="article-list">
            {foreach $relatedArticles as $item}
                <article class="article-card">
                    <h3 class="article-card__title">
                        <a href="/article.php?id={$item.id}">
                            {$item.title}
                        </a>
                    </h3>

                    <p class="article-card__description">
                        {$item.description}
                    </p>
                </article>
            {/foreach}
        </div>
    </section>
</div>
</body>
</html>
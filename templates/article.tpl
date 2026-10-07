<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{$title}</title>
</head>
<body>
<h1>{$article.title}</h1>
<p>
    Views: {$article.views}
</p>
<p>
    {$article.description}
</p>
<hr>
<p>
    {$article.content}
</p>
<hr>
<h2>Related articles</h2>
<img src="{$article.image}" alt="{$article.title}">
<p>Published: {$article.published_at}</p>
<p>
    Categories:
    {foreach $categories as $category}
    <a href="/category.php?id={$category.id}">
        {$category.name}
        </a>{if !$category@last}, {/if}
    {/foreach}
</p>
<ul>
    {foreach $relatedArticles as $item}
        <li>
            <a href="/article.php?id={$item.id}">
                {$item.title}
            </a>
        </li>
    {/foreach}
</ul>
</body>
</html>
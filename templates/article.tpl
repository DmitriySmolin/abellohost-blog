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
<ul>
    {foreach $relatedArticles as $item}
        <li>
            {$item.title}
        </li>
    {/foreach}
</ul>
</body>
</html>
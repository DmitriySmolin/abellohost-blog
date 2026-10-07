<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
</head>
<body>
<h1>{$category.name}</h1>
<p>{$category.description}</p>
<p>
    <a href="?id={$category.id}&sort=date">Sort by date</a>
    |
    <a href="?id={$category.id}&sort=views">Sort by views</a>
</p>
<hr>
{foreach $articles as $article}
    <h3>{$article.title}</h3>
    <p>{$article.description}</p>
{/foreach}
<hr>
{for $i = 1 to $totalPages}
    <a href="?id={$category.id}&page={$i}&sort={$sort}">
        {$i}
    </a>
{/for}
</body>
</html>
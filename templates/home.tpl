<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$title}</title>
</head>
<body>
<h1>Blog</h1>

{foreach $categories as $item}
    <h2>{$item.category.name}</h2>

    <ul>
        {foreach $item.articles as $article}
            <li>{$article.title}</li>
        {/foreach}
    </ul>
{/foreach}
</body>
</html>
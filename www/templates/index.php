

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Document</title>
</head>
<body>
<header>
    <h1>Главная</h1>
</header>
<main>
    <div class="sidebar">
        <a href="/"><h2>Категории</h2></a>
        <?php foreach ($categories as $category) :?>
            <a href="/<?=$category['id']?>"><?=$category['name']?></a>
        <?php endforeach;?>
        <a href="/categories"><button>Перейти к админ-панели</button></a>
    </div>
    <div class="main-cont">
        <div class="category-cont">
            <h2>Категории</h2>
            <?php
            if (isset($childCategories)):?>
            <?php foreach ($childCategories as $childCategory) :?>
                <a href="/<?=$childCategory['id']?>"><button><?=$childCategory['name']?></button></a>
            <?php endforeach;?>
            <?php endif;?>
        </div>

        <div class="card-container">
            <?php foreach ($goods as $good) :?>
                <div class="card">
                    <h3><?=$good['name']?></h3>
                    <p><?= $good['category_name']?></p>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</main>
</body>
</html>
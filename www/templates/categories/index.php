<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/styles.css">
    <style>
        header{
            display: flex;
            flex-direction: row;
            gap: 50px;
        }
    </style>
    <title>Категории</title>
</head>
<body>
<header style="background-color: #fb857c">
    <h1>Категории</h1>
    <a href="/"><button>На главную</button></a>
    <a href="/goods"><button>Перейти в CRUD-товаров</button></a>
</header>

<div  class="add-but">
    <a href="/categories/create"><button>+ Добавить категорию</button></a>
</div>
<table>
    <thead>
        <tr>
            <td>№</td>
            <td>Наименование</td>
            <td>Родительская категория</td>
            <td>Действия</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $category) :?>
        <tr>
            <td><?=$category['id']?></td>
            <td><?=$category['name']?></td>
            <?php if ($category['parent_category'] == null):?>
            <td></td>
            <?php else:?>
            <td><?=$category['parent_name']?></td>
            <?php endif;?>
            <td>
                <a href="/categories/edit/<?=$category['id']?>">Редактировать</a>
                <a href="/categories/delete/<?=$category['id']?>">Удалить</a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>

</body>
</html>
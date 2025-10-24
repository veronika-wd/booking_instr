<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../css/styles.css">
    <style>
        header{
            display: flex;
            flex-direction: row;
            gap: 50px;
        }
    </style>
    <title>Товары</title>
</head>
<body>
<header style="background-color: #fb857c">
    <h1>Товары</h1>
    <a href="/"><button>На главную</button></a>
    <a href="/categories"><button>Перейти в CRUD-категорий</button></a>
</header>

<div  class="add-but">
    <a href="/goods/create"><button>+ Добавить товар</button></a>
</div>
<table>
    <thead>
    <tr>
        <td>№</td>
        <td>Наименование</td>
        <td>Категория</td>
        <td>Действия</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($goods as $good) :?>
        <tr>
            <td><?=$good['id']?></td>
            <td><?=$good['name']?></td>
            <td><?=$good['category_name']?></td>
            <td>
                <a href="/goods/edit/<?=$good['id']?>">Редактировать</a>
                <a href="/goods/delete/<?=$good['id']?>">Удалить</a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>

</body>
</html>
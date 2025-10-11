<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Категории</title>
</head>
<body>
<h1>Категории</h1>
<a href="/categories/create"><button>+ Добавить категорию</button></a>
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
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>

</body>
</html>
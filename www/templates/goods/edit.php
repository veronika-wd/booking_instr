<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактирование категории</title>
</head>
<body>
<h1>Редактирование категории</h1>
<form action="/goods/edit/<?=$good['id']?>" method="post">
    <input type="text" name="name" placeholder="Наименование категории" value="<?=$good['name']?>" required>
    <select name="category" id="category">
        <?php foreach ($categories as $category) :?>
            <option value="<?=$category['id']?>"><?=$category['name']?></option>
        <?php endforeach;?>
    </select>
    <input type="submit" value="Редактировать">
</form>
</body>
</html>

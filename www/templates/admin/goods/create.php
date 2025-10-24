<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Создание товара</title>
</head>
<body>
<h1>Добавление товара</h1>
<form action="" method="post">
    <input type="text" name="name" placeholder="Наименование товара" required>
    <select name="category" id="category">
        <?php foreach ($categories as $category) :?>
            <option value="<?=$category['id']?>"><?=$category['name']?></option>
        <?php endforeach;?>
    </select>
    <textarea name="description" id="desc" cols="30" rows="10"></textarea>
    <input type="submit" value="Добавить">
</form>
</body>
</html>

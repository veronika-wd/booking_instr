<main>
    <div class="sidebar">
        <a href="/"><h2>Категории</h2></a>
        <a href="/catalog"><button>Каталог</button></a>
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
        <h2>Список товаров</h2>

        <div class="card-container">
            <?php foreach ($goods as $good) :?>
                <div class="card">
                    <h3><?=$good['name']?></h3>
                    <p><?= $good['category_name']?></p>
                    <a href="/show/<?=$good['id']?>">Подробнее</a>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</main>

<h1>Article</h1>

<p>
    модель для статьи, поста, новости
</p>

<h2>Запуск миграций</h2>
<pre class="prettyprint">
    php yii migrate --migrationPath=@kosuhin/Models/BusinessLogicModels/Article/migrations
</pre>

<h2>Пример</h2>
<pre class="prettyprint">
<?php

use kosuha606\Yii2BaseKit\Models\BusinessLogicModels\Article\Article;

$model = Yii::$app->arHelperService->findOne(Article::class, ['id' => 1], ['category']);
print_r($model);
?>
</pre>
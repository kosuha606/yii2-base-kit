<h1>ArrayHelperService</h1>

<pre class="prettyprint">
    Yii::$app->get('arrayHelperService')
</pre>

<p>
    Сервис предназначен для хранения логики работы с массивами
</p>

<h2>Методы</h2>
<table class="info-table" cellspacing="0" cellpadding="0">
    <thead>
    <tr>
        <th>Метод</th>
        <th>Аргументы</th>
        <th>Описание</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            arraySort
        </td>
        <td>
            <ul>
                <li>$array</li>
                <li>$field</li>
                <li>$sort</li>
            </ul>
        </td>
        <td>
            Сортирует переданный массив $array по полю $field в направлении $sort
        </td>
    </tr>
    <tr>
        <td>
            rotate90
        </td>
        <td>
            <ul>
                <li>$mat</li>
            </ul>
        </td>
        <td>
            Повернуть матрицу на 90 градусов
        </td>
    </tr>
    <tr>
        <td>
            toJson
        </td>
        <td>
            <ul>
                <li>$data</li>
            </ul>
        </td>
        <td>
            Перевести массив в JSON строку
        </td>
    </tr>
    <tr>
        <td>
            arraySearch
        </td>
        <td>
            <ul>
                <li>$array</li>
                <li>$column</li>
                <li>$value</li>
            </ul>
        </td>
        <td>
            Поиск элемента в массиве $array, у которого в колонке $column значение $value
        </td>
    </tr>
    <tr>
        <td>
            arraySearchAll
        </td>
        <td>
            <ul>
                <li>$array</li>
                <li>$column</li>
                <li>$value</li>
            </ul>
        </td>
        <td>
            Поиск всех элементов в массиве $array, у которых в колонке $column значение $value
        </td>
    </tr>
    <tr>
        <td>
            arrayColumn
        </td>
        <td>
            <ul>
                <li>$array</li>
                <li>$column</li>
            </ul>
        </td>
        <td>
            Получить массив всех значений из одной колонки $column
        </td>
    </tr>
    <tr>
        <td>
            getValue
        </td>
        <td>
            <ul>
                <li>$array</li>
                <li>$key</li>
                <li>$default</li>
            </ul>
        </td>
        <td>
            Получить из массива $array значение ключа $key, если ключа не существует вернуть $default
        </td>
    </tr>
    </tbody>
</table>
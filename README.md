Select2 widgets
================
Select2 Widget for Yii2

Preview
------------
<img src="https://lh3.googleusercontent.com/-SYtyKxfvZz4/VbCwEPzvxEI/AAAAAAAAAC4/Or5c1ObK7EM/s339-Ic42/select2Preview.png">

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist kak/select2 "*"
```

or add

```
"kak/select2": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?php
use kak\widgets\select2\Select2;
?>

<?= Select2::widget([
   'toggleEnable' => false,            // visible select all/unselect all
   'selectLabel' => 'select all',
   'unselectLabel' => 'unselect all',
   'options' => [
        'data-scroll-height' => 150,  // auto scroll
        'data-item-width'    => 100,  // 100|auto
   ]
   'multiple' => true,
   'value' => ['val1','val2'],
   'name' => 'inputName',
   'placeholder' => 'Choose a items...',
   'items' => [
        'val1' => 'options1',
        'val2' => 'options2',
        'val3' => 'options3',
        'val4' => 'options4',
   ],
]); ?>
```

```php
<?php
use kak\widgets\select2\Select2;
?>

<?= $form->field($model, 'list')->widget(Select2::class, [
    'items' => [
        'val1' => 'options1',
        'val2' => 'options2',
        'val3' => 'options3',
        'val4' => 'options4',
    ],
    'options' => [
        'class' => 'myCssClass'
    ],
    'clientOptions' => [],   // js options select2
]) ?>

```

Here is a professional **English README.md** documentation for your `Select2` Yii2 widget:

---

### ⚙️ Configuration Options

### Core Options

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `multiple` | `bool` | `false` | Enable multi-select mode |
| `theme` | `string` | `THEME_BOOTSTRAP` | `'bootstrap'` or `'classic'` |
| `placeholder` | `string\|null` | `null` | Placeholder text |
| `language` | `string\|null` | `null` | Language code (e.g. `'es'`, `'ru'`). Auto-detected if `autoLanguage=true` |
| `autoLanguage` | `bool` | `true` | Auto-detect language from Yii::$app->language |
| `items` | `array` | `[]` | Dropdown options `[value => label]` |
| `firstItemEmpty` | `bool` | `false` | Add empty option as first item (for single select) |

---

### AJAX & Dynamic Loading

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `ajax` | `string\|array` | `null` | URL or route for AJAX data loading |
| `ajaxCache` | `bool` | `true` | Cache AJAX results |
| `minimumInputLength` | `int` | `0` | Min chars before AJAX search triggers |
| `loadItemsUrl` | `string\|array` | `null` | URL to load initial items via AJAX |

Example:

```php
'ajax' => ['site/search-countries'],
'minimumInputLength' => 2,
```

---

### Loading Indicator

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `loadingShow` | `bool` | `true` | Show loading indicator |
| `loadIndicator` | `string` | `<div class="select2-pre-loading">loading </div>` | Custom HTML for loader |
| `loadingDelay` | `int` | `500` | Delay (ms) before showing loader |

---

### Counter & Toggle All (Multi-select only)

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `counterShow` | `bool` | `true` | Show "X of Y" counter |
| `counterTemplate` | `string` | `<span class="select2-counter"><span>0</span> of <span>0</span></span>` | Counter HTML template |
| `maxShowItems` | `int` | `3` | Max selected items to show before truncating |
| `toggleEnable` | `bool` | `true` | Show "Select All / Unselect All" buttons |
| `selectLabel` | `string` | `'Select all'` | Label for select all button |
| `unselectLabel` | `string` | `'Unselect all'` | Label for unselect all button |
| `selectIcon` | `string` | `<i class="glyphicon glyphicon-unchecked"></i>` | Icon for select all |
| `unSelectIcon` | `string` | `<i class="glyphicon glyphicon-check"></i>` | Icon for unselect all |

---

### Events

Subscribe to Select2 events using `events` array:

```php
'events' => [
    Select2::EVENT_SELECT => 'function(e) { console.log("Selected: ", e.params.data); }',
    Select2::EVENT_CHANGE => new JsExpression('function() { alert("Changed!"); }'),
],
```

Available events:

- `EVENT_CHANGE` → `change`
- `EVENT_OPEN` → `select2:open`
- `EVENT_CLOSE` → `select2:close`
- `EVENT_SELECT` → `select2:select`
- `EVENT_UNSELECT` → `select2:unselect`
- `EVENT_OPENING` → `select2:opening`
- `EVENT_CLOSING` → `select2:closing`
- `EVENT_SELECTING` → `select2:selecting`
- `EVENT_UNSELECTING` → `select2:unselecting`

---

### Advanced: Client Options & Template

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `clientOptions` | `array` | `[]` | Raw Select2 JS options (passed to JS plugin) |
| `template` | `string` | `'{input}{toggle}'` | Render template — `{input}` and `{toggle}` placeholders |

Example:

```php
'clientOptions' => [
    'allowClear' => true,
    'width' => 'resolve',
],
'template' => '<div class="my-wrapper">{input}</div>{toggle}',
```

---

### 🎨 Styling & Themes

Two built-in themes:

- `Select2::THEME_BOOTSTRAP` — Bootstrap 3/4 compatible (default)
- `Select2::THEME_DEFAULT` — Classic Select2 theme

You can override CSS classes:

```php
'options' => [
    'class' => 'form-control my-select2',
],
```

---

### 🌍 Internationalization (i18n)

Automatically uses Yii’s `Yii::$app->language` if `autoLanguage=true`.

You can force a language:

```php
'language' => 'es', // Spanish
'language' => 'zh-CN', // Chinese
```

> 💡 Supported languages: All Select2 built-in translations (es, ru, de, fr, pt-BR, etc.)

---

### 💡 Tips & Tricks

> ⚠️ Requires HTML structure: loader BEFORE container (adjust your template if needed).

---

### Custom Loader Delay

```php
'loadingDelay' => 300, // Show loader after 300ms
'loadIndicator' => '<div class="spinner">Loading...</div>',
```

---

### Tags Mode

Enable free-text tagging:

```php
'tags' => true,
'multiple' => true,
```

Or predefine tag list:

```php
'tags' => ['red', 'green', 'blue'],
```

---

### 📦 Assets & Dependencies

This widget automatically registers:

- Select2 core JS/CSS
- Language files (if needed)
- Bootstrap theme (if selected)
- Custom JS enhancements (`kakSelect2`)

No manual asset registration required.

---

### 🛠️ Extending & Customizing

You can extend the widget and override methods:

- `renderInput()` — customize dropdown rendering
- `renderToggleAll()` — customize select/unselect buttons
- `initOption()` — customize data attributes
- `registerAssets()` — customize asset registration

---

### 🧪 Example: Full Featured Multi-select

```php
echo Select2::widget([
    'name' => 'tags',
    'multiple' => true,
    'items' => ['php' => 'PHP', 'js' => 'JavaScript', 'css' => 'CSS'],
    'placeholder' => 'Select tags...',

    'ajax' => ['site/search-tags'],
    'minimumInputLength' => 1,

    'counterShow' => true,
    'toggleEnable' => true,
    'selectLabel' => 'Select All',
    'unselectLabel' => 'Clear All',

    'language' => 'en',
    'theme' => Select2::THEME_BOOTSTRAP,

    'events' => [
        Select2::EVENT_SELECT => 'function(e) { console.log("Added:", e.params.data.text); }',
        Select2::EVENT_UNSELECT => 'function(e) { console.log("Removed:", e.params.data.text); }',
    ],

    'clientOptions' => [
        'allowClear' => true,
    ],
]);
```

---

### Best practice for results ajax data

* 1 create common helper for result data

```php
<?php

namespace app\helpers;

use yii\db\ActiveQuery;
use yii\db\QueryInterface;
use yii\helpers\Html;
use yii\helpers\StringHelper;

final class Select2Helper
{
    private const RESULT_LIMIT = 150;   // portion size for output
    public const FORMAT_ID = 'id';      // displays as id => text
    public const FORMAT_RAW = 'raw';    // displays as is 
    public const FORMAT_SEP = 'sep';    // displays as  id => id | text

    /**
     * select2 settings for the clientOptions by default
     * @return true[]
     */
    public static function getClientOptions(): array
    {
        return [
            'allowClear' => true
        ];
    }

    /**
     * select2 settings for the options by default
     * @return int[]
     */
    public static function getOptions(): array
    {
        return [
            'data-scroll-height' => 150,
            'data-item-width' => 100,
        ];
    }

    /**
     * make ActiveQuery
     * @param string $className - class for search
     * @param string $attribute - search by the attribute
     * @param int|float|string|array|null $q - value by search
     * @param string $formatId - result format see const above class
     * @return QueryInterface
     */
    public static function makeQueryFind(
        string $className,
        string $attribute,
        int|float|string|array|null $q = null,
        string $formatId = self::FORMAT_SEP
    ): QueryInterface {

        $alias = strtolower(StringHelper::basename($className));
        $query = self::getQueryByClassName($className);
        $query->alias($alias);
        $query->asArray();

        $idAttribute = sprintf('%s.id', $alias);
        $attribute = sprintf('%s.%s', $alias, $attribute);

        match ($formatId) {
            self::FORMAT_SEP =>
            $query->select([
                $idAttribute,
                sprintf("CONCAT(%s, ' | ', %s) as text", $attribute, $idAttribute)
            ]),
            self::FORMAT_ID =>
            $query->select([
                $idAttribute,
                sprintf('CONCAT(%s, " [", %s,"]") AS text', $attribute, $idAttribute)
            ]),
            default =>
            $query->select([$idAttribute, $attribute . ' as text']),
        };



        if (is_string($q) && $q !== '') {
            $query->orFilterWhere(['LIKE', $attribute, $q]);
        }
        if (is_numeric($q) && (int)$q > 0) {
            $query->orWhere("$idAttribute=:id", [':id' => $q]);
        }
        if (is_iterable($q) && $q !== []) {
            $query->orWhere([$idAttribute => $q]);
        }
        return $query;
    }


    /**
     * get ActiveQuery by class name
     * @param string $className
     * @return ActiveQuery
     */
    private static function getQueryByClassName(string $className): ActiveQuery
    {
        return call_user_func([$className, 'find']);
    }

    /**
     * common result for ajax query for Select2 widget
     * @param QueryInterface $query
     * @param int $page
     * @param string $formatId
     * @return array
     */
    public static function asQueryToResults(
        QueryInterface $query,
        int $page = 1,
        string $formatId = self::FORMAT_SEP
    ): array {

        $queryTotal = clone $query;
        $total = $queryTotal->count();

        $offset = ($page - 1) * self::RESULT_LIMIT;
        $results = $query->offset($offset)->limit(self::RESULT_LIMIT)->asArray()->all();
        foreach ($results as $key => $data) {
            $results[$key]['text'] = match ($formatId) {
                self::FORMAT_ID => sprintf('[%s] %s', $data['id'], $data['text']),
                self::FORMAT_SEP => sprintf('%s | %s', $data['id'], $data['text']),
                default => sprintf('%s', $data['text']),
            };
        }

        return [
            'results' => $results,
            'total' => $total,
            'pagination' => [
                'more' => count($results) > 0
            ],
        ];
    }

    /**
     * common result for selected values for Select2 widget
     * @param QueryInterface $query
     * @param string $formatId
     * @return array
     */
    public static function asQueryToSelectedResult(QueryInterface $query, string $formatId = self::FORMAT_SEP): array
    {
        $items = $query->asArray()->all();
        $results = [];
        foreach ($items as $data) {
            $text = Html::encode($data['text']);

            $results[$data['id']] = match ($formatId) {
                self::FORMAT_ID => sprintf('[%s] %s', $data['id'], $text),
                self::FORMAT_SEP => sprintf('%s | %s', $data['id'], $text),
                default => $text,
            };
        }

        return $results;
    }
}

```

* 2 create DataSelectService
```php
<?php

namespace app\services;

use app\helpers\Select2Helper;

class DataSelectService extends BaseObject
{
    private const FORMAT_SEP = Select2Helper::FORMAT_SEP;
    private const FORMAT_RAW = Select2Helper::FORMAT_RAW;
    
    public int $page = 1;
     
    private function asResultsByQuery(QueryInterface $query, string $format): array
    {
        return Select2Helper::asQueryToResults($query, $this->page, $format);
    }

    private function asResultByList(QueryInterface $query, string $format): array
    {
        return Select2Helper::asQueryToSelectedResult($query, $format);
    }
    
    /** =============================== */
    
    private function getCountryQuery(): QueryInterface
    {
        return Country::find()->select([
            "id",
            'text' => new Expression(
                implode(PHP_EOL, [
                    'CASE', 'WHEN',
                    "name_ru IS NOT NULL AND name_ru != '' THEN name_ru",
                    'ELSE',
                    'name_en',
                    'END'
                ])
            )
        ]);
    }
    
    /**
      * result for ajax query
      * @param string|null $q
      * @return array
     */
    public function searchCountry(?string $q): array
    {
        $query = $this->getCountryQuery();
        $query->andFilterWhere(['OR', ['like', 'name_ru', $q], ['like', 'name_en', $q], ['like', 'id', $q]]);
        return $this->asResultsByQuery($query, self::FORMAT_RAW);
    }
    
    /**
     * result for selected values in filter form
     * @param array $list
     * @return array
     */
    public function getCountryByList(array $list): array
    {
        $query = $this->getCountryQuery();
        $query->andWhere(['id' => $list]);
        return $list !== [] ? $this->asResultByList($query, self::FORMAT_RAW) : [];
    }
    
    // ...
}
```

* 3 create ajax controller apply up code
```php
<?php

namespace app\controllers;

class AjaxController extends Controller
{
     public ?DataSelectService $dataSelect = null;

    public function init()
    {
        parent::init();

        Yii::$app->response->format = Response::FORMAT_JSON;
        $lang = strtolower(Yii::$app->language);
        $language = match(true) {
           str_contains($lang, 'en') => 'en',
           default => 'ru'
        };
        // init service
        $this->dataSelect = new DataSelectService([
            'language' => $language,
            'page' => (int)$this->request->get('page', 1),
        ]);
    }


    /**
     * optional only auth users
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
     /**
     * Country list for select2 widget
     * @param string|null $q
     * @return array
     */
    public function actionLoadCountry(?string $q = null): array
    {
        return $this->dataSelect->searchCountry($q);
    }
}
```
* 4 create filter trait base
```php
<?php

namespace app\models\filters;
   
   
trait BaseFilterTrait
{
    /**
     * @throws UnknownPropertyException
     */
    private function findAttributeName(array $list): ?string
    {
        $attribute = null;
        foreach ($list as $name) {
            if ($this->hasProperty($name)) {
                $attribute = $name;
                break;
            }
        }
        if ($attribute === null) {
            throw new UnknownPropertyException(
                sprintf('The class does not realize the property from the list [%s]', implode(', ', $list))
            );
        }
        return $attribute;
    }

    private function getFilterValueByAttribute(string $attribute): array
    {
        $value = $this->{$attribute};
        return is_iterable($value) ? $value : [$value];
    }
}
```

* 5 create trait filter for search form
```php
<?php

namespace app\models\filters;

use app\services\DataSelectService;
use yii\base\UnknownPropertyException;

trait CountryFromFilterTrait
{
    use BaseFilterTrait;

    /**
     * @throws UnknownPropertyException
     */
    public function getCountryFromFilter(): array
    {
        static $countries;
        $attribute = $this->findAttributeName(['countryId', 'country_id', 'country']);
        if ($countries === null) {
            $dataSelect = new DataSelectService();
            $cities = $dataSelect->getCountryByList($this->getFilterValueByAttribute($attribute));
        }
        return $cities ?? [];
    }
}

```

* 6 bind filter for search form
```php
class UserRegistration extends Model
  {
       use CountryFromFilterTrait;
       public $countryId;  
  }
}
```

* 7 render view

```php

<?php
/*
$selectConfig = [
    'theme' => Select2::THEME_DEFAULT,
    'multiple' => true,
    'loadingShow' => true,
    'loadingDelay' => 300,
    'counterShow' => true,
    'counterTemplate' => sprintf(
        '<span class="select2-counter"><span>0</span> %s <span>0</span></span>',
        Yii::t('app', 'of')
    ),
    'choiceDirection' => Select2::DIRECTION_RIGHT,
    'options' => [
        'class' => $selectClass,  // add custom css class
    ],
    'toggleEnable' => false,     // 
    'clientOptions' => [
        'allowClear' => true,
    ],
]
*/
?>
 <?= $form->field($model, 'country_id')->widget(Select2::class, [
    'placeholder' => $countryFilterPlaceholder, // custom set placeholder
    'items' => $model->getCountryFromFilter(),  // UserRegistration model
    'ajax' => ['ajax/load-country'],            // set ajax url
    ...$selectConfig
]) ?>



```

### 📄 License

MIT

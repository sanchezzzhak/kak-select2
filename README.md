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
php composer.phar require --prefer-dist kak/select2 "dev-master"
```

or add

```
"kak/select2": "dev-master"
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
'ajaxCache' => false,
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

### 📄 License

MIT

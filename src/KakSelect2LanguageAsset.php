<?php

namespace kak\widgets\select2;

use yii\web\AssetBundle;

/**
 * Class KakSelect2LanguageAsset
 * @package kak\widgets\select2
 */
class KakSelect2LanguageAsset extends AssetBundle
{
    public $sourcePath = '@bower/select2/dist';

    public $depends = [
        Select2Asset::class
    ];

    /**
     * Add selected language
     *
     * @param string|null $lang
     * @return $this
     */
    public function addLanguage(?string $lang = null)
    {
        if ((string)$lang === '') {
            return $this;
        }

        $fullpath = \Yii::getAlias($this->sourcePath . '/js/i18n/' . $lang . '.js');
        if (is_file($fullpath)) {
            $this->js[] = 'js/i18n/' . $lang . '.js';
            return $this;
        }

        $lang = explode('-', $lang)[0] ?? $lang;
        $lang = !empty($lang) ? $lang : 'en';
        $this->js[] = 'js/i18n/' . strtolower($lang) . '.js';

        return $this;
    }
}
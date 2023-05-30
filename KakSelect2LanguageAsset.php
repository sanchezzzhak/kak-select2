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
     * @param $lang
     * @return $this
     */
    public function addLanguage($lang = null)
    {
        if ($lang === false) {
            return $this;
        }

        $lang = !empty($lang) ? $lang : 'en';
        $this->js[] = 'js/i18n/' . $lang . '.js';

        return $this;
    }
}
<?php

namespace app\models;


class TestModel extends \yii\base\Model
{
    public $countryId;
    public $cityId;

    public function rules(): array
    {
        return [
            [['cityId', 'countryId'], 'each', 'rule' => 'integer'],
        ];
    }

}
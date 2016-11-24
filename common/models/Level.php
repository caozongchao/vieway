<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "level".
 *
 * @property integer $id
 * @property integer $level
 */
class Level extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level'], 'required'],
            [['level'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => '质量等级',
        ];
    }

    public static function getLevelList()
    {
        return self::find()->select(['level'])->indexBy('id')->column();
    }

    public static function getLevelAlias()
    {
        return ['1' => '☆','2' => '☆☆','3' => '☆☆☆','4' => '☆☆☆☆','5' => '☆☆☆☆☆'];
    }
}

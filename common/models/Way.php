<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "way".
 *
 * @property integer $id
 * @property string $name
 * @property integer $view_id
 * @property string $view_path
 */
class Way extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'way';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'view_id'], 'required'],
            [['view_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
            // [['view_path'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '路线名称',
            'view_id' => '景区ID',
            'view_path' => '景点顺序',
        ];
    }
}

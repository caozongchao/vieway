<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view_detail".
 *
 * @property integer $id
 * @property string $name
 * @property string $summary
 * @property integer $view_id
 */
class ViewDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'view_id'], 'required'],
            [['summary'], 'string'],
            [['view_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '景点名称',
            'summary' => '景点概述',
            'view_id' => '景区ID',
        ];
    }
}

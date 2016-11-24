<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "addi".
 *
 * @property string $id
 * @property string $code
 * @property string $province
 * @property string $city
 * @property string $parent_id
 * @property string $create_time
 * @property string $district
 * @property string $last_update_time
 * @property string $operator
 * @property string $operator_ip
 */
class Addi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'addi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'operator'], 'integer'],
            [['create_time', 'last_update_time'], 'safe'],
            [['code', 'province', 'city', 'district'], 'string', 'max' => 40],
            [['operator_ip'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => '地区代码',
            'province' => '省份',
            'city' => '城市',
            'parent_id' => '父级ID',
            'create_time' => '创建时间',
            'district' => '区',
            'last_update_time' => '上次更新时间',
            'operator' => '操作人',
            'operator_ip' => '操作人IP',
        ];
    }

    public static function getProvinces()
    {
        return Addi::find()->select(['province'])->where(['parent_id' => 1])->indexBy('id')->column();
    }

    public static function getCitys($provinceId)
    {
        return Addi::find()->select(['city'])->where(['parent_id' => $provinceId])->indexBy('id')->column();
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prova_trail".
 *
 * @property integer $id
 * @property string $nome
 * @property string $cognome
 * @property string $telefono
 */
class Trail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prova_trail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'cognome', 'telefono'], 'required'],
            [['nome', 'cognome'], 'string', 'max' => 40],
            [['telefono'], 'string', 'max' => 13]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'telefono' => 'Telefono',
        ];
    }

    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
        ];
    }
}

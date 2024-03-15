<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public $Rpassword;

    public static function tableName()
    {
        return 'user';
    }
    public function rules()
    {
        return [
            [['name', 'username', 'telefono', 'rol'], 'required'],
            ['telefono', 'string', 'max' => 10, 'min' => 10],
            ['telefono', 'match', 'pattern' => '/^\d{1,10}$/', 'message' => 'El teléfono debe contener máximo 10 dígitos.'],
            [['password', 'Rpassword'], 'required', 'on' => 'updateWithPassword'],
            [['name', 'username', 'telefono'], 'required', 'on' => 'updateWithoutPassword'],
            ['Rpassword', 'comparePasswords'],
        ];
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->password) && $this->isAttributeChanged('password')) {
                $this->password = sha1($this->password);
                $this->markAttributeDirty('password');
            }
            return true;
        }
        return false;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }



    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function comparePasswords($attribute, $params)
    {
        //if (!$this->hasErrors()) { // Solo realiza la comprobación si no hay otros errores de validación
        if ($this->password !== $this->Rpassword) {
            $this->addError($attribute, 'La contraseña y su confirmación no coinciden.');
        }
        //}
    }
}

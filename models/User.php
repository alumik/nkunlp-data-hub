<?php

namespace app\models;

use yii\base\BaseObject;
use yii\web\IdentityInterface;

class User extends BaseObject implements IdentityInterface
{
    public $id;
    public $nickname;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'nickname' => '李东闻',
            'username' => 'lidongwen',
            'password' => 'lidongwen!@#',
            'authKey' => 'lidongwen-key',
            'accessToken' => 'lidongwen-token',
        ],
        '101' => [
            'id' => '101',
            'nickname' => '钟震宇',
            'username' => 'zhongzhenyu',
            'password' => 'zhongzhenyu!@#',
            'authKey' => 'zhongzhenyu-key',
            'accessToken' => 'zhongzhenyu-token',
        ],
    ];

    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public static function findByUsername($username): ?User
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey(): ?string
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password): bool
    {
        return $this->password === $password;
    }
}

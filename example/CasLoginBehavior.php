<?php

namespace alcad\cas\example;

use alcad\cas\Cas;
use alcad\cas\FindLocalUserEvent;
use common\models\User;
use yii\base\Behavior;
use Yii;

/**
 * Class CasLoginBehavior
 * @package alcad\cas\example
 */
class CasLoginBehavior extends Behavior
{

    /**
     * @return array
     */
    public function events()
    {
        return [
            Cas::EVENT_FIND_LOCAL_USER => 'findLocalUser'
        ];
    }

    /**
     * find local user by cas user. if not exists, create new.
     * @param $event FindLocalUserEvent
     */
    public function findLocalUser($event)
    {
        $casUser = $event->casIdentity->getUser();
        $identityClass = Yii::$app->getUser()->identityClass;
        $user = $identityClass::findIdentity($casUser);

        if(!$user) {
            $user = new User();
            $user->scenario = 'oauth_create';
            $user->username = $casUser;
            $user->email = $casUser.'@yourdomain.com';

            $password = Yii::$app->security->generateRandomString(8);
            $user->setPassword($password);
            if ($user->save()) {
                $user->afterSignup();
            } else {
                $user = null;
            }
        }

        $event->localIdentity = $user;

    }

}

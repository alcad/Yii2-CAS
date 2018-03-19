<?php
/**
 * Created by PhpStorm.
 * User: riverlet
 * Date: 2017/7/7
 * Time: 1:06
 */

namespace alcad\cas;


class FindLocalUserEvent extends \yii\base\Event
{
    public $casIdentity;

    public $localIdentity;

}
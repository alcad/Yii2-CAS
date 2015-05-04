<?php

namespace alcad\yii2-cas\controllers;

use phpCAS;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class CasController extends Controller
{

	public function actionLogin()
	{
		phpCAS::forceAuthentication();
		return $this->redirect(Yii::$app->homeUrl);
	}

	public function actionLogout()
	{
		$url = Yii::$app->homeUrl;
		$ret_url = Url::toRoute($url, true);

		if (phpCAS::isAuthenticated())
		{
			phpCAS::logout(['service' => $ret_url]);
		}
		return $this->redirect(Yii::$app->homeUrl);
	}

}

<?php

namespace alcad\cas\controllers;

use phpCAS;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class CasController extends Controller
{

	public function actionLogin()
	{
		phpCAS::forceAuthentication();
		return $this->goBack();
	}

	public function actionLogout()
	{
		$url = Yii::$app->homeUrl;
		$ret_url = Url::toRoute(['/'], true);

//		if (phpCAS::isAuthenticated())
		if (phpCAS::checkAuthentication())
		{
			phpCAS::logout(['service' => $ret_url]);
		}
		return $this->redirect($url);
	}

}

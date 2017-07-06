<?php

namespace alcad\cas\controllers;

use phpCAS;
use Yii;
use yii\web\Controller;

class CasController extends Controller
{

	public function actionLogin()
	{
		$ret_url = Yii::$app->request->referrer ?: Yii::$app->homeUrl.'/';
		$_SERVER['REQUEST_URI'] = parse_url($ret_url, PHP_URL_PATH).'?'.parse_url($ret_url, PHP_URL_QUERY);

		phpCAS::forceAuthentication();
		return $this->goBack();
	}

	public function actionLogout()
	{

		$ret_url = Yii::$app->request->referrer ?: Yii::$app->homeUrl.'/';

//		if (phpCAS::isAuthenticated())
		if (phpCAS::checkAuthentication())
		{
			phpCAS::logout(['service' => $ret_url]);
		}

	}

}

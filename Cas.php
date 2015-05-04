<?php

namespace app\modules\cas;

use phpCAS;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Module;

class Cas extends Module implements BootstrapInterface
{
	public $controllerNamespace = 'app\modules\cas\controllers';

	public function bootstrap($app)
	{
		if ($app->hasModule('cas') && ($module = $app->getModule('cas')) instanceof Module)
		{
			$this->_avviaCas();
			$this->_yiiAccess();
			$this->_sputaCazzate();
		}
	}

	private function _yiiAccess()
	{
		if(!Yii::$app->casUser->isGuest) {
			$u = new CasInterface();
			$u->username = Yii::$app->casUser->getUser();

			\Yii::$app->getUser()->login($u);
		}else{
			\Yii::$app->getUser()->logout(true);
		}
//		$u-> setIdentity(Yii::$app->casUser->getUser());
//		Yii::$app->user->login(Yii::$app->casUser->getUser());
	}

	private function _sputaCazzate()
	{
		echo "<br><br><br>";
		var_dump("cas avviato via bootstrap");
		var_dump(Yii::$app->casUser->isGuest);
	}

	private function _avviaCas()
	{
		$params = Yii::$app->params['cas'];
		$host = $params['host'];
		$port = $params['port'];
		$uri = $params['uri'];

		// Enable debugging
		phpCAS::setDebug();

		// Initialize phpCAS
		phpCAS::client(CAS_VERSION_2_0, $host, $port, $uri);
		phpCAS::setNoCasServerValidation();
	}

}

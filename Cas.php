<?php

namespace alcad\cas;

use phpCAS;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Module;

class Cas extends Module implements BootstrapInterface
{
	const EVENT_FIND_LOCAL_USER = 'findLocalUser';

	public $controllerNamespace = 'alcad\cas\controllers';
	public $host;
	public $port;
	public $uri;
	public $logFile;

	private $casUser;


	public function bootstrap($app)
	{
		if ($app->hasModule('cas') && ($module = $app->getModule('cas')) instanceof Module)
		{
			$this->_startCAS();
			if (\Yii::$app->user->isGuest)
			{
				$this->_yiiAccess();
			}
		}
	}

	private function _yiiAccess()
	{
		if (!$this->casUser->isGuest)
		{
			$localUser = $this->findLocalUser($this->casUser);
			if($localUser) {
				\Yii::$app->getUser()->login($localUser);
			}
		}
		else
		{
			\Yii::$app->getUser()->logout(true);
		}
	}

	private function _startCAS()
	{
		// Enable debugging
		phpCAS::setDebug($this->logFile);

		// Initialize phpCAS
		phpCAS::client(CAS_VERSION_2_0, $this->host, $this->port, $this->uri);
		phpCAS::setNoCasServerValidation();
		$this->casUser = Yii::createObject('alcad\cas\CasUser');
	}

	protected function findLocalUser($casUser)
	{
		$event = new FindLocalUserEvent([
			'casIdentity' => $casUser,
		]);
		$this->trigger(self::EVENT_FIND_LOCAL_USER, $event);
		return $event->localIdentity;
	}

}

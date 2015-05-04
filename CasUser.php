<?php

namespace alcad\cas;

use phpCAS;
use yii\base\Component;

class CasUser extends Component
{
	public $isGuest;

	public function init()
	{
		$this->isGuest = $this->isGuest();
	}

	private function isGuest()
	{
		$this->isGuest = !phpCAS::isAuthenticated();
		return $this->isGuest;
	}

	public function getUser()
	{
		return $this->_user();
	}

	private function _user()
	{
		if (phpCAS::isAuthenticated())
		{
			return phpCAS::getUser();
		}
		else
		{
			return "Guest";
		}
	}

}

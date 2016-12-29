<?php

class App_Controllers_Base extends MvcCore_Controller
{
	protected static $staticPath = '/static/';
	protected static $tmpPath = '/Var/Tmp';
	public function PreDispatch () {
		parent::PreDispatch();
		if (!$this->ajax && $this->request->params['controller'] !== 'assets') {
			App_Views_Helpers_Assets::SetGlobalOptions(array(
				'cssMinify'	=> 1,
				'cssJoin'	=> 1,
				'jsMinify'	=> 1,
				'jsJoin'	=> 1,
				'tmpDir'	=> self::$tmpPath,
			));
			$this->view->Css('fixedHead')
				->AppendRendered(self::$staticPath . 'css/all.css');
			$this->view->Js('fixedHead')
				->Append(self::$staticPath . 'js/libs/class.min.js')
				->Append(self::$staticPath . 'js/libs/ajax.min.js')
				->Append(self::$staticPath . 'js/libs/Module.js');
			$this->view->Js('varFoot')
				->Append(self::$staticPath . 'js/Front.js');
		}
	}
	protected function redirectToNotFound () {
		self::Redirect(
			$this->url('Default::NotFound'), 
			404
		);
	}
}
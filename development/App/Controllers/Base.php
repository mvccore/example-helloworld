<?php

class App_Controllers_Base extends MvcCore_Controller
{
	public function PreDispatch () {
		parent::PreDispatch();
		if (!$this->ajax) {

			MvcCoreExt_ViewHelpers_Assets::SetGlobalOptions(array(
				'cssMinify'		=> 1,
				'cssJoin'		=> 1,
				'jsMinify'		=> 1,
				'jsJoin'		=> 1,
			));

			$static = self::$staticPath;
			$this->view->Css('fixedHead')
				->AppendRendered($static . '/css/all.css');
			$this->view->Js('fixedHead')
				->Append($static . '/js/libs/class.min.js')
				->Append($static . '/js/libs/ajax.min.js')
				->Append($static . '/js/libs/Module.js');
			$this->view->Js('varFoot')
				->Append($static . '/js/Front.js');

		}
	}
}
<?php

namespace App\Controllers;

class Base extends \MvcCore\Controller
{
	public function PreDispatch () {
		parent::PreDispatch();
		if (!$this->ajax) {

			\MvcCore\Ext\Views\Helpers\Assets::SetGlobalOptions([
				'tmpDir'		=> '~/Var/Tmp',
				'cssMinify'		=> 1,
				'cssJoin'		=> 1,
				'jsMinify'		=> 1,
				'jsJoin'		=> 1,
			]);
			
			$static = $this->application->GetPathStatic();
			$this->view->Css('fixedHead')
				->Append($static . '/css/old-browsers-warning.css')
				->AppendRendered($static . '/css/layout.css') // render links to assets defined in PHP 
				->Append($static . '/css/content.css')
				->Append($static . '/css/fixes.css');
			$this->view->Js('fixedHead')
				->Append($static . '/js/libs/class.min.js')
				->Append($static . '/js/libs/ajax.min.js')
				->Append($static . '/js/libs/Module.js');
			$this->view->Js('varFoot')
				->Append($static . '/js/Front.js');

			$this->view->basePath = $this->GetRequest()->GetBasePath();
		}
	}
}

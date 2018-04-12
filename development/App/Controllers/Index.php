<?php

namespace App\Controllers;

class Index extends Base
{
    public function IndexAction () {
		$this->view->Title = "MvcCore Hello World Example";
		$this->view->Version = \MvcCore\Interfaces\IApplication::VERSION;
		$this->view->CompileMode =  $this->application->GetCompiled();
    }
	public function NotFoundAction () {
		$this->view->Title = "Error 404 - requested page not found.";
		$this->view->Message = $this->request->GetParam('message');
	}
}
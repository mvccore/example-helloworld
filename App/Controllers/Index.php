<?php

namespace App\Controllers;

class Person extends \MvcCore\Model {
	public string $name;
}

class Index extends Base
{
    public function IndexAction(){
		$this->view->title = "Hello World!";
		$this->view->version = \MvcCore\Application::VERSION;
		$this->view->compileMode = $this->application->GetCompiled();
	}
	public function NotFoundAction(){
		$this->ErrorAction();
	}
	public function ErrorAction(){
		$code = $this->response->GetCode();
		if ($code === 200) $code = 404;
		$message = $this->request->GetParam('message', 'a-zA-Z0-9_;, \\/\-\@\:\.');
		$message = preg_replace('#`([^`]*)`#', '<code>$1</code>', $message);
		$message = str_replace("\n", '<br />', $message);
		$this->view->title = "Error $code";
		$this->view->message = $message;
		$this->Render('error');
	}
}


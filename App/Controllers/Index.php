<?php

namespace App\Controllers;

class Index extends Base {

	/**
	 * Render homepage.
	 * @return void
	 */
    public function IndexAction () {
		$this->view->title = "Hello World!";
		$this->view->version = \MvcCore\Application::VERSION;
		$this->view->compileMode = $this->application->GetCompiled();
		// try to dump something into build-in debug bar:
		//x($this->request);
	}
	
    /**
	 * Render not found action.
	 * @return void
	 */
	public function NotFoundAction(){
		$this->ErrorAction();
	}

	/**
	 * Render possible server error action.
	 * @return void
	 */
	public function ErrorAction () {
		$code = $this->response->GetCode();
		if ($code === 200) $code = 404;
		$this->view->title = "Error {$code}";
		$this->view->message = $this->request->GetParam('message', FALSE);
		$this->Render('error');
	}
}


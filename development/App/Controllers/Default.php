<?php

class App_Controllers_Default extends App_Controllers_Base
{
    public function HomeAction () {
		$this->view->Title = "Hello world!";
		$this->view->Version = MvcCore::VERSION;
		$this->view->CompileMode =  MvcCore::GetInstance()->GetCompiled();
    }
	public function NotFoundAction () {
		$this->view->Title = "Error 404 - requested page not found.";
		$this->view->Message = $this->request->Params['message'];
	}
}
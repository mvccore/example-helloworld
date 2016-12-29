<?php

class App_Controllers_Default extends App_Controllers_Base
{
    public function Init () {
        parent::Init();
    }
    public function PreDispatch() {
        parent::PreDispatch();
    }
    public function DefaultAction () {
		$this->view->Title = 'Hello world!';
    }
    public function NotFoundAction () {
    }
}
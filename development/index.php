<?php

	@include_once('vendor/mvccore/mvccore/src/startup.php');
	@include_once('vendor/autoload.php');

	\App\Bootstrap::Init();

	\MvcCore\Application::GetInstance()->Run(1);
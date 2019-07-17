<?php
	
	require '../../vendor/autoload.php';

	$app = new \Slim\App(['settings' => require __DIR__ . '/settings.php']);

	require __DIR__ . '/container.php';

	require __DIR__ . '/routes.php';

	return $app;
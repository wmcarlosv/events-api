<?php 

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use App\User;

	//Route Init
	$app->get('/', function (Request $request, Response $response) {
	    
	});

	$app->group('/api', function() use ($app){
		//Users Routers

		$app->post('/login', function(Request $request, Response $response){
			$data = $request->getQueryParams();
			$user_data = [];
			$user_data['email'] = filter_var($data['email'], FILTER_SANITIZE_STRING);
			$user_data['password'] = filter_var($data['password'], FILTER_SANITIZE_STRING);
			$user = new User($this->db, $user_data);
			return $response->withJson($user->login())
							->withHeader('Access-Control-Allow-Origin', '*')
							->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
		});
		
		$app->get('/users', function(Request $request, Response $response){
			$user = new User($this->db, $user_data);
			return $response->withJson($user->getAllUsers());

		});

		$app->get('/user/{id}', function(Request $request, Response $response, $args){
			$id = $args['id'];
			$user_data['id'] = filter_var($id, FILTER_SANITIZE_STRING);
			$user = new User($this->db, $user_data);
			return $response->withJson($user->getUser());
		});

		$app->post('/user/add', function(Request $request, Response $response){
			$data = $request->getQueryParams();
			$user_data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
			$user_data['email'] = filter_var($data['email'], FILTER_SANITIZE_STRING);
			$user_data['password'] = filter_var($data['password'], FILTER_SANITIZE_STRING);
			$user_data['role'] = filter_var($data['role'], FILTER_SANITIZE_STRING);
			$user = new User($this->db, $user_data);
			return $response->withJson($user->add_user());
		});

		$app->put('/user/edit/{id}', function(Request $request, Response $response, $args){
			$data = $request->getQueryParams();
			$id = $args['id'];
			$user_data['id'] = filter_var($id, FILTER_SANITIZE_STRING);
			$user_data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
			$user_data['email'] = filter_var($data['email'], FILTER_SANITIZE_STRING);
			$user = new User($this->db, $user_data);
			return $response->withJson($user->edit_user());
		});

		$app->put('/user/change_password/{id}', function(Request $request, Response $response, $args){
			$data = $request->getQueryParams();
			$id = $args['id'];
			$user_data['id'] = filter_var($id, FILTER_SANITIZE_STRING);
			$user = new User($this->db, $user_data);
			return $response->withJson($user->change_password());
		});

		$app->delete('/user/delete/{id}', function(Request $request, Response $response, $args){
			$id = $args['id'];
			$user_data['id'] = filter_var($id, FILTER_SANITIZE_STRING);
			$user = new User($this->db, $user_data);
			return $response->withJson($user->delete_user());
		});

		//Events Routers
	});

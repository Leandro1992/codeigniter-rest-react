<?php namespace App\Controllers;

use App\Models\LoginModel;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function login()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, OPTIONS");
		try {
			$LoginModel = new LoginModel();
			$user = $LoginModel->where('name', $this->request->getPost('name'))->where('password', $this->request->getPost('password'))->first();
			if($user) {
				$data = [
					'success' => true,
					'token' => 'cd827405-66cd-419d-8b02-63bddc02a55f',
				];
				return $this->response->setJSON($data)->setStatusCode(200);
			}else{
				$data = [
					'success' => false,
					'data' => null
				];
				return $this->response->setJSON($data);
			}	
		} catch (\Throwable $th) {
			return $this->response->setJSON($th)->setStatusCode(500);
		}
		
	}

	public function getCepData()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, OPTIONS");
		try {
			$cep = $this->request->getPost('cep');
			if($cep) {
					$client = \Config\Services::curlrequest();
					$response = $client->request('GET', 'http://localhost:3002/getNearbyData?cep='.$cep);
					return $this->response->setJSON($response->getBody())->setStatusCode(200);
			}else{
				$data = [
					'success' => false,
					'data' => 'CEP Not Found!'
				];
				return $this->response->setJSON($data)->setStatusCode(404);
			}	
		} catch (\Exception $e) {
			return $this->response->send($e->getMessage())->setStatusCode(500);
		}
		
	}

	public function getUsers()
	{
		$LoginModel = new LoginModel();
		$users = $LoginModel->findAll();
		return $this->response->setJSON($users)->setStatusCode(200);
	}
}
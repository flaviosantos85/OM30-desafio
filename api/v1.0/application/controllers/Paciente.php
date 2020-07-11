<?php

require(APPPATH.'libraries/REST_Controller.php');
require(APPPATH.'libraries/Format.php');
require(APPPATH.'libraries/TCNSValidator.class.php');
require(APPPATH.'helpers/valida_cpf.php');




use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends REST_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 * 
	 */

	 public function __construct(){
		
		parent::__construct();
		$this->load->model('pacientemodel');
	 }


	public function add_paciente_post()
	{
		
		// nothing to proccess (no fields)
		if(!$_POST){
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header('400')
            ->set_output(json_encode(['message' => 'Request Failure', 'status' => 400]));	
        }
        
        //array with patient's post data
        $data = array('nome', 'nome-mae', 'dt-nasc', 'cep', 'end-completo', 'cpf', 'cns', 'numero');
        
		$i = 0;
		$feedback = 'Os seguintes campos estao em branco: ';
		$hasInputEmpty = false;
		

		// check whether missing fields
        for($i; $i < count($data); $i++){
            if(!array_key_exists($data[$i], $_POST)){
				
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header('400')
                ->set_output(json_encode(['message' => 'faltando campos obrigatorios', 'status' => 400]));	   
			}
			if(empty($_POST[$data[$i]])){
				$feedback .= $data[$i].' ';
				$hasInputEmpty = true;
			}
			
		}
		
		if($hasInputEmpty){
			return $this->output
                ->set_content_type('application/json')
                ->set_status_header('400')
                ->set_output(json_encode(['message' => trim($feedback), 'status' => 400]));	   
		}

		
		 if(validaCPF($_POST['cpf']) == ''){
			return $this->output
			->set_content_type('application/json')
			->set_status_header('400')
			->set_output(json_encode(['message' => 'Cpf inválido', 'status' => 400]));	 
		 }

		 
		$cns = new TCNSValidator();
		
		if(!$cns->validate($_POST['cns'])){
			
			return $this->output
			->set_content_type('application/json')
			->set_status_header('400')
			->set_output(json_encode(['message' => 'Cns inválido', 'status' => 400]));	 
		}
		
		$namePhoto = "";
		if(!empty($_FILES['photo']['name'])){
			
			$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
			$namePhoto = uniqid(time()).'.'.$ext;
			$grantedExtensions = array('jpg', 'jpeg', 'png');
			$directory = $_SERVER['DOCUMENT_ROOT'].'/om30/assets/uploads/';

			if(!in_array($ext, $grantedExtensions)){
				return $this->output
                ->set_content_type('application/json')
                ->set_status_header('400')
                ->set_output(json_encode(['message' => 'Tipo de arquivo nao permitido', 'status' => 400]));	   
			}

			move_uploaded_file($_FILES['photo']['tmp_name'], $directory.$namePhoto);

		}
		
		$result = $this->pacientemodel->insert_paciente($_POST, $namePhoto);
		if($result){
			
			return $this->output
                ->set_content_type('application/json')
                ->set_status_header('201')
                ->set_output(json_encode(['message' => 'Paciente registrado com Sucesso!', 'paciente' => $result, 'status' => 201]));	   
		}
		else {
			return $this->output
                ->set_content_type('application/json')
                ->set_status_header('400')
                ->set_output(json_encode(['message' => 'Erro! Na tentativa de registrar paciente', 'status' => 400]));
		}
		

	}

	public function get_pacientes_get(){

		if($this->pacientemodel->get_pacientes()){
			return $this->output
                ->set_content_type('application/json')
                ->set_status_header('200')
                ->set_output(json_encode(['pacientes' => $this->pacientemodel->get_pacientes(), 'status' => 200]));
		}
	}

	public function get_paciente_get($pat){

		$result = $this->pacientemodel->get_paciente($pat);
		if($result){
			return $this->output
                ->set_content_type('application/json')
                ->set_status_header('200')
                ->set_output(json_encode(['paciente' => $result, 'status' => 200]));
		}

		return $this->output
                ->set_content_type('application/json')
                ->set_status_header('400')
                ->set_output(json_encode(['message' => 'Paciente nao encontrado', 'status' => 400]));

	}

	public function edit_paciente_post($patient)
	{
		
		if(!is_numeric($patient)){

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header('400')
                ->set_output(json_encode(['message' => 'Paciente nao encontrado', 'status' => 400]));	
		}
		
		// nothing to proccess (no fields)
		if(!$_POST){
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header('400')
            ->set_output(json_encode(['message' => 'Request Failure', 'status' => 400]));	
        }
        
        //array with patient's post data
        $data = array('nome-edit', 'nome-mae-edit', 'dt-nasc-edit', 'cep-edit', 'end-completo-edit', 'cpf-edit', 'cns-edit', 'numero-edit');
        
		$i = 0;
		$feedback = 'Os seguintes campos estao em branco: ';
		$hasInputEmpty = false;
		

		// check whether missing fields
        for($i; $i < count($data); $i++){
            if(!array_key_exists($data[$i], $_POST)){
				
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header('400')
                ->set_output(json_encode(['message' => 'faltando campos obrigatorios', 'status' => 400]));	   
			}
			if(empty($_POST[$data[$i]])){
				$feedback .= $data[$i].' ';
				$hasInputEmpty = true;
			}
			
		}
		
		if($hasInputEmpty){
			return $this->output
                ->set_content_type('application/json')
                ->set_status_header('400')
                ->set_output(json_encode(['message' => trim($feedback), 'status' => 400]));	   
		}

		
		 if(validaCPF($_POST['cpf-edit']) == ''){
			return $this->output
			->set_content_type('application/json')
			->set_status_header('400')
			->set_output(json_encode(['message' => 'Cpf inválido', 'status' => 400]));	 
		 }

		 
		$cns = new TCNSValidator();
		
		if(!$cns->validate($_POST['cns-edit'])){
			
			return $this->output
			->set_content_type('application/json')
			->set_status_header('400')
			->set_output(json_encode(['message' => 'Cns inválido', 'status' => 400]));	 
		}
		
		$namePhoto = "";
		if(!empty($_FILES['photo-edit']['name'])){
			
			$ext = pathinfo($_FILES['photo-edit']['name'], PATHINFO_EXTENSION);
			$namePhoto = uniqid(time()).'.'.$ext;
			$grantedExtensions = array('jpg', 'jpeg', 'png');
			$directory = $_SERVER['DOCUMENT_ROOT'].'/om30/assets/uploads/';

			if(!in_array($ext, $grantedExtensions)){
				return $this->output
                ->set_content_type('application/json')
                ->set_status_header('400')
                ->set_output(json_encode(['message' => 'Tipo de arquivo nao permitido', 'status' => 400]));	   
			}

			move_uploaded_file($_FILES['photo-edit']['tmp_name'], $directory.$namePhoto);

		}
		$namePhoto = empty($namePhoto) ? $_POST['old-photo'] : $namePhoto;
		if($this->pacientemodel->update_paciente($_POST, $namePhoto)){
			
			return $this->output
                ->set_content_type('application/json')
                ->set_status_header('200')
                ->set_output(json_encode(['message' => 'Informaçoes alteradas com Sucesso!', 'status' => 200]));	   
		}
		else {
			return $this->output
                ->set_content_type('application/json')
                ->set_status_header('400')
                ->set_output(json_encode(['message' => 'Erro! Na tentativa de alterar paciente', 'status' => 400]));
		}
	}

	public function delete_paciente_delete($patient){

		if(!is_numeric($patient)){

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header('400')
                ->set_output(json_encode(['message' => 'Paciente nao encontrado', 'status' => 400]));	
		}

		if($this->pacientemodel->delete_paciente($patient)){
			return $this->output
                ->set_content_type('application/json')
                ->set_status_header('200')
                ->set_output(json_encode(['message' => 'Paciente removido com Sucesso!', 'status' => 200]));	
		}

		return $this->output
                ->set_content_type('application/json')
                ->set_status_header('400')
                ->set_output(json_encode(['message' => 'Paciente removido com Sucesso!', 'status' => 400]));

	}

	
	
}

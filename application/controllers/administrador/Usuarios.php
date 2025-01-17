<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios_model');
    }

    public function index() {
        
        $data = array(
            "usuarios" => $this->Usuarios_model->getUsuarios()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/usuarios/list', $data);
        $this->load->view('layouts/footer');

    }

    public function add(){
        
        $data = array(
            'roles' => $this->Usuarios_model->getRoles(),
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/usuarios/add', $data);
        $this->load->view('layouts/footer');

    }

    public function store(){

        $nombres = $this->input->post("nombres");
        $apellidos = $this->input->post("apellidos");
        $telefono = $this->input->post("telefono");
        $email = $this->input->post("email");
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $rol = $this->input->post("rol");

        $data = array(
            'nombres' => $nombres,
            'apellidos'=> $apellidos,
            'telefono'=> $telefono,
            'email'=> $email,
            'username'=> $username,
            'password'=> $password,
            'rol_id'=> $rol,
            'estado' => "1",
        );

        if ($this->Usuarios_model->save($data)){
            redirect(base_url()."administrador/usuarios");
        }else {
            $this->session->set_flashdata("error","No se pudo guardar el usuario");
            redirect(base_url()."mantenimiento/usuarios/add");
        }
    }


}
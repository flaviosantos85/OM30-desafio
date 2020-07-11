<?php

class Pacientemodel extends CI_Model{

    public function insert_paciente($data = array(), $img){
        
        if($data === ''){
            return false;
        }
        
        $image = ($img === "") ? 'null' : $img;
        
        $store['nome'] = $data['nome'];
        $store['nome_mae'] = $data['nome-mae'];
        $store['dt_nasc'] = $data['dt-nasc'];
        $store['cep'] = $data['cep'];
        $store['endereco'] = $data['end-completo'];
        $store['numero'] = $data['numero'];
        $store['cpf'] = $data['cpf'];
        $store['cns'] = $data['cns'];
        $store['photo'] = $image;
        $store['registered_at'] = date('Y-m-d');

        $this->db->insert('tb_pacientes', $store);
        $pat = $this->db->insert_id();
        $lastPat = $this->db->get_where('tb_pacientes', array('paciente_id' => $pat));
        return $lastPat->row();

    }

    public function update_paciente($data, $img){

        if($data === ''){
            return false;
        }
        
        $image = ($img === "") ? 'null' : $img;
        
        $store['nome'] = $data['nome-edit'];
        $store['nome_mae'] = $data['nome-mae-edit'];
        $store['dt_nasc'] = $data['dt-nasc-edit'];
        $store['cep'] = $data['cep-edit'];
        $store['endereco'] = $data['end-completo-edit'];
        $store['numero'] = $data['numero-edit'];
        $store['cpf'] = $data['cpf-edit'];
        $store['cns'] = $data['cns-edit'];
        $store['photo'] = $image;
        $store['registered_at'] = date('Y-m-d');

        $this->db->where('paciente_id', $data['paciente-edit']);
        return $this->db->update('tb_pacientes', $store);
        
    }

    public function get_pacientes(){
        
         $this->db->order_by('paciente_id', 'desc');

         $query = $this->db->get_where('tb_pacientes', array('ativo' => 1)); 
         return $query->result();
    }

    public function get_paciente($pat){
        
        if($pat === '' || !is_numeric($pat)){
            return false;
        }
        return  $this->db->get_where('tb_pacientes', array('paciente_id' => $pat, 'ativo' => 1))->result();
    }

    public function delete_paciente($pat){
        
        if($pat === '' || !is_numeric($pat)){
            return false;
        }

        $this->db->where('paciente_id', $pat);
        return $this->db->update('tb_pacientes', array('ativo' => 0));
    }
}
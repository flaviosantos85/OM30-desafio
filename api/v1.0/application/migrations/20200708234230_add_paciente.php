<?php 

class Migration_Add_paciente extends CI_Migration {

    public function up()
    {
            $this->dbforge->add_field(array(
                    'paciente_id' => array(
                            'type' => 'INT',
                            'constraint' => 5,
                            'unsigned' => TRUE,
                            'auto_increment' => TRUE
                    ),
                    'nome' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '100',
                    ),
                    'nome_mae' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '100',
                    ),
                    'dt_nasc' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '100',
                    ),
                    'cep' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '20',
                    ),
                    'endereco' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                    ),
                    'numero' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '45',
                    ),
                    'cpf' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '20',
                    ),
                    'cns' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '20',
                    ),
                    'photo' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                    ),
                    'registered_at' => array(
                        'type' => 'varchar',
                        'constraint' => '200',
                        
                    ),
                    'ativo' => array(
                        'type' => 'varchar',
                        'constraint' => '1',
                        
                    ),
                    
            ));
            $this->dbforge->add_key('paciente_id', TRUE);
            $this->dbforge->create_table('tb_pacientes');
    }
    
    public function down()
    {
            $this->dbforge->drop_table('tb_pacientes');
    }
    }
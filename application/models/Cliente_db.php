<?php

if ( !defined( 'BASEPATH' ) ) { exit( 'No direct script access allowed' ); }
	
class Cliente_db extends CI_Model
{
    
    public function __construct()
    {
	parent::__construct();
    }	  
    
    /*
        Retorna os dados de um cliente
    */
    public function dados( $id ) 
    {
        $select = "nome, cpf, rg, email, sexo";

        $this->db->select( $select );
        $this->db->from( 'cliente' );
        $this->db->where( "cliente.id = $id" );
        $this->db->limit(1);
        $query = $this->db->get();

        if ( $query->num_rows() == 1 ) 
        {
            $var = $query->result();
            return $var['0'];
        } 
        else 
        {
            return false;
        }
    }
       
    /*
        Insere
    */
    public function insert( $dados ) 
    {
        $result = $this->db->insert( 'cliente', $dados );

        $usuario_id_insert = $this->db->insert_id();

        if( $result == true )
        {
            return $usuario_id_insert;
        }
        else
        {
            return $result;	
        }
    }
    
    /*
        Atualiza
    */
    public function update( $dados, $cliente_id ) 
    {
        $str = $this->db->update( 'cliente', $dados, "cliente.id = $cliente_id" );

        return $str;
    }        

    /*
        Retorna os dados do cliente para login
    */
    public function login( $cpf, $senha )
    {
        $select = "cliente.id, cliente.nome";
        
        $this->db->select( $select );
        $this->db->from( 'cliente' );
        $this->db->where( "cpf = '$cpf' AND senha = '$senha'" );

        $query = $this->db->get();
		
	$row = $query->row();

	return $row;
    }
}
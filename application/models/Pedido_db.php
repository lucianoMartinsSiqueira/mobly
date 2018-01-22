<?php

if ( !defined( 'BASEPATH' ) ) { exit( 'No direct script access allowed' ); }
	
class Pedido_db extends CI_Model
{
    
    public function __construct()
    {
	parent::__construct();
    }	  
    
    /*
        Retorna os pedidos de um cliente
    */
    public function produtos( $id ) 
    {
        $select = "pedido.id, pedido.valor, DATE_FORMAT( pedido.data_registro, '%d/%m/%Y %H:%i:%s' ) AS registro, endereco.logradouro, endereco.numero, endereco.bairro, endereco.cidade, endereco.uf, endereco.cep, endereco.complemento";

        $this->db->select( $select );
        $this->db->from( 'pedido' );
        $this->db->join( 'endereco', 'endereco.id = pedido.endereco_id', 'left' );
        $this->db->where( "pedido.cliente_id = $id" );
        $query = $this->db->get();

        if ( $query->num_rows() > 0 ) 
        {
            return $query->result();
        } 
        else 
        {
            return false;
        }
    }
}
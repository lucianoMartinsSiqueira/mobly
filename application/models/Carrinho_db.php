<?php

if ( !defined( 'BASEPATH' ) ) { exit( 'No direct script access allowed' ); }
	
class Carrinho_db extends CI_Model
{
    
    public function __construct()
    {
	parent::__construct();
    }	  
    
    /*
        Retorna os produtos no carrinho de um cliente
    */
    public function produtos( $id ) 
    {
        $select = "carrinho.id, produto.id as produto_id, carrinho.quantidade, produto.nome, produto.imagem, produto.preco";

        $this->db->select( $select );
        $this->db->from( 'carrinho' );
        $this->db->join( 'produto', 'produto.id = carrinho.produto_id', 'left' );
        $this->db->where( "carrinho.cliente_id = $id AND carrinho.status = 0" );
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
    
    /*
        Retorna os endereços de um cliente
    */
    public function enderecos( $id ) 
    {
        $select = "id, logradouro, numero, bairro, cidade, uf, cep, complemento";

        $this->db->select( $select );
        $this->db->from( 'endereco' );
        $this->db->where( "endereco.cliente_id = $id" );
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
    
    /*
        Valor total de pedidos
    */
    public function valor( $cliente_id )
    {
        return "495.91";
    }
       
    /*
        Insere
    */
    public function insert( $dados, $tabela ) 
    {
        $result = $this->db->insert( $tabela, $dados );

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
    public function update( $quantidade, $id ) 
    {
        $dados['quantidade'] = $quantidade;
        
        $str = $this->db->update( 'carrinho', $dados, "id = $id" );

        return $str;
    }        

    /*
        Atualiza carrinho para 1
    */
    public function updateProdutoCarrinho( $id ) 
    {
        $dados['status'] = '1';         
        
        $str = $this->db->update( 'carrinho', $dados, "id = $id" );

        return $str;
    } 
    
    /*
        Deleta
    */
    public function delete( $id )
    {
        $this->db->where( 'carrinho.id', $id );
        $str = $this->db->delete( 'carrinho' );

        return $str;
    }    
}
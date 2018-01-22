<?php

if ( !defined( 'BASEPATH' ) ) { exit( 'No direct script access allowed' ); }
	
class Index_db extends CI_Model
{
    
    public function __construct()
    {
	parent::__construct();
    }
	
    /*
        Lista Produtos
    */
    public function produtos( $where, $order_by ) 
    {             
        $orde = ( !empty( $order_by ) )? $order_by : "produto.nome"; 
        
        $wher = "produto.status = '1'";        
        
        if( !empty( $where['categoria_id'] ) )
        {
            $wher .= " AND produto.id IN (SELECT produto_id FROM produto_categoria WHERE categoria_id = ".$where['categoria_id']." )";
        }
        
        
        
        $select = "produto.id, produto.nome, produto.descricao, produto.imagem, CONCAT('R$ ', REPLACE(produto.preco, '.', ',')) as preco";

        $this->db->select( $select );
        $this->db->from( 'produto');
        //$this->db->join( 'permissao', 'usuario.permissao_id = permissao.id' );
        $this->db->where( $wher );
        $this->db->order_by( $orde );

        $query = $this->db->get();
        return $query->result();
    }  
    
    /*
        Lista Categorias
    */
    public function categorias() 
    {     
        $select = "categoria.id, categoria.nome";

        $this->db->select( $select );
        $this->db->from( 'categoria');
        $this->db->where( "categoria.status = 1" );
        $this->db->order_by( 'categoria.nome' );

        $query = $this->db->get();
        return $query->result();
    }  
    
    /*
        Retorna os dados de um produto
    */
    public function dados( $id ) 
    {
        $select = "produto.id, produto.nome, produto.descricao, produto.imagem, CONCAT('R$ ', REPLACE(produto.preco, '.', ',')) as preco";

        $this->db->select( $select );
        $this->db->from( 'produto' );
        $this->db->where( "produto.id = $id" );
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
        Imagens do produto
    */
    public function imagens( $produto_id ) 
    {     
        $select = "produto_imagem.id, produto_imagem.imagem";

        $this->db->select( $select );
        $this->db->from( 'produto_imagem');
        $this->db->where( "produto_id = $produto_id" );
        $this->db->limit(3);

        $query = $this->db->get();
        return $query->result();
    }
    
    /*
        Produtos relacionados
    */
    public function relacionados( $produto_id ) 
    {     
        $select = "produto.id, produto.nome, produto.imagem, CONCAT( 'R$ ', REPLACE( produto.preco,'.',',' ) ) as preco";

        $this->db->select( $select );
        $this->db->from( 'produto' );
        $this->db->where( "produto.id != $produto_id AND produto.id IN (SELECT produto_id FROM produto_categoria WHERE categoria_id = ( SELECT categoria_id FROM produto_categoria WHERE produto_id = $produto_id LIMIT 1 ) )" );
        $this->db->limit(4);

        $query = $this->db->get();
        return $query->result();
    }
    
    /*
        Produtos populares
    */
    public function populares() 
    {     
        $select = "produto.id, produto.nome, produto.imagem, CONCAT( 'R$ ', REPLACE( produto.preco,'.',',' ) ) as preco";

        $this->db->select( $select );
        $this->db->from( 'produto' );
        $this->db->where( "produto.status = 1" );
        $this->db->limit(3);
        $this->db->order_by('visualizacao');

        $query = $this->db->get();
        return $query->result();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*
        Insere usuário
    */
    public function insert( $dados ) 
    {
        $result = $this->db->insert( 'usuario', $dados );

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
        Atualiza usuário
    */
    public function update( $update_set, $update_where ) 
    {
        $instancia = $this->session->userdata( 'session_usuario_instancia' );

        $update = array();
        
        foreach( $update_set as $field => $valor )
        {
                $update[$field] = $valor;

                if( $field == 'flag_status' && $valor == 'false')
                {
                        $update['sessao_ativa'] = '0';
                }
        }

        $where = array();
        $where['instancia_id'] = $instancia;

        foreach( $update_where as $field=>$valor )
        {
                $where[$field] = $valor;
        }

        $str = $this->db->update( 'usuario', $update, $where );

        return $str;
    }
    
    /*
        Deleta usuário
    */
    public function delete( $usuario_id )
    {
        $this->db->where( 'usuario.id', $usuario_id );
        $str = $this->db->delete( 'usuario' );

        return $str;
    }      
        
    /*
        Retorna o array de perfil de usuário
    */
    public function arrayPermissao()
    {
        $permissao_id = $this->session->userdata( 'session_usuario_permissao_id' );
        $instancia_id = $this->session->userdata( 'session_usuario_instancia' );

        $select = "id, nome ";

        $condicao = array();
        //$condicao['instancia_id'] = "$instancia_id";	

        if( $permissao_id == 1 )
        {
            // Perfil Administrador, busca todos os perfis

        }
        else if( $permissao_id == 2 )
        {
            // Não visualiza perfil Administrador
            $condicao['permissao_id != '] = '1'; 
        }


        $this->db->select( $select );
        $this->db->from( 'permissao' );
        $this->db->where( $condicao );

        $query = $this->db->get();

        $result_array = $query->result_array();

        $perfil_array = array();
        
        $perfil_array[""] = "-- Selecione --";
        
        foreach( $result_array as $key=>$row )
        {
            $perfil_array[$row['id']] = $row['nome'];
        }


        return $perfil_array;
    }	

    /*
        Retorna o nome do usuario pelo ID
    */
    public function nomeIndex( $usuario_id )
    {
        $select = "nome";
        
        $condicao = " usuario.id = $usuario_id ";
        
        $this->db->select( $select );
        $this->db->from( 'usuario' );
        $this->db->where( $condicao );

        $query = $this->db->get();
		
	$row = $query->row();

	$nome = $row->nome;
		
        return $nome;
    }
}
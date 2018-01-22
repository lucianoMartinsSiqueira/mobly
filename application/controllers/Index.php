<?php 

if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' ); 

class Index extends CI_Controller 
{
    /*
        Construtor
    */
    function __construct()
    {
        parent::__construct();
        $this->load->model( 'index_db' );
    }
    
    /*
        View listar
    */
    public function index( $categoria_id = null )
    {
        $where['categoria_id'] = $categoria_id;
        $order_by = "";
        $dados['produtos'] = $this->index_db->produtos( $where, $order_by );
        $dados['categorias'] = $this->index_db->categorias();
        $dados['populares'] = $this->index_db->populares();
        $this->load->view( 'index', $dados );		
    }
    
    public function produto( $id )
    {
        $dados['dados'] = $this->index_db->dados( $id );
        $dados['imagens'] = $this->index_db->imagens( $id );
        $dados['relacionados'] = $this->index_db->relacionados( $id );
        $this->load->view( 'produto/produto', $dados );		
    }
    
    public function logout()
    {
        unset( $_SESSION['cliente_id'] );
        unset( $_SESSION['cliente_nome'] );
        $_SESSION['sucess'] = "Saida realizada com sucesso. Volte sempre!";
        redirect( 'index/index' );
    }
}
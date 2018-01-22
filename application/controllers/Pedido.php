<?php 

if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' ); 

class Pedido extends CI_Controller 
{
    /*
        Construtor
    */
    function __construct()
    {
        parent::__construct();
        $this->load->model( 'pedido_db' );
    }
    
    /*
        View index
    */
    public function index()
    {
        if( isset( $_SESSION['cliente_id'] ) )
        {
            $dados['pedidos'] = $this->pedido_db->produtos( $_SESSION['cliente_id'] );
        }
        else
        {
            $dados['produtos'] = "";
        }                
        
        $this->load->view( 'pedido/index', $dados );		
    }  
    
    /*
        Execução inserir
    */
    public function insert( $produto_id )
    {
        $quantidade = $this->input->post('quantidade');
        
        $dados['cliente_id']    = $_SESSION['cliente_id']; 
        $dados['produto_id']    = $produto_id;
        
        if( $quantidade > 0 )
        {
            $dados['quantidade'] = $this->input->post('quantidade');
        }
        else
        {
            $dados['quantidade'] = 1;
        }
        
        $dados['status']        = '0';
        $dados['data_registro'] = date( "Y-m-d H:i:s" );

        $pedido_id = $this->pedido_db->insert( $dados, 'pedido' );

        if( !empty( $pedido_id ) )
        {
            $this->syscontrole->logCliente( $pedido_id, 'Pedido: Adicionar Produto' );

            $_SESSION['sucess'] = "Produto adicionado ao pedido com sucesso!";
        }
        else
        {
            $_SESSION['atention'] = "Erro ao adicionar produto ao pedido!";
        }

        redirect( "pedido" );
    }
    
    /*
        Execução remover
    */
    public function remover( $pedido_id )
    {
        // Insere
        $id = $this->pedido_db->delete( $pedido_id );

        if( $id )
        {
            $this->syscontrole->logCliente( $id, 'Pedido: Adicionar Produto' );

            $_SESSION['sucess'] = "Produto removido do pedido com sucesso!";
        }
        else
        {
            $_SESSION['atention'] = "Erro ao remover o produto do pedido!";
        }

        redirect( "pedido" );
    }
    
    /*
        Execução pedido
    */
    public function pedido()
    {
        $enderecos = $this->input->post( 'endereco' );
        
        foreach( $enderecos as $endereco )
        {
            if( !empty( $endereco ) )
            {
                $dados['endereco_id'] = $endereco;
            }
        }
        
        $dados['cliente_id']    = $_SESSION['cliente_id']; 
        $dados['valor']         = $this->pedido_db->valor( $_SESSION['cliente_id'] ); 
        $dados['data_registro'] = date( "Y-m-d H:i:s" );
        
        if( !empty( $dados['endereco_id'] ) )
        {
            $pedido_id = $this->pedido_db->insert( $dados, 'pedido' );
            
            $produtos = $this->pedido_db->produtos( $_SESSION['cliente_id'] );
            
            foreach( $produtos as $produto )
            {
                $dadosPedido['pedido_id']  = $pedido_id;
                $dadosPedido['produto_id'] = $produto->produto_id;
                $dadosPedido['data_registro'] = date( "Y-m-d H:i:s" );
                
                $this->pedido_db->insert( $dadosPedido, 'pedido_produto' );
                $this->pedido_db->updateProdutoPedido( $produto->id );
            }            

            if( !empty( $pedido_id ) )
            {
                $this->syscontrole->logCliente( $pedido_id, 'Registrar Pedido' );

                $_SESSION['sucess'] = "Pedido registrado com sucesso!";
            }
            else
            {
                $_SESSION['atention'] = "Erro ao registrar o pedido!";
            }
        }
        else
        {
            $_SESSION['atention'] = "Selecione um endereço para entrega!";
        }
                        
        redirect( "pedido" );
    }        
        
    /*
        Login
    */
    public function login()
    {
        $cpf   = $this->input->post( 'cpf' ); 
        $senha = md5( $this->input->post( 'senha' ) ); 
	
        $dados = $this->pedido_db->login( $cpf, $senha );
        
        if( !empty( $dados ) )
        {
            $this->syscontrole->logPedido( $dados->id, "login" );
            $_SESSION['pedido_id'] = $dados->id;
            $_SESSION['pedido_nome'] = $dados->nome;
            $_SESSION['sucess'] = "Bem Vindo $dados->nome!";
            
            $resultado = array( 'status' => '0', 'mensagem' => 'Login realizado com sucesso!' );
        }
        else
        {
            $resultado = array( 'status' => '1', 'mensagem' => 'CPF e/ou Senha não encontrado(s). Tente novamente!' );
        }
        
        echo json_encode( $resultado );
        
        exit();
    }
    
    /*
        Atualiza quantidade
    */
    public function quantidadeAjax()
    {
        $id = $this->input->post('id');
        $quantidade = $this->input->post('quantidade');
        
        $res = $this->pedido_db->update( $quantidade, $id );
        
        echo $res;
        
        exit();
    }
}
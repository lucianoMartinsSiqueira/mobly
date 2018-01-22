<?php 

if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' ); 

class Carrinho extends CI_Controller 
{
    /*
        Construtor
    */
    function __construct()
    {
        parent::__construct();
        $this->load->model( 'carrinho_db' );
    }
    
    /*
        View index
    */
    public function index()
    {
        if( isset( $_SESSION['cliente_id'] ) )
        {
            $dados['produtos'] = $this->carrinho_db->produtos( $_SESSION['cliente_id'] );
            $dados['enderecos'] = $this->carrinho_db->enderecos( $_SESSION['cliente_id'] );
        }
        else
        {
            $dados['produtos'] = "";
        }                
        
        $this->load->view( 'carrinho/index', $dados );		
    }  
    
    /*
        Execução inserir
    */
    public function insert( $produto_id )
    {
        if( isset( $_SESSION['cliente_id'] ) AND !empty( $_SESSION['cliente_id'] ) )
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

            $carrinho_id = $this->carrinho_db->insert( $dados, 'carrinho' );

            if( !empty( $carrinho_id ) )
            {
                $this->syscontrole->logCliente( $carrinho_id, 'Carrinho: Adicionar Produto' );

                $_SESSION['sucess'] = "Produto adicionado ao carrinho com sucesso!";
            }
            else
            {
                $_SESSION['atention'] = "Erro ao adicionar produto ao carrinho!";
            }
          
            redirect( "carrinho" );
        }
        else
        {
            $_SESSION['atention'] = "Faça o login para adicionar produtos no carrinho de compras!";
            redirect( "index" );
        }
    }
    
    /*
        Execução remover
    */
    public function remover( $carrinho_id )
    {
        // Insere
        $id = $this->carrinho_db->delete( $carrinho_id );

        if( $id )
        {
            $this->syscontrole->logCliente( $id, 'Carrinho: Adicionar Produto' );

            $_SESSION['sucess'] = "Produto removido do carrinho com sucesso!";
        }
        else
        {
            $_SESSION['atention'] = "Erro ao remover o produto do carrinho!";
        }

        redirect( "carrinho" );
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
        $dados['valor']         = $this->carrinho_db->valor( $_SESSION['cliente_id'] ); 
        $dados['data_registro'] = date( "Y-m-d H:i:s" );
        
        if( !empty( $dados['endereco_id'] ) )
        {
            $pedido_id = $this->carrinho_db->insert( $dados, 'pedido' );
            
            $produtos = $this->carrinho_db->produtos( $_SESSION['cliente_id'] );
            
            foreach( $produtos as $produto )
            {
                $dadosPedido['pedido_id']  = $pedido_id;
                $dadosPedido['produto_id'] = $produto->produto_id;
                $dadosPedido['data_registro'] = date( "Y-m-d H:i:s" );
                
                $this->carrinho_db->insert( $dadosPedido, 'pedido_produto' );
                $this->carrinho_db->updateProdutoCarrinho( $produto->id );
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
                        
        redirect( "carrinho" );
    }        
        
    /*
        Login
    */
    public function login()
    {
        $cpf   = $this->input->post( 'cpf' ); 
        $senha = md5( $this->input->post( 'senha' ) ); 
	
        $dados = $this->carrinho_db->login( $cpf, $senha );
        
        if( !empty( $dados ) )
        {
            $this->syscontrole->logCarrinho( $dados->id, "login" );
            $_SESSION['carrinho_id'] = $dados->id;
            $_SESSION['carrinho_nome'] = $dados->nome;
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
        
        $res = $this->carrinho_db->update( $quantidade, $id );
        
        echo $res;
        
        exit();
    }
    
    /*
        Insere endereço
    */
    public function addEnderecoAjax()
    {
        $dados['cliente_id'] = $_SESSION['cliente_id'];
        $dados['logradouro'] = $this->input->post('logradouro');
        $dados['numero'] = $this->input->post('numero');
        $dados['bairro'] = $this->input->post('bairro');
        $dados['cidade'] = $this->input->post('cidade');
        $dados['uf'] = $this->input->post('uf');
        $dados['cep'] = $this->input->post('cep');
        $dados['complemento'] = $this->input->post('complemento');
        
        $res = $this->carrinho_db->insert( $dados, 'endereco' );
        
        $enderecos = $this->carrinho_db->enderecos( $_SESSION['cliente_id'] );
        
        $retorno = "";
        $selected = "";
        
        foreach( $enderecos as $endereco )
        {
            if( $res == $endereco->id )
            {
                $selected = "checked";
            }
            
            $retorno .= "<div class='row m-t-20' style='background-color: #F8D486; padding: 5px;'>
                <div class='col-md-12 form-group'>
                    <label class='custom-control custom-checkbox'>
                        <input class='custom-control-input' name='endereco[]' value='$endereco->id' type='checkbox' $selected>
                        <span class='custom-control-indicator'></span>
                        <span class='custom-control-description'>Selecionar este endereço para entrega</span>
                    </label>
                </div> 
                <div class='col-md-6 form-group'>
                    <label class='control-label'>Logradouro</label>
                    <input type='text' value='$endereco->logradouro' class='form-control'>
                </div> 
                <div class='col-md-2 form-group'>
                    <label class='control-label'>Numero</label>
                    <input type='text' value='$endereco->numero' class='form-control'>
                </div> 
                <div class='col-md-4 form-group'>
                    <label class='conrol-label'>Bairro</label>
                    <input type='text' value='$endereco->bairro' class='form-control'>
                </div>

                <div class='col-md-5 form-group'>
                    <label class='conrol-label'>Cidade</label>
                    <input type='text' value='$endereco->cidade' class='form-control'>
                </div> 
                <div class='col-md-4 form-group'>
                    <label class='conrol-label'>Bairro</label>
                    <input type='text' value='$endereco->bairro' class='form-control'>
                </div> 
                <div class='col-md-3 form-group'>
                    <label class='conrol-label'>Cep</label>
                    <input type='text' value='$endereco->cep' class='form-control'>
                </div> 
                <div class='col-md-12 form-group'>
                    <label class='conrol-label'>Complemento</label>
                    <input type='text' value='$endereco->complemento' class='form-control'>
                </div>
            </div>";
        }
        
        echo $retorno;
        
        exit();
    }
}
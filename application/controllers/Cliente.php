<?php 

if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' ); 

class Cliente extends CI_Controller 
{
    /*
        Construtor
    */
    function __construct()
    {
        parent::__construct();
        $this->load->model( 'cliente_db' );
    }
    
    /*
        View insert
    */
    public function insertView()
    {
        $this->load->view( 'cliente/insert' );		
    }
    
    /*
        View update
    */
    public function updateView()
    {
        $dados['dados'] = $this->cliente_db->dados( $_SESSION['cliente_id'] );
        $this->load->view( 'cliente/update', $dados );		
    }
    
    /*
        Execução inserir
    */
    public function insert()
    {
        $this->form_validation->set_rules( 'nome', 'Nome', 'trim|required' );
        $this->form_validation->set_rules( 'cpf', 'CPF', 'trim|required' );
        $this->form_validation->set_rules( 'senha', 'Senha', 'trim|required' );
        
        $this->form_validation->set_error_delimiters( '<p style="color:#FF0004; text-align:left;">', '</p>' );

        if ( $this->form_validation->run() == FALSE )
        {           
            // Não passou na validação
            $_SESSION['atention'] = "Não foi possível realizar o cadastro, verifique os problemas abaixo: <br/><br/>".validation_errors();
            $this->load->view( 'cliente/insert' );
        }
        else
        {
            // Passou na validação
            $dados['nome']          = $this->input->post( 'nome' ); 
            $dados['rg']            = $this->input->post( 'rg' );                         
            $dados['cpf']           = $this->input->post( 'cpf' );                         
            $dados['sexo']          = $this->input->post( 'sexo' );                         
            $dados['email']         = $this->input->post( 'email' );                         
            $dados['senha']         = md5( $this->input->post( 'senha' ) );                                                  
            $dados['status']        = '1';
            $dados['data_registro'] = date( "Y-m-d H:i:s" );
                                        
            // Insere
            $cliente_id = $this->cliente_db->insert( $dados );

            if( !empty( $cliente_id ) )
            {
                $this->syscontrole->logCliente( $cliente_id, 'Novo Cadastro' );
                
                $_SESSION['sucess'] = "Cadastro realizado com sucesso!";
                
                $_SESSION['cliente_id'] = $cliente_id;
                $_SESSION['cliente_nome'] = $this->input->post( 'nome' );
            }
            else
            {
                $_SESSION['atention'] = "Erro ao realizar o cadastro!";
            }

            // Redireciona para a View cliente
            redirect( "index" );
        }
    }
        
    
    /*
        Execução update
    */
    public function update()
    {
        $this->form_validation->set_rules( 'nome', 'Nome', 'trim|required' );
        $this->form_validation->set_rules( 'cpf', 'CPF', 'trim|required' );
        
        $this->form_validation->set_error_delimiters( '<p style="color:#FF0004; text-align:left;">', '</p>' );

        if ( $this->form_validation->run() == FALSE )
        {           
            // Não passou na validação
            $_SESSION['atention'] = "Não foi possível atualizar o cadastro, verifique os problemas abaixo: <br/><br/>".validation_errors();
            $this->load->view( 'cliente/insert' );
        }
        else
        {
            $dados['nome']               = $this->input->post( 'nome' ); 
            $dados['rg']                 = $this->input->post( 'rg' );                         
            $dados['cpf']                = $this->input->post( 'cpf' );                         
            $dados['sexo']               = $this->input->post( 'sexo' );                         
            $dados['email']              = $this->input->post( 'email' );                                                                           
            $dados['ultima_modificacao'] = date( "Y-m-d H:i:s" );
                                        
            $res = $this->cliente_db->update( $dados, $_SESSION['cliente_id'] );

            if( !empty( $res ) )
            {
                $this->syscontrole->logCliente( $_SESSION['cliente_id'], 'Novo Cadastro' );
                
                $_SESSION['sucess'] = "Cadastro atualizado com sucesso!";
            }
            else
            {
                $_SESSION['atention'] = "Erro ao atualizar o cadastro, tente novamente mais tarde ou, entre em contato com o suporte!";                
            }

            // Redireciona para a View cliente
            redirect( "index" );
        }
    }
    
    
    /*
        Login
    */
    public function login()
    {
        $cpf   = $this->input->post( 'cpf' ); 
        $senha = md5( $this->input->post( 'senha' ) ); 
	
        $dados = $this->cliente_db->login( $cpf, $senha );       
        
        if( !empty( $dados ) )
        {
            $this->syscontrole->logCliente( $dados->id, "login" );
            $_SESSION['cliente_id'] = $dados->id;
            $_SESSION['cliente_nome'] = $dados->nome;
            $_SESSION['sucess'] = "Bem Vindo $dados->nome!";
            
            $resultado = array( 'status' => '0', 'mensagem' => 'Login realizado com sucesso. <br/> Redirecionando, Aguarde...' );
        }
        else
        {
            $resultado = array( 'status' => '1', 'mensagem' => 'CPF e/ou Senha não encontrado(s). Tente novamente!' );
        }
        
        echo json_encode( $resultado );
        
        exit();
    }
}
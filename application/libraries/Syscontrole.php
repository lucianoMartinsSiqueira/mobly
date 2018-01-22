<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Syscontrole 
{
    public function __construct()
    {
        // Chama uma instância do CI
        $this->ci = &get_instance();
        //$this->get_menu_exibir();
    }
    
    public function verifica_sessao_ativa()
    {
        $user_id = $this->ci->session->userdata( 'session_usuario_id' );
        $user_nome = $this->ci->session->userdata( 'session_usuario_nome' );
        $usuario_sessao_id = $this->ci->session->userdata( 'session_usuario_code' );

        // Verifica se existe sessão armazeanda
        if(  $this->ci->session->userdata( 'session_usuario_code' ) != true )
        { 
            //session_destroy();

            $_SESSION['atention'] = 'Sua sessão expirou. Entre novamente com os dados de acesso!';
            
            // Não existe sessão, encaminha para o Login
            redirect( 'login' );
            exit;
        }
        else
        {
            // ************************************************************
            // Verifica se a sessão atual confere com as armazenadas no BD
            // *************************************************************

            // Condição da query
            $array = array('usuario.id'=>$user_id, 'sessao'=>$usuario_sessao_id);

            // Monta a query
            $this->ci->db->select( 'usuario.id, sessao' );
            $this->ci->db->where($array);
            $this->ci->db->limit(1);
            $query = $this->ci->db->get('usuario');

            $usuario_logado = $query->num_rows();

            if( $usuario_logado == 0 )
            { 
                // ********************
                // Sessões não conferem
                // ********************
                
                //session_destroy();

                $_SESSION['atention'] = 'Sua sessão expirou. Entre novamente com os dados de acesso!';

                // Não existe sessão, encaminha para o Login		
                redirect('login');
                exit;
            }
            elseif ( $usuario_logado == 1 )
            { 
                //-> Sessão ok, continua no sistema
                
                global $usuario_nome_logado;

                $usuario_nome_logado = $data['usuario_nome_logado'] = $this->ci->session->userdata( 'user_nome' );
            }
        }
    }

    public function get_usuario_sessao()
    {
        $usuario_nome_logado['usuario_nome_logado'] = $this->ci->session->userdata( 'user_nome' );

        return $usuario_nome_logado;
    }

    public function logCliente( $cliente_id, $operacao )
    {
        $dados['plataforma']    = $_SERVER['HTTP_USER_AGENT'];
        $dados['cliente_id']    = $cliente_id;
        $dados['operacao']      = $operacao;
        $dados['ip']            = $this->getIP();
        $dados['data_registro'] = date( "Y-m-d H:i:s" );

        $this->ci->db->insert( 'log_cliente', $dados );
    }
    
    private function getIP()
    {
        if( !empty( $_SERVER['HTTP_CLIENT_IP'] ) )
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif ( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}

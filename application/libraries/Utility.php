<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utility 
{
    public function __construct()
    {
        // Chama uma instância do CI
        $this->ci = &get_instance();
        //$this->get_menu_exibir();
    }
    
    // Retorna valor em texto para número
    public function textoParaValor( $texto )
    {
        $valor = str_replace( "R$ ", "", $texto );
        $valor = str_replace( ".", "", $valor );
        return str_replace( ",", ".", $valor );
    }
    
    // Retorna valor em texto para número
    public function valorParaTexto( $valor )
    {
        if( !empty( $valor ) AND $valor != "" )
        {
            //$texto = str_replace( ".", ",", $valor );
            return "R$ ".number_format( $valor, 2,',','.' );
        }
        else
        {
            return "R$ 0,00";
        }
    }
    
    // Retorna cpf com ponto e traço
    public function cpfParaTexto( $cpf )
    {
        if( !empty( $cpf ) )
        {
            $parte_um     = substr( $cpf, 0, 3 );
            $parte_dois   = substr( $cpf, 3, 3 );
            $parte_tres   = substr( $cpf, 6, 3 );
            $parte_quatro = substr( $cpf, 9, 2 );

            $resultado = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";

            return $resultado;
        }
        else
        {
            return "000.000.000-00";
        }
    }
    
    public function formataDataBR( $data, $horas = false )
    {
        if( $horas )
        {
            return date( "Y/m/d H:i:s", strtotime( $data ) );
        }
        else
        {
            $varData = implode(preg_match("~\/~", $data) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $data) == 0 ? "-" : "/", $data)));
            return $varData;
        }
    }
}

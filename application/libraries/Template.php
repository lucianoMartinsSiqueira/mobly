<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Template 
{
    public function __construct()
    {
        $this->CI =& get_instance();
        
    }

    public function head( $titulo = "New Shop", $class = 'fixed-left' )
    {
        ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="description" content="">
                <meta name="author" content="">
                <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/images/newshopmini.png'); ?>">
                <title>New Shop</title>
                <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
                <link href="<?php echo base_url('assets/css/aos.css'); ?>" rel="stylesheet">
                <link href="<?php echo base_url('assets/css/prism.css'); ?>" rel="stylesheet">
                <link href="<?php echo base_url('assets/css/perfect-scrollbar.min.css'); ?>" rel="stylesheet">
                <link href="<?php echo base_url('assets/css/owl.theme.green.css'); ?>" rel="stylesheet">
                <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
                <link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet">
            </head>
        <?php
    }      
    
    public function menu( $active = 'index' )
    {        
        ?>
            <div class="topbar">
                <div class="header6">
                    <div class="container po-relative">
                        <nav class="navbar navbar-expand-lg h6-nav-bar">
                            <a href="<?php echo base_url(''); ?>" class="navbar-brand"><img src="<?php echo base_url('assets/images/newshop.png'); ?>" alt="logo" /></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#h6-info" aria-controls="h6-info" aria-expanded="false" aria-label="Toggle navigation"><span class="ti-menu"></span></button>
                            <div class="collapse navbar-collapse hover-dropdown font-14 ml-auto" id="h6-info">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item dropdown"> 
                                        <a class="nav-link dropdown-toggle <?php if( $active == 'index' ){ echo "color-blue"; } ?>" href="<?php echo base_url('index'); ?>" id="menu-produtos">
                                            Produtos
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown"> 
                                        <a class="nav-link dropdown-toggle <?php if( $active == 'carrinho' ){ echo "color-blue"; } ?>" href="<?php echo base_url('carrinho'); ?>" id="menu-carrinho" >
                                            Carrinho
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown"> 
                                        <a class="nav-link dropdown-toggle <?php if( $active == 'pedidos' ){ echo "color-blue"; } ?>" href="<?php echo base_url('pedido'); ?>" id="menu-pedidos">
                                            Pedidos
                                        </a>
                                    </li>

                                    <?php if( isset( $_SESSION['cliente_id'] ) ): ?>
                                        <li class="nav-item dropdown m-t-20"> 
                                            <button class="btn btn-outline-success m-l-20" data-toggle="modal" type="button" ><span class="fa fa-lock"></span> <?php echo substr( $_SESSION['cliente_nome'], 0, 10 )."."; ?></button>
                                              <ul class="b-none dropdown-menu font-14 animated fadeInUp">              
                                                  <li><a class="dropdown-item" href="<?php echo base_url( 'cliente/updateView' ); ?>" target="_blank">Meus Dados</a></li>
                                                  <li><a class="dropdown-item" href="<?php echo base_url( 'index/logout' ); ?>" target="_blank">Sair</a></li>
                                              </ul>
                                          </li>
                                    <?php else: ?>
                                        <li class="m-t-20"> 
                                            <button class="btn btn-outline-success m-l-20" data-toggle="modal" data-target="#login-modal" id="btn-login" type="button" ><span class="fa fa-lock"></span> Login</button>
                                        </li>
                                    <?php endif; ?>

                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>    
        <?php
    }        
    
    public function footer()
    {
        ?>
            <div class="footer4 spacer b-t">
                <div class="container ">
                    <div class="f4-bottom-bar">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex font-14">
                                    <div class="m-t-10 m-b-10 copyright">New Shop, todos os direitos reservados.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="text-center m-t-30" align="center">
                            <img src="<?php echo base_url('assets/images/newshop.png'); ?>" alt="logo" />
                            <h4 class="text-info text-center" align="center">LOGIN</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group has-success">
                                    <label for="recipient-name" class="control-label">CPF</label>
                                    <input type="text" name="cpf" class="form-control" id="cpfModal">
                                </div>
                                <div class="form-group has-success">
                                    <label for="message-text" class="control-label">Senha</label>
                                    <input type="text" name="senha" class="form-control" id="senha">
                                </div>
                                <div class="text-center">
                                    <a href="<?php echo base_url( "cliente/insertView" ); ?>">Não possui cadastro?</a>
                                </div>    
                            </form>
                            <h4 class="text-center m-t-30" id="login-modal-mensagem"></h4>
                        </div>
                        <div class="modal-footer" id="login-modal-footer">
                            <button type="button" class="btn btn-inverse waves-effect" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success waves-effect waves-light" id="btnEntrar">Entrar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    
    public function bottom()
    {
        ?>
            <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
            <script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
            <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
            <script src="<?php echo base_url('assets/js/aos.js'); ?>"></script>
            <script src="<?php echo base_url('assets/js/perfect-scrollbar.jquery.min.js'); ?>."></script>
            <script src="<?php echo base_url('assets/js/custom.min.js'); ?>"></script>
            <script src="<?php echo base_url('assets/js/prism.js'); ?>"></script>
            <script src="<?php echo base_url('assets/js/jquery.mask.min.js'); ?>"></script>
            <script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>

            <script type="text/javascript">

                $(document).ready(function()
                {
                    $('#cpfModal').mask('000.000.000-00', {reverse: true});
                    
                    window.setTimeout(function()
                    {
                        $(".alert").slideUp( "0.5" );                    
                    }, 2000);

                    $("#btnEntrar").click(function()
                    {
                        var cpf = $( "#cpfModal" ).val();
                        var senha = $( "#senha" ).val();

                        $.ajax(
                        {       
                            type: 'POST',
                            url: '<?php echo base_url('cliente/login'); ?>',
                            data: { cpf: cpf, senha: senha },
                            timeout: 30000,
                            cache: false,
                            async: 'true',
                            dataType: 'json',
                            beforeSend: function() 
                            {

                            },
                            complete: function() 
                            {

                            },
                            success: function( result ) 
                            {
                                if( result.status === '0' || result.status === 0 )
                                {
                                    $("#login-modal-footer").hide( 'fast' );
                                    $("#login-modal-mensagem").addClass('text-success').html( result.mensagem ); 

                                    window.setTimeout(function()
                                    {
                                        window.location.replace('<?php echo base_url("index"); ?>');              
                                    }, 2000);    
                                }
                                else
                                {
                                    $("#login-modal-mensagem").addClass('text-danger').html( result.mensagem );  

                                    window.setTimeout(function()
                                    {
                                        $("#login-modal-mensagem").html( '' );
                                    }, 2000);    
                                }                                                                                            
                            },
                            error: function ( request, data, error ) 
                            {
                                console.log(error);
                                console.log(data);
                                console.log(request);
                            }
                        });
                    });
                });

            </script>
        <?php 
    }

}

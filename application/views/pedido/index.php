<?php 
    $template = new template();
    
    $template->head();
?>

<body class="">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">New Shop</p>
        </div>
    </div>
    <div id="main-wrapper">
        
        <?php $template->menu( 'pedidos' ); ?>
        
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="banner-innerpage" style="background-image:url(<?php echo base_url('assets/images/banner-bg4.jpg'); ?>">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-md-6 align-self-center text-center" data-aos="fade-down" data-aos-duration="1200">
                                <h1 class="title">Pedidos</h1>
                                <h6 class="subtitle op-8"></h6> 
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php if( isset( $_SESSION['sucess'] ) ): ?>
                    <div class="alert alert-success"> <i class="fa fa-check-circle-o"></i> <?php echo $_SESSION['sucess'] ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
                <?php endif; unset( $_SESSION['sucess'] ); ?>
                
                <?php if( isset( $_SESSION['atention'] ) ): ?>
                    <div class="alert alert-warning"> <i class="fa fa-check-circle-o"></i> <?php echo $_SESSION['atention'] ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
                <?php endif; unset( $_SESSION['atention'] ); ?>
                
                <div class="m-t-15">
                    <div class="container">                            
                        <?php if( isset( $_SESSION['cliente_id'] ) ): ?>

                                <?php if( !empty( $pedidos ) ): ?>
                                    <?php foreach( $pedidos as $pedido ): ?>
                                        <div class="row col-md-12 m-b-10" style="background-color: #000; padding: 10px;">   
                                            <div class="col-md-2 form-group">
                                                <label class="control-label">Código</label>
                                                <input type="text" value="<?php echo $pedido->id ?>" class="form-control" disabled>
                                            </div> 
                                            <div class="col-md-5 form-group">
                                                <label class="control-label">Valor</label>
                                                <input type="text" value="<?php echo $this->utility->valorParaTexto( $pedido->valor ); ?>" class="form-control" disabled>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <label class="control-label">Data</label>
                                                <input type="text" value="<?php echo $pedido->registro; ?>" class="form-control" disabled>
                                            </div>                                                 
                                            <div class="col-md-6 form-group">
                                                <label class="control-label">Logradouro</label>
                                                <input type="text" value="<?php echo $pedido->logradouro ?>" class="form-control" disabled>
                                            </div> 
                                            <div class="col-md-2 form-group">
                                                <label class="control-label">Numero</label>
                                                <input type="text" value="<?php echo $pedido->numero ?>" class="form-control" disabled>
                                            </div> 
                                            <div class="col-md-4 form-group">
                                                <label class="conrol-label">Bairro</label>
                                                <input type="text" value="<?php echo $pedido->bairro ?>" class="form-control" disabled>
                                            </div>

                                            <div class="col-md-5 form-group">
                                                <label class="conrol-label">Cidade</label>
                                                <input type="text" value="<?php echo $pedido->cidade ?>" class="form-control" disabled>
                                            </div> 
                                            <div class="col-md-4 form-group">
                                                <label class="conrol-label">Bairro</label>
                                                <input type="text" value="<?php echo $pedido->bairro ?>" class="form-control" disabled>
                                            </div> 
                                            <div class="col-md-3 form-group">
                                                <label class="conrol-label">Cep</label>
                                                <input type="text" value="<?php echo $pedido->cep ?>" class="form-control" disabled>
                                            </div> 
                                            <div class="col-md-12 form-group">
                                                <label class="conrol-label">Complemento</label>
                                                <input type="text" value="<?php echo $pedido->complemento ?>" class="form-control" disabled>
                                            </div>                                                                                                     
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <h4 class="text-info text-center">Não há pedidos registrados!</h4>
                                <?php endif; ?>                                                                                                                                                                                                                                                                                                           

                        <?php else: ?>
                            <div class="m-t-40">
                                <h4 class="text-info m-t-40">Realize o login para ter acesso ao seus pedidos!</h4>
                            </div>
                        <?php endif; ?>                                                                                    
                    </div>
                </div>
            </div>
            <a class="bt-top btn btn-circle btn-lg btn-info" href="#top"><i class="ti-arrow-up"></i></a>
        </div>
        
        <?php $template->footer(); ?>
        
    </div>
    
    <?php $template->bottom(); ?>
    
    <script type="text/javascript">
        
        var ultima_quantidade = [];
        
        $("#pedido").click(function()
        {
            $("#divEndereco").show('fast');
        });
                
        $(".quantidade").change(function()
        {
            var quantidade = $(this).val();
            var id         = $(this).data('id');
            
            $.ajax(
            {       
                type: 'POST',
                url: '<?php echo base_url('carrinho/quantidadeAjax'); ?>',
                data: { id: id, quantidade: quantidade },
                timeout: 30000,
                cache: false,
                async: 'true',
                dataType: 'text',
                beforeSend: function() 
                {

                },
                complete: function() 
                {

                },
                success: function() 
                {
                    window.location.replace('<?php echo base_url("carrinho"); ?>'); 
                },
                error: function ( request, data, error ) 
                {
                    console.log(error);
                    console.log(data);
                    console.log(request);
                }
            });
            
        });
        
    </script>
    
</body>

</html>
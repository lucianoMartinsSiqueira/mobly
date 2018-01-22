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
        
        <?php $template->menu( 'carrinho' ); ?>
        
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="banner-innerpage" style="background-image:url(<?php echo base_url('assets/images/banner-bg4.jpg'); ?>">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-md-6 align-self-center text-center" data-aos="fade-down" data-aos-duration="1200">
                                <h1 class="title">Carrinho de compras</h1>
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
                
                <div class="spacer">
                    <div class="container">
                        <div class="row">
                            
                            <?php if( isset( $_SESSION['cliente_id'] ) ): ?>
                                <div class="col-lg-12 ml-auto" >
                                    <table class="table shop-table table-bordered" id="produtos">                                        
                                        <?php if( !empty( $produtos ) ): ?>
                                            <tr style="background-color: #000;">
                                                <th class="b-0" style="color: #fff; text-align: center !important;">Produto</th>
                                                <th class="b-0" style="color: #fff; text-align: center !important;">Descrição</th>
                                                <th class="b-0" style="color: #fff; text-align: center !important;">Quantidade</th>
                                                <th class="b-0" style="color: #fff; text-align: center !important;">Preço</th>
                                                <th class="b-0" style="color: #fff; text-align: center !important;">X</th>
                                            </tr>
                                            <?php $total = 0; ?>
                                            <?php foreach( $produtos as $produto ): ?>
                                                <?php $total += $produto->preco * $produto->quantidade; ?>
                                                <tr>
                                                    <td align="center">
                                                        <img src="<?php echo base_url( "admin/uploads/$produto->imagem" ); ?>" width="100" alt="<?php echo $produto->nome ?>" />
                                                    </td>
                                                    <td>
                                                        <h6><?php echo $produto->nome ?></h6>        
                                                    <td class="text-center">
                                                        <select class="custom-select quantidade" id="inlineFormCustomSelect" data-id="<?php echo $produto->id ?>" data-preco="<?php echo $produto->preco ?>">
                                                            <option <?php if( $produto->quantidade == 1 ){ echo "selected"; } ?> value="1">1</option>
                                                            <option <?php if( $produto->quantidade == 2 ){ echo "selected"; } ?> value="2">2</option>
                                                            <option <?php if( $produto->quantidade == 3 ){ echo "selected"; } ?> value="3">3</option>
                                                            <option <?php if( $produto->quantidade == 4 ){ echo "selected"; } ?> value="4">4</option>
                                                            <option <?php if( $produto->quantidade == 5 ){ echo "selected"; } ?> value="5">5</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-right">
                                                        <h5 class="font-medium m-b-30"><?php $preco = $produto->preco * $produto->quantidade; echo $this->utility->valorParaTexto( $preco ); ?></h5>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?php echo base_url( "carrinho/remover/$produto->id" ); ?>" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr style="background-color: #000;">
                                                <td colspan="5">
                                                    <div class="d-flex">
                                                        <span class="m-l-20" style="color: #fff; font-weight: bold;">Total</span>
                                                        <h5 class="font-medium ml-auto p-r-10" id="total" style="color: #fff; font-weight: bold;"><?php echo $this->utility->valorParaTexto( $total ); ?></h5>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <h4 class="text-info text-center">Não há produtos adicionados ao carrinho!</h4>
                                        <?php endif; ?>                                                                                
                                    </table>                                                                                                            
                                         
                                    <?php if( !empty( $produtos ) ): ?>
                                    
                                    <h5 class="text-center" id="endereco" style="background-color: #00aff0; width: 100%; padding: 10px; color: #fff !important; cursor: pointer;">Selecionar o Endereço para Entrega</h5>
                                     
                                    <form method="post" action="<?php echo base_url( 'carrinho/pedido' ); ?>">
                                        <div class="col-md-12" id="divEndereco" style="display: none;">
                                            
                                        <?php if( !empty( $enderecos ) ): ?>
                                            <?php foreach( $enderecos as $endereco ): ?>
                                                <div class="row m-t-20" style="background-color: #F8D486; padding: 5px;">
                                                    <div class="col-md-12 form-group">
                                                        <label class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" name="endereco[]" value="<?php echo $endereco->id; ?>" type="checkbox">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Selecionar este endereço para entrega</span>
                                                        </label>
                                                    </div> 
                                                    <div class="col-md-6 form-group">
                                                        <label class="control-label">Logradouro</label>
                                                        <input type="text" value="<?php echo $endereco->logradouro ?>" class="form-control">
                                                    </div> 
                                                    <div class="col-md-2 form-group">
                                                        <label class="control-label">Numero</label>
                                                        <input type="text" value="<?php echo $endereco->numero ?>" class="form-control">
                                                    </div> 
                                                    <div class="col-md-4 form-group">
                                                        <label class="conrol-label">Bairro</label>
                                                        <input type="text" value="<?php echo $endereco->bairro ?>" class="form-control">
                                                    </div>
                                                    
                                                    <div class="col-md-5 form-group">
                                                        <label class="conrol-label">Cidade</label>
                                                        <input type="text" value="<?php echo $endereco->cidade ?>" class="form-control">
                                                    </div> 
                                                    <div class="col-md-4 form-group">
                                                        <label class="conrol-label">Bairro</label>
                                                        <input type="text" value="<?php echo $endereco->bairro ?>" class="form-control">
                                                    </div> 
                                                    <div class="col-md-3 form-group">
                                                        <label class="conrol-label">Cep</label>
                                                        <input type="text" value="<?php echo $endereco->cep ?>" class="form-control">
                                                    </div> 
                                                    <div class="col-md-12 form-group">
                                                        <label class="conrol-label">Complemento</label>
                                                        <input type="text" value="<?php echo $endereco->complemento ?>" class="form-control">
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <button type="button" class="btn btn-success btn-sm m-t-20 pull-right" data-toggle="modal" data-target="#endereco-modal">Novo Endereço</button>
                                        <?php else: ?>                                        
                                            <button type="button" class="btn btn-success btn-sm m-t-20 pull-right" data-toggle="modal" data-target="#endereco-modal">Novo Endereço</button>                                        
                                        <?php endif; ?>
                                    </div>    
                                    
                                    <button type="submit" class="btn btn-info btn-block m-t-20 pull-right">Finalizar Compra</button>
                                    
                                    </form>
                                    
                                    <?php endif; ?>
                                    
                                </div>
                            <?php else: ?>
                                <div style="text-align: center !important">
                                    <h4 class="text-info text-center">Realize o login para ter acesso ao seu carrinho de compras!</h4>
                                </div>
                            <?php endif; ?>                                                                                    
                        </div>
                    </div>
                </div>
            </div>
            <a class="bt-top btn btn-circle btn-lg btn-info" href="#top"><i class="ti-arrow-up"></i></a>
        </div>
        
        <div id="endereco-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="text-center m-t-30" align="center">
                            <img src="<?php echo base_url('assets/images/newshop.png'); ?>" alt="logo" />
                            <h4 class="text-info text-center" align="center">ADICIONAR ENDEREÇO</h4>
                        </div>
                        <div class="modal-body" style="background-color: #02bec9">
                            <form class="" id="form">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label text-white">Logradouro</label>
                                        <input type="text" name="logradouro" class="form-control">
                                    </div> 
                                    <div class="col-md-2 form-group">
                                        <label class="control-label text-white">Numero</label>
                                        <input type="text" name="numero" value="" class="form-control">
                                    </div> 
                                    <div class="col-md-4 form-group">
                                        <label class="conrol-label text-white">Bairro</label>
                                        <input type="text" name="bairro" value="" class="form-control">
                                    </div>

                                    <div class="col-md-5 form-group">
                                        <label class="conrol-label text-white">Cidade</label>
                                        <input type="text" name="cidade" value="" class="form-control">
                                    </div> 
                                    <div class="col-md-4 form-group">
                                        <label class="conrol-label text-white">UF</label>
                                        <input type="text" name="uf" value="" class="form-control">
                                    </div> 
                                    <div class="col-md-3 form-group">
                                        <label class="conrol-label text-white">Cep</label>
                                        <input type="text" name="cep" value="" class="form-control">
                                    </div> 
                                    <div class="col-md-12 form-group text-white">
                                        <label class="conrol-label">Complemento</label>
                                        <input type="text" name="" value="" class="form-control">
                                    </div>
                                </div>                                    
                            </form>
                            <h4 class="text-center m-t-30" id="login-modal-mensagem"></h4>
                        </div>
                        <div class="modal-footer" id="login-modal-footer">
                            <button type="button" class="btn btn-inverse waves-effect" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success waves-effect waves-light" id="btnAddEndereco">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        
        <?php $template->footer(); ?>
        
    </div>
    
    <?php $template->bottom(); ?>
    
    <script type="text/javascript">
        
        var ultima_quantidade = [];
        
        $("#endereco").click(function()
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
        
        $("#btnAddEndereco").click(function()
        {
            
            if( $("#form").valid() )
            {
                var datastring = $("#form").serialize();
                
                $.ajax(
                {       
                    type: 'POST',
                    url: '<?php echo base_url('carrinho/addEnderecoAjax'); ?>',
                    data: datastring,
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
                    success: function( result ) 
                    {
                        $('#endereco-modal').modal('hide');
                        $('#divEndereco').html('');
                        $('#divEndereco').html(result);
                    },
                    error: function ( request, data, error ) 
                    {
                        console.log(error);
                        console.log(data);
                        console.log(request);
                    }
                });   
            }
        });
        
        $("#form").validate(
        {
            rules: 
            {
                logradouro: "required",
                numero: "required",
                bairro: "required",
                cidade: "required",
                uf: "required",
                cep: "required"
            },
            messages: 
            {
                logradouro: "Obrigatório",
                numero: "Obrigatório",
                bairro: "Obrigatório",
                cidade: "Obrigatório",
                uf: "Obrigatório",
                cep: "Obrigatório"
            }
        });
        
    </script>
    
</body>

</html>
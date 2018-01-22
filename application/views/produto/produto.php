<?php 
    $template = new template();
    
    $template->head();
?>

<body class="">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Wrapkit</p>
        </div>
    </div>
    <div id="main-wrapper">
        
        <?php $template->menu( 'index' ); ?>
        
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="banner-innerpage" style="background-image:url(<?php echo base_url('assets/images/banner-bg4.jpg'); ?>">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-md-6 align-self-center text-center" data-aos="fade-down" data-aos-duration="1200">
                                <h1 class="title">Produto</h1>
                                <h6 class="subtitle op-8"></h6> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="spacer">
                    <div class="container">
                        <div class="row m-t-30">
                            <div class="col-lg-5">
                                <div class="owl-carousel owl-theme image-slide">
                                    <?php foreach( $imagens as $imagem ): ?>
                                        <div class="item"><img src="<?php echo base_url( "admin/uploads/$imagem->imagem" ); ?>" class="img-responsive" alt="Produto" /></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <form action="<?php echo base_url( "carrinho/insert/$dados->id" ); ?>" method="post">
                            <div class="col-lg-6 ml-auto">
                                <h4 class="title"><?php echo $dados->nome; ?></h4>
                                <h4 class="font-medium m-b-30"><?php echo $dados->preco; ?></h4>
                                <div class="form-group">
                                    <h6 class="m-t-20">Quantidade</h6>
                                    <select class="form-control" id="quantidade" name="quantidade">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <button type="submit" id="btnAddCarrinho" class="btn btn-info btn-md m-t-20">Adicionar ao Carrinho</button>
                            </div>
                            </form>
                        </div>
                        <div class="row m-t-40 m-b-40">
                            <div class="col-md-12">
                                <h5 class="title font-medium">Descrição</h5>
                                <p><?php echo $dados->descricao; ?></p>                               
                            </div>
                        </div>
                        <div class="row shop-listing m-t-40">
                            <div class="col-lg-12">
                                <h4>Produtos Relacionados</h4>
                            </div>
                            <?php foreach( $relacionados as $relacionado ): ?>
                                <div class="col-lg-3">
                                    <div class="card shop-hover">
                                        <img src="<?php echo base_url("admin/uploads/$relacionado->imagem"); ?>" alt="wrapkit" class="img-fluid" />
                                        <div class="card-img-overlay align-items-center">
                                            <a href="<?php echo base_url( "index/produto/$relacionado->id" ); ?>" class="btn btn-sm btn-info-gradiant"><i class="fa fa-search"></i> Visualizar</a> 
                                            &nbsp&nbsp&nbsp
                                            <a href="<?php echo base_url( "carrinho/insert/$relacionado->id" ); ?>" class="btn btn-sm btn-info-gradiant"><i class="fa fa-cart-plus"></i> Carrinho</a>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <h6><a href="<?php echo base_url("index/produto/$relacionado->id"); ?>" class="link"><?php echo $relacionado->nome; ?> </a></h6>
                                        <h5 class="font-medium m-b-30"><?php echo $relacionado->preco; ?></h5>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <a class="bt-top btn btn-circle btn-lg btn-info" href="#top"><i class="ti-arrow-up"></i></a>
        </div>
        
        <?php $template->footer(); ?>
        
    </div>
    
    <?php $template->bottom(); ?>
    
</body>


</html>
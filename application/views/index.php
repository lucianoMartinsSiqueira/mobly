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
        
        <?php $template->menu( 'index' ); ?>
        
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="banner-innerpage" style="background-image:url(<?php echo base_url('assets/images/banner-bg4.jpg'); ?>">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-md-6 align-self-center text-center" data-aos="fade-down" data-aos-duration="1200">
                                <h1 class="title">Produtos</h1>
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
                        <div class="row m-t-30">
                            <div class="col-lg-3">
                                <div class="m-b-40">
                                    <h5 class="title">Categorias</h5>
                                    <ul class="list-icons">
                                        <?php if( !empty( $categorias ) ): ?>
                                            <?php foreach( $categorias as $categoria ): ?>
                                                <li><a href="<?php echo base_url("index/index/$categoria->id") ?>"><i class="fa fa-check-circle text-themecolor"></i> <?php echo $categoria->nome ?></a></li>
                                            <?php endforeach; ?>                                                                    
                                        <?php else: ?>
                                            <h4 class="col-md-12 text-info">Não há produtos registrados!</h4>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="m-b-40">
                                    <h5 class="title m-b-30">Mais Visualizados</h5>
                                    
                                    <?php foreach( $populares as $popular ): ?>
                                        <div class="d-flex no-block m-b-20 m-t-20">
                                            <div class="btext m-r-10">
                                                <h6 class="m-b-0"><a href="<?php echo base_url( "index/produto/$popular->id" ); ?>" class="link"><?php echo $popular->nome ?></a></h6>
                                                <h6 class="font-medium m-t-5"><?php echo $popular->preco ?></h6>
                                            </div>
                                            <div class="thumb ml-auto"><a href="<?php echo base_url( "index/produto/$popular->id" ); ?>"><img src="<?php echo base_url( "admin/uploads/$popular->imagem" ); ?>" alt="wrapkit" width="70"></a></div>
                                        </div>
                                    <?php endforeach; ?>            
                                </div>
                            </div>
                            <div class="col-lg-9">                                                                                                
                                <div class="d-flex m-b-40">
                                    <span class="align-self-center">showing 1-9 of 20 results</span>
                                    <div class="align-self-center ml-auto">
                                        <select class="form-control col-12" id="inlineFormCustomSelect">
                                            <option selected="">Default Sorting</option>
                                            <option value="1">25</option>
                                            <option value="2">50</option>
                                            <option value="3">100</option>
                                        </select>
                                    </div>
                                </div>                                                                                                
                                <div class="row shop-listing">                                    
                                    <?php if( !empty( $produtos ) ): ?>
                                        <?php foreach( $produtos as $produto ): ?>
                                        <div class="col-lg-4">
                                            <div class="card shop-hover">
                                                <img src="<?php echo base_url( "admin/uploads/$produto->imagem" ); ?>" alt="wrapkit" class="img-fluid" />
                                                <div class="card-img-overlay align-items-center">
                                                    <a href="<?php echo base_url( "index/produto/$produto->id" ); ?>" class="btn btn-sm btn-info-gradiant"><i class="fa fa-search"></i> Visualizar</a> 
                                                    &nbsp&nbsp&nbsp
                                                    <a href="<?php echo base_url( "carrinho/insert/$produto->id" ); ?>" class="btn btn-sm btn-info-gradiant"><i class="fa fa-cart-plus"></i> Carrinho</a>
                                                </div>
                                                <span class="label label-rounded label-danger">Oferta</span>
                                            </div>
                                            <div class="card">
                                                <h6><a href="#" class="link"><?php echo $produto->nome ?> </a></h6>
                                                <h5 class="font-medium m-b-30"><?php echo $produto->preco ?></h5>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>                                                                    
                                    <?php else: ?>
                                        <h4 class="col-md-12 text-info m-t-40 text-center">Não há produtos disponíveis para esta categoria no momento!</h4>
                                    <?php endif; ?>                                                                        
                                </div>
                            </div>
                            
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
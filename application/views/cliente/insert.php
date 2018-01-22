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
        
        <?php $template->menu( '' ); ?>
        
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="banner-innerpage" style="background-image:url(<?php echo base_url('assets/images/banner-bg4.jpg'); ?>">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <div class="col-md-6 align-self-center text-center" data-aos="fade-down" data-aos-duration="1200">
                                <h1 class="title">Cadastro</h1>
                                <h6 class="subtitle op-8"></h6> 
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="container m-t-40">
                    <form class="form-material row" action="<?php echo base_url( "cliente/insert" ); ?>" method="POST" id="form">
                        <div class="form-group col-md-6">
                            <label class="control-label">Nome</label>
                            <input type="text" name="nome" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">CPF</label>
                            <input type="text" name="cpf" class="form-control" id="cpf">
                        </div> 
                        <div class="form-group col-md-3">
                            <label class="control-label">RG</label>
                            <input type="text" name="rg" class="form-control">
                        </div>
                        
                        <div class="clearfix"></div>
                        
                        <div class="form-group col-md-3">
                            <label class="control-label">Sexo</label>
                            <select class="form-control" name="sexo">
                                <option>Selecione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Senha</label>
                            <input type="password" name="senha" class="form-control">
                        </div>
                        
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light">Gravar</button>
                        </div>
                        
                    </form>
                </div>    
                
            </div>
            <a class="bt-top btn btn-circle btn-lg btn-info" href="#top"><i class="ti-arrow-up"></i></a>
        </div>
        
        <?php $template->footer(); ?>
        
    </div>
            
    <?php $template->bottom(); ?>
    
    <script type="text/javascript">
        
        $('#cpf').mask('000.000.000-00', {reverse: true});
        
        $("#form").validate(
        {
            rules: 
            {
                    nome: "required",
                    cpf: "required",
                    senha: "required"
            },
            messages: 
            {
                nome: "Obrigatório",
                cpf: "Obrigatório",
                senha: "Obrigatório"
            }
        });
                
    </script>
    
</body>

</html>
<style>
    .imagencard{
        width: 350px;
        height: 200px;
    }
</style>
<div style="height: 5vh"></div> 
<h1 class="h2-responsive orange-text text-center">Acerca</h1>

<blockquote class="text-center blockquote">
    <p>Immerpro es un proyecto web orientado al proceso de inventarios para minimercados realizado por aprendices del sena como proyecto de grado.</p>

</blockquote>
<div>

    <h1 class="h2-responsive orange-text text-center">Caracteristicas</h1>
    <div style="height: 5vh"></div> 

    <div class="container">

        <!--Carousel Wrapper-->
        <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
            <!--Indicators-->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-1z" data-slide-to="1"></li>
                <li data-target="#carousel-example-1z" data-slide-to="2"></li>
            </ol>
            <!--/.Indicators-->
            <!--Slides-->
            <div class="carousel-inner" role="listbox">
                <!--First slide-->
                <div class="carousel-item active">
                    <img class="d-block w-100" src="<?PHP echo base_url(); ?>/public/img/market1.jpg" alt="First slide">
                </div>
                <!--/First slide-->
                <!--Second slide-->
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?PHP echo base_url(); ?>/public/img/market2.jpg" alt="Second slide">
                </div>
                <!--/Second slide-->
                <!--Third slide-->
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?PHP echo base_url(); ?>/public/img/market3.jpg" alt="Third slide">
                </div>
                <!--/Third slide-->
            </div>
            <!--/.Slides-->
            <!--Controls-->
            <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <!--/.Controls-->
        </div>
        <!--/.Carousel Wrapper-->

        <br>

 <div id="acerca"></div>
        <div class="row">
            <div class=" col-md-4">
                <!--Card-->
                <div class="card">

                    <!--Card image-->
                    <div class="view overlay hm-white-slight">
                        <img  class="imagencard" src="<?PHP echo base_url(); ?>/public/img/woman_market.jpg">
                        <a href="#">
                            <div class="mask"></div>
                        </a>
                    </div>

                    <!--Card content-->
                    <div class="card-body">
                        <!--Title-->
                        <h4 class="card-title">1</h4>
                        <!--Text-->
                        <p class="card-text">Facil manejo y orientado al cliente</p>
                    </div>

                </div> 
            </div>

            <div class="col-md-4">
                <div class="card">



                    <!--Card image-->
                    <div class="view overlay hm-white-slight">
                        <img  class="imagencard" src="<?PHP echo base_url(); ?>/public/img/woman_market_2.jpg">
                        <a href="#">
                            <div class="mask"></div>
                        </a>
                    </div>

                    <!--Card content-->
                    <div class="card-body">
                        <!--Title-->
                        <h4 class="card-title">2</h4>
                        <!--Text-->
                        <p class="card-text">Gestiona los inventarios de manera segura</p>
                    </div>

                </div>
            </div>




            <div class=" col-md-4">
                <div class="card">



                    <!--Card image-->
                    <div class="view overlay hm-white-slight">
                        <img  class="imagencard" src="<?PHP echo base_url(); ?>/public/img/food.jpg">
                        <a href="#">
                            <div class="mask"></div>
                        </a>
                    </div>

                    <!--Card content-->
                    <div class="card-body">
                        <!--Title-->
                        <h4 class="card-title">3</h4>
                        <!--Text-->
                        <p class="card-text">Agilidad en sus procesos</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="thumbnail">


            <!--Section: Contact v.1-->
            <section class="section mb-4">
                <div style="height: 5vh"></div> 
                <!--Section heading-->
                <div id="contacto"></div>
                <h1 class="section-heading text-center orange-text">Contactanos</h1>

                <!--Section sescription-->
                <div class="row flex-center">
                    <div class="col-md-6"></div>

                    <div class="col-md-6">

                    </div>
                   
                    <div class="col-md-7">

                        <!-- Contact form -->
                        <form>
                            <div class="md-form">
                                <i class="fa fa-user prefix grey-text"></i>
                                <input type="text" id="form3" class="form-control">
                                <label for="form3">Tu nombre</label>
                            </div>

                            <div class="md-form">
                                <i class="fa fa-envelope prefix grey-text"></i>
                                <input type="text" id="form2" class="form-control">
                                <label for="form2">Tu email</label>
                            </div>

                            <div class="md-form">
                                <i class="fa fa-tag prefix grey-text"></i>
                                <input type="text" id="form32" class="form-control">
                                <label for="form34">Asunto</label>
                            </div>

                            <div class="md-form">
                                <i class="fa fa-pencil prefix grey-text"></i>
                                <textarea type="text" id="form8" class="md-textarea" style="height: 100px"></textarea>
                                <label for="form8">Su mensaje</label>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-orange">Enviar <i class="fa fa-paper-plane-o ml-1"></i></button>
                            </div>

                        </form>
                        <!-- Contact form -->


                    </div>
                    <!--/Second column-->

                </div>

            </section>
            <!--/Section: Contact v.1-->
        </div>
    </div>
</div>

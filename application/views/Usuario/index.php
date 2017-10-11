<style>
    .imagencard{
        width: 350px;
        height: 200px;
    }
</style>




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

        

                    <!--Card content-->
                    
<center>
                    <div class="col-md-10">

                        <!-- Contact form -->

                        <form action="<?php base_url() ?>contacto" method="POST" data-parsley-validate>
                            
                            <div class="col-lg-30 ">
						<div class="form-wrapper">
						<div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">
						
							<div class="panel panel-skin">
							<div class="panel-heading">
									<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Dijita tus datos <small>(es gratis!)</small></h3>
									</div>
									<div class="panel-body">
									    <div id="sendmessage">Gracias por escribirnos</div>
                                        <div id="errormessage"></div>
                                   
    					                <form action="" method="post" role="form" class="contactForm lead">
    										<div class="row">
    											<div class="col-xs-6 col-sm-6 col-md-6">
    												<div class="form-group">
    													<label>Nombre</label>
    													<input type="text" name="first_name" id="first_name" class="form-control input-md" data-rule="minlen:3" data-msg="Please enter at least 3 chars">
                                                        <div class="validation"></div>
    												</div>
    											</div>
    											<div class="col-xs-6 col-sm-6 col-md-6">
    												<div class="form-group">
    													<label>Apellido</label>
    													<input type="text" name="last_name" id="last_name" class="form-control input-md" data-rule="minlen:3" data-msg="Please enter at least 3 chars">
                                                        <div class="validation"></div>
    												</div>
    											</div>
    										</div>

    										<div class="row">
    											<div class="col-xs-6 col-sm-6 col-md-6">
    												<div class="form-group">
    													<label>Correo</label>
    													<input type="email" name="email" id="email" class="form-control input-md" data-rule="email" data-msg="Please enter a valid email">
                                                        <div class="validation"></div>
    												</div>
    											</div>
    											<div class="col-xs-6 col-sm-6 col-md-6">
    												<div class="form-group">
    													<label>Numero de celular</label>
    													<input type="text" name="phone" id="phone" class="form-control input-md" data-rule="required" data-msg="The phone number is required">
                                                        <div class="validation"></div>
    												</div>
    											</div>
    										</div>
    										
    										<input  type="submit" value="Submit" class="btn btn-skin btn-block btn-lg">
    										
    										<p class="lead-footer">*Recordamos que todos tus datos son confidenciales e importantes para nosotros</p>
    									
    									</form>
								</div>
							</div>				
						
						</div>
						</div>
					</div>	
                    <!--/Second column-->
                     <div class="row">
            <?php messages_flash('red',validation_errors(),'Errores del formulario', true);?>
        </div>

                </div>
               
            </section></center>
            <!--/Section: Contact v.1-->
        </div>
    </div>
</div>

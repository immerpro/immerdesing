<footer class="page-footer blue center-on-small-only">

    <!--Footer Links-->
    <div class="container-fluid">
        <div class="row">

            <!--First column-->
            <div class="col-md-6">
                <?php
                $propiedad_img = array(
                    'src' => 'public/img/immerproLogo.png',
                    'alt' => 'immerpro',
                    'class' => 'animated fadeIn mb-2 img-fluid',
                    'title' => 'logo',
                    'width' => '500px',
                );

                echo img($propiedad_img);
                ?>

            </div>
            <!--/.First column-->

            <!--Second column-->
            <div class="col-md-6">
                <h5 class="title">SIGUENOS EN:</h5>
                <ul>
                    <a href="https://www.facebook.com/profile.php?id=100017326595591" target="_blank"><button type="button" class="btn btn-fb btn btn-primary"><i class="fa fa-facebook left"></i> Facebook</button></a>  
                    <a href="https://twitter.com/immerpro" target="_blank"><button type="button" class="btn btn-tw btn btn-info"><i class="fa fa-twitter left"></i> Twitter</button></a>  
                    <a href="https://plus.google.com/u/0/107704821156580446351" target="_blank"><button type="button" class="btn btn-gplus btn btn-warning"><i class="fa fa-google-plus left"></i> Google +</button></a>
                    <a href="https://www.youtube.com/channel/UC0UYz7Hd4MCww0bFkE1qLlg" target="_blank"><button type="button" class="btn btn-yt btn btn-danger"><i class="fa fa-youtube left"></i> Youtube</button></a>
                </ul>
            </div>
            <!--/.Second column-->
        </div>
    </div>
    <!--/.Footer Links-->

    <!--Copyright-->
    <div class="footer-copyright">
        <div class="container-fluid">
            © ImmerPro 2017

        </div>
    </div>
    <!--/.Copyright-->

</footer>

<script>
    $(document).ready(function () {
        $('form').parsley();
    });
</script>
<!--/.Footer-->

<!-- /Start your project here-->

<!-- SCRIPTS -->
<!-- JQuery -->

<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?PHP echo base_url() ?>public/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?PHP echo base_url() ?>public/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?PHP echo base_url() ?>public/js/mdb.min.js"></script>


</body>

</html>

<?php
require_once("db.php");
$setting = "SELECT * FROM `setting` WHERE `status`= 1";
$settings = mysqli_query($conn,$setting);
$assoc = mysqli_fetch_assoc($settings);
?>
<!-- footer -->
        <footer>
            <div class="copyright-wrap">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="copyright-text text-center">
                                <span><?php echo $assoc['footerText'];?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer-end -->
		<!-- JS here -->
        <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/one-page-nav-min.js"></script>
        <script src="assets/js/slick.min.js"></script>
        <script src="assets/js/ajax-form.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/aos.js"></script>
        <script src="assets/js/jquery.waypoints.min.js"></script>
        <script src="assets/js/jquery.counterup.min.js"></script>
        <script src="assets/js/jquery.scrollUp.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
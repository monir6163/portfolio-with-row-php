<?php
require_once("db.php");
?>
<?php include "inc/header.php"?>

        <!-- main-area -->
        <main>

            <!-- banner-area -->
            <?php
            $select = "SELECT * FROM `banner` WHERE `status`= 1";
            $run = mysqli_query($conn,$select);
            $assoc = mysqli_fetch_assoc($run);
            ?>
            <section id="home" class="banner-area banner-bg fix">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-7 col-lg-6">
                            <div class="banner-content">
                                <h6 class="wow fadeInUp" data-wow-delay="0.2s"><?php echo $assoc['sub_title'];?>!</h6>
                                <h2 class="wow fadeInUp" data-wow-delay="0.4s"><?php echo $assoc['title'];?></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.6s"><?php echo $assoc['summery'];?></p>
                                <div class="banner-social wow fadeInUp" data-wow-delay="0.8s">
                                    <?php
                                    $select = "SELECT * FROM `social` WHERE `status`= 1";
                                    $run = mysqli_query($conn,$select);
                                    ?>
                                    <ul>
                                        <?php
                                        foreach ($run as $key => $value) {?>
                                           <li><a href="<?php echo $value['link'];?>"><i class="<?php echo $value['icon'];?>"></i></a></li>
                                       <?php }

                                        ?>
                                    </ul>
                                </div>
                                <?php
                                $select = "SELECT * FROM `fiverr` WHERE `status`= 1";
                                $run = mysqli_query($conn,$select);
                                $assoc = mysqli_fetch_assoc($run);
                                ?>
                                <a href="<?php echo $assoc['fiverrlink'];?>" target="_blank" class="btn wow fadeInUp" data-wow-delay="1s">Let's GO Fiverr</a>
                            </div>
                        </div>
                        <?php
                        $select = "SELECT * FROM `banner` WHERE `status`= 1";
                        $run = mysqli_query($conn,$select);
                        $assoc = mysqli_fetch_assoc($run);
                        ?>
                        <div class="col-xl-5 col-lg-6 d-none d-lg-block">
                            <div class="banner-img text-right">
                                <img src="assets/images/banner/<?php echo $assoc['img'];?>" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner-shape"><img src="assets/img/shape/dot_circle.png" class="rotateme" alt="img"></div>
            </section>
            <!-- banner-area-end -->

            <!-- about-area-->
            <?php
            $select = "SELECT * FROM `about` WHERE `status`= 1";
            $run = mysqli_query($conn,$select);
            $assoc = mysqli_fetch_assoc($run);
            ?>
            <section id="about" class="about-area primary-bg pt-120 pb-120">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="about-img">
                                <img src="assets/images/about/<?php echo $assoc['about_img'];?>" alt="about">
                            </div>
                        </div>
                        <div class="col-lg-6 pr-90">
                            <div class="section-title mb-25">
                                <span>Introduction</span>
                                <h2>About Me</h2>
                            </div>
                            <div class="about-content">
                                <p><?php echo $assoc['about'];?></p>
                                <h3>Education:</h3>
                            </div>
                            <!-- Education Item -->
                            <?php
                            $select = "SELECT * FROM `education` WHERE `status`= 1";
                            $educations = mysqli_query($conn,$select);
                            foreach ($educations as $key => $education) {?>
                            <div class="education">
                                <div class="year"><?php echo $education['year'];?></div>
                                <div class="line"></div>
                                <div class="location">
                                    <span><?php echo $education['title'];?></span>
                                    <div class="progressWrapper">
                                        <div class="progress">
                                            <div class="progress-bar wow slideInLefts" data-wow-delay="0.2s" data-wow-duration="2s" role="progressbar" style="width: <?php echo $education['number'];?>%;" aria-valuenow="<?php echo $education['number'];?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <?php }
                            ?>
                            <!-- End Education Item -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- about-area-end -->

            <!-- Services-area -->
            <section id="service" class="services-area pt-120 pb-50">
				<div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8">
                            <div class="section-title text-center mb-70">
                                <span>WHAT WE DO</span>
                                <h2>SERVICES AND SOLUTIONS</h2>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <?php
                        $service_select = "SELECT * FROM `services` WHERE `services_status`= 1 ORDER BY services_id DESC";
                        $services = mysqli_query($conn,$service_select);
                         foreach ($services as $key => $service) {
                        ?>
                           <div class="col-lg-4 col-md-6">
                               <div class="icon_box_01 wow fadeInLeft" data-wow-delay="0.2s">
                                    <i class="<?php echo $service['services_icon'];?>"></i>
                                    <h3><?php echo $service['services_title'];?></h3>
                                    <p>
                                        <?php echo $service['services_summery'];?>
                                    </p>
                                </div>
                            </div>
                        <?php }
                        ?>
					</div>
				</div>
			</section>
            <!-- Services-area-end -->

            <!-- Portfolios-area -->
            <section id="portfolio" class="portfolio-area primary-bg pt-120 pb-90">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8">
                            <div class="section-title text-center mb-70">
                                <span>Portfolio Showcase</span>
                                <h2>My Recent Best Works</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                          $portfolio_select = "SELECT * FROM `portfolios` WHERE `status`= 1 ORDER BY portfolio_id DESC";
                          $portfolio_query = mysqli_query($conn,$portfolio_select);
                        foreach ($portfolio_query as $key => $portfolio) {?>
                        <div class="col-lg-4 col-md-6 pitem">
                            <div class="speaker-box">
                                <div class="speaker-thumb">
                                    <img src="assets/images/portfolios/<?php echo $portfolio['thumbnail'];?>" alt="img">
                                </div>
                                <div class="speaker-overlay">
                                    <span><?php echo $portfolio['category'];?></span>
                                    <h4><a href="single_portfolio.php?id=<?php echo $portfolio['portfolio_id'];?>"><?php echo $portfolio['title'];?></a></h4>
                                    <a href="single_portfolio.php?id=<?php echo $portfolio['portfolio_id'];?>" class="arrow-btn">More information <span></span></a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <!-- services-area-end -->


            <!-- fact-area -->
            <section class="fact-area">
                <div class="container">
                    <div class="fact-wrap">
                        <div class="row justify-content-between">
                            <?php
                        $counter_select = "SELECT * FROM `counter` WHERE `status`= 1";
                        $counters = mysqli_query($conn,$counter_select);
                        foreach ($counters as $key => $counter) {
                            ?>
                            <div class="col-xl-2 col-lg-3 col-sm-6">
                                <div class="fact-box text-center mb-50">
                                    <div class="fact-icon">
                                        <i class="<?php echo $counter['icon'];?>"></i>
                                    </div>
                                    <div class="fact-content">
                                        <h2><span class="count"><?php echo $counter['number'];?></span></h2>
                                        <span><?php echo $counter['title'];?></span>
                                    </div>
                                </div>
                            </div>
                       <?php }
                        ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- fact-area-end -->

            <!-- testimonial-area -->
            <section class="testimonial-area primary-bg pt-115 pb-115">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8">
                            <div class="section-title text-center mb-70">
                                <span>testimonial</span>
                                <h2>happy customer quotes</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10">
                            <div class="testimonial-active">
                                <?php
                                $testimonial_select = "SELECT * FROM `testimonials` WHERE `status`= 1";
                                $testimonials = mysqli_query($conn,$testimonial_select);
                                foreach ($testimonials as $key => $testimonial) {?>
                                    <div class="single-testimonial text-center">
                                    <div class="testi-avatar">
                                        <img src="assets/images/testimonial/<?php echo $testimonial['img'];?>" alt="img">
                                    </div>
                                    <div class="testi-content">
                                        <h4><span>“</span> <?php echo $testimonial['summery'];?><span>”</span></h4>
                                        <div class="testi-avatar-info">
                                            <h5><?php echo $testimonial['title'];?></h5>
                                            <span><?php echo $testimonial['sub_title'];?></span>
                                        </div>
                                    </div>
                                </div>
                               <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- testimonial-area-end -->

            <!-- brand-area -->
            <div class="barnd-area pt-100 pb-100">
                <div class="container">
                    <div class="row brand-active">
                        <?php
                        $brand_select = "SELECT * FROM `brand` WHERE `status`= 1";
                        $brands = mysqli_query($conn,$brand_select);
                        foreach ($brands as $key => $brand) {?>
                            <div class="col-xl-2">
                            <div class="single-brand">
                                <img src="assets/images/brand/<?php echo $brand['brand_img'];?>" alt="img">
                            </div>
                        </div>
                      <?php  }
                        ?>
                    </div>
                </div>
            </div>
            <!-- brand-area-end -->

            <!-- contact-area -->
            <section id="contact" class="contact-area primary-bg pt-120 pb-120">
            <?php
            $contact = "SELECT * FROM `contact` WHERE `status`= 1";
            $contacts = mysqli_query($conn,$contact);
            $assoc = mysqli_fetch_assoc($contacts);
            ?>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="section-title mb-20">
                                <span>information</span>
                                <h2>Contact Information</h2>
                            </div>
                            <div class="contact-content">
                                <p><?php echo $assoc['summery'];?></p>
                                <h5>OFFICE IN <span><?php echo $assoc['off_title'];?></span></h5>
                                <div class="contact-list">
                                    <ul>
                                        <li><i class="fas fa-map-marker"></i><span>Address :</span><?php echo $assoc['address'];?></li>
                                        <li><i class="fas fa-headphones"></i><span>Phone :</span><?php echo $assoc['phone'];?></li>
                                        <li><i class="fas fa-globe-asia"></i><span>e-mail :</span><?php echo $assoc['email'];?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-form">
                                <form action="contact.php" method="POST">
                                    <input type="text" name="name" placeholder="your name *">
                                    <p class="text-color">
                                        <?php if (isset($_SESSION['nameError'])) : ?>
                                            <style>
                                                .text-color {
                                                    color: red;
                                                }

                                                .name-border {
                                                    border: 1px solid red !important;
                                                }
                                            </style>
                                        <?php
                                            echo $_SESSION['nameError'];
                                            unset($_SESSION['nameError']);
                                        endif;
                                        ?>
                                    </p>
                                    <input type="email" name="email" placeholder="your email *">
                                    <p class="text-color">
                                        <?php if (isset($_SESSION['emailError'])) : ?>
                                            <style>
                                                .text-color {
                                                    color: red;
                                                }

                                                .email-border {
                                                    border: 1px solid red !important;
                                                }
                                            </style>
                                        <?php
                                            echo $_SESSION['emailError'];
                                            unset($_SESSION['emailError']);
                                        endif;
                                        ?>
                                    </p>
                                    <textarea name="message" id="message" placeholder="your message *"></textarea>
                                        <p class="text-color">
                                        <?php if (isset($_SESSION['messageError'])) : ?>
                                            <style>
                                                .text-color {
                                                    color: red;
                                                }

                                                .text-border {
                                                    border: 1px solid red !important;
                                                }
                                            </style>
                                        <?php
                                            echo $_SESSION['messageError'];
                                            unset($_SESSION['messageError']);
                                        endif;
                                        ?>
                                    </p>
                                    <button type="submit" class="btn">SEND</button>
                                    <br><br>
                                    <span class="text-success">
                                        <?php
                                            if (isset($_SESSION['message'])) {
                                                echo $_SESSION['message'];
                                                unset($_SESSION['message']);
                                            }
                                        ?>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- contact-area-end -->

        </main>
        <!-- main-area-end -->
<?php include "inc/footer.php"?>

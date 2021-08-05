<!-- [MAIN] Slider -->
<section class="w3l-main-slider position-relative" id="home">
	<div class="companies20-content">
		<div class="owl-one owl-carousel owl-theme">
			<div class="item">
                <div class="slider-info banner-view bg bg2">
                    <div class="container banner-info">
                        <div class="banner-info-bg">
                            <h5>Buying A USED CAR?</h5>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</section>

<style>
    
    <?php if ($_SERVER['SERVER_NAME'] == 'www.americanvinhistory.com'): ?>
        
        .w3l-main-slider .banner-view {
            background: url('assets/images/banner1.jpg') no-repeat center;
            background-size: cover;
            min-height: calc(100vh - 30px);
            position: relative;
            z-index: 0;
            display: grid;
            align-items: center;
        }
    
    <?php elseif ($_SERVER['SERVER_NAME'] == 'www.vinvehiclehistoryreports.us.org'): ?>

        .w3l-main-slider .banner-view {
            background: url('assets/images/banner0.jpg') no-repeat center;
            background-size: cover;
            min-height: calc(100vh - 30px);
            position: relative;
            z-index: 0;
            display: grid;
            align-items: center;
        }

    <?php else: ?>

        .w3l-main-slider .banner-view {
            background: url('assets/images/banner1.jpg') no-repeat center;
            background-size: cover;
            min-height: calc(100vh - 30px);
            position: relative;
            z-index: 0;
            display: grid;
            align-items: center;
        }

    <?php endif; ?>

</style>
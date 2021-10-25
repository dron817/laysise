<form action="index.php" class="shake" role="form" method="post" id="setup" name="setup">
    <section class="choose-section section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title -->
                <div class="col-md-12 wow animated fadeInLeft" data-wow-delay=".2s">
                    <h1 class="section-title">Выберете своего героя</h1>
                </div>
            </div>
            <div class="row">
                <!-- Single Counter -->
                <div class="col-md-4 col-sm-12 work-counter-widget text-center wow animated fadeInUp"
                     data-wow-delay=".2s">
                    <div class="counter">
                        <input id="hero_1" type="radio" name="hero" value="1">
                        <label for="hero_1" id="img_hero_1">
                    </div>
                </div>
                <!-- Single Counter -->
                <div class="col-md-4 col-sm-12 work-counter-widget text-center wow animated fadeInUp"
                     data-wow-delay=".3s">
                    <div class="counter">
                        <input id="hero_2" type="radio" name="hero" value="2">
                        <label for="hero_2" id="img_hero_2">
                    </div>
                </div>
                <!-- Single Counter -->
                <div class="col-md-4 col-sm-12 work-counter-widget text-center wow animated fadeInUp"
                     data-wow-delay=".4s">
                    <div class="counter">
                        <input id="hero_3" type="radio" name="hero" value="3">
                        <label for="hero_3" id="img_hero_3">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="choose-section section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title -->
                <div class="col-md-12 wow animated fadeInLeft" data-wow-delay=".2s">
                    <h1 class="section-title">Что будем прокачивать?</h1>
                </div>
            </div>
            <div class="row">
                <!-- Single Counter -->
                <div class="col-md-3 col-sm-6 work-counter-widget text-center wow animated fadeInUp"
                     data-wow-delay=".2s">
                    <div class="counter">
                        <input id="skill_1" type="checkbox" name="skill_1" value="true">
                        <label for="skill_1" id="img_skill_1">
                    </div>
                </div>
                <!-- Single Counter -->
                <div class="col-md-3 col-sm-6 work-counter-widget text-center wow animated fadeInUp"
                     data-wow-delay=".3s">
                    <div class="counter">
                        <input id="skill_2" type="checkbox" name="skill_2" value="true">
                        <label for="skill_2" id="img_skill_2">
                    </div>
                </div>
                <!-- Single Counter -->
                <div class="col-md-3 col-sm-6 work-counter-widget text-center wow animated fadeInUp"
                     data-wow-delay=".4s">
                    <div class="counter">
                        <input id="skill_3" type="checkbox" name="skill_3" value="true">
                        <label for="skill_3" id="img_skill_3">
                    </div>
                </div>
                <!-- Single Counter -->
                <div class="col-md-3 col-sm-6 work-counter-widget text-center wow animated fadeInUp"
                     data-wow-delay=".5s">
                    <div class="counter">
                        <input id="skill_4" type="checkbox" name="skill_4" value="true">
                        <label for="skill_4" id="img_skill_4">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="hidden" name="setup" value="true" class="form-submit mt-5 hidden">
                    <button class="btn btn-common" type="submit" id="setup"><i class="material-icons mdi mdi-content-save"></i> Сохранить
                    </button>
                </div>
            </div>
        </div>
    </section>
</form>
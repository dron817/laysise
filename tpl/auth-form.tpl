<!-- Call to action Section -->
<section class="call-to-action-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-8 col-lg-8 col-xs-12 text-left wow animated fadeInLeft" data-wow-delay=".2s">
                <h1></h1><br>
                <h1>LaySise</h1>
                <h3>Ещё не зарегистрированы?</h3>
            </div>
            <div class="col-md-4 col-lg-4 col-xs-12 mt-4 text-right wow animated fadeInRight" data-wow-delay=".3s"><br>
                <a href="index.php#reg" rel="nofollow" class="animated4 btn btn-common"><i
                            class="material-icons mdi mdi-account-plus"></i> Присоедениться сейчас</a>
            </div>
        </div>
    </div>
</section>
<!-- Call to action Section End -->
<!-- LogIn Section -->
<section id="login" class="Material-contact-section section-padding section-dark">
    <div class="container">
        <div class="row">
            <!-- Section Titile -->
            <div class="col-md-3"></div>
            <div class="col-md-6 wow animated fadeInLeft" data-wow-delay=".2s">
                <h1 class="section-title">Авторизация</h1>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <!-- contact form -->
            <div class="col-md-3"></div>
            <div class="col-md-6 wow animated fadeInRight" data-wow-delay=".2s">
                <form action="index.php" class="shake" role="form" method="post" id="auth" name="contact-form"
                      data-toggle="validator">
                    <!-- Name -->
                    <div class="form-group label-floating">
                        <label class="control-label" for="name">Ник</label>
                        <input class="form-control" id="nick" type="text" name="nick" required
                               data-error="Пожалуйста, введите ваш ник">
                        <div class="help-block with-errors"></div>
                    </div>
                    <!-- password -->
                    <div class="form-group label-floating">
                        <label class="control-label" for="password">Пароль</label>
                        <input class="form-control" minlength="6" id="password" type="password" name="password" required
                               data-error="Пожалуйста, введите ваш пароль">
                        <div class="help-block with-errors"></div>
                    </div>
                    <input type="hidden" name="auth" value="true" class="form-submit mt-5 hidden">
                    <!-- Form Submit -->
                    <div class="form-submit mt-5">
                        <button class="btn btn-common" type="submit" id="auth"><i
                                    class="material-icons mdi mdi-arrow-right-bold"></i> Войти
                        </button>
                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<!-- SignUp Section End -->
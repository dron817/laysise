<!-- SignUp Section -->
<section id="reg" class="Material-contact-section section-padding section-dark">
    <div class="container">
        <div class="row">
            <!-- Section Title -->
            <div class="col-md-12 wow animated fadeInLeft" data-wow-delay=".2s">
                <h1 class="section-title">Присоеденяйтесь</h1>
            </div>
        </div>
        <div class="row">
            <!-- Section Title -->
            <div class="col-md-6 mt-3 contact-widget-section2 wow animated fadeInLeft" data-wow-delay=".2s">
                <p>После регистрации вы получите доступ к вашему персональному плану.</p>
                <p>Уже есть аккаунт? <a href="?route=lk">Войти</a></p>
            </div>
            <!-- contact form -->
            <div class="col-md-6 wow animated fadeInRight" data-wow-delay=".2s">
                <form action="index.php" class="shake" role="form" method="post" id="reg" name="contact-form"
                      data-toggle="validator">
                    <!-- Name -->
                    <div class="form-group label-floating">
                        <label class="control-label" for="nick">Ник</label>
                        <input class="form-control" id="nick" type="text" name="nick" required
                               data-error="Пожалуйста, введите ваш ник">
                        <div class="help-block with-errors"></div>
                    </div>
                    <!-- email -->
                    <div class="form-group label-floating">
                        <label class="control-label" for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" required
                               data-error="Пожалуйста, введите Email">
                        <div class="help-block with-errors"></div>
                    </div>
                    <!-- date -->
                    <div class="form-group label-floating">
                        <label class="control-label" for="birthday">День рождения</label>
                        <input onfocus="(this.type='date')" class="form-control" id="birthday" type="text"
                               name="birthday" required data-error="Пожалуйста, введите день рождения">
                        <div class="help-block with-errors"></div>
                    </div>
                    <!-- password -->
                    <div class="form-group label-floating">
                        <label class="control-label" for="password">Пароль</label>
                        <input class="form-control" minlength="6" id="password" type="password" name="password" required
                               data-error="Минимальная длина 6 символов">
                        <div class="help-block with-errors"></div>
                    </div>
                    <input type="hidden" name="reg" value="true" class="form-submit mt-5 hidden">
                    <!-- Form Submit -->
                    <div class="form-submit mt-5">
                        <button class="btn btn-common" type="submit" id="reg"><i
                                    class="material-icons mdi mdi-account-plus"></i> Присоединиться
                        </button>
                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- SignUp Section End -->
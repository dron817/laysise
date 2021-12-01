<!-- SignUp Section -->
<section id="reg" class="Material-contact-section section-padding section-dark">
    <div class="container">
        <div class="row">
            <!-- Section Title -->
            <div class="col-md-12 wow animated fadeInLeft" data-wow-delay=".2s">
                <h1 class="section-title">Добро пожаловать</h1>
            </div>
        </div>
        <div class="row">
            <!-- Section Title -->
            <div class="col-md-6 mt-3 contact-widget-section2 wow animated fadeInLeft" data-wow-delay=".2s">
                <p>Данная страница предназначена для жеребьёвки <b>Тайного Санты</b></p>
                <p>Заполняя данную форму вы подтверждаете своё участие в данном мероприятии и <b>не можете отказаться</b> от него впоследствии</p>
                <p>Вы обязаны хранить имя выпавшего вам человека <b>в тайне</b> навсегда, даже после раздачи подарков</p>
                <p>Если у человека, выпавшего вам есть пожелание, вы <b>не обязаны</b> его выполнять</p>
                <p>Ориентировочная стоимость подарка: <b>300 рублей</b>. Не рекомендуется сильно отходить от этой суммы ни в меньшую, ни в большую сторону</p>
            </div>
            <!-- contact form -->
            <div class="col-md-6 wow animated fadeInRight" data-wow-delay=".2s">
                <form action="index.php" class="shake" role="form" method="post" id="newyear" name="contact-form"
                      data-toggle="validator">
                    <!-- fio -->
                    <div class="form-group label-floating">
                        <label class="control-label" for="fio">Имя и фамилия</label>
                        <input class="form-control" id="fio" type="text" name="fio" required
                               data-error="Пожалуйста, введите ваше имя">
                        <div class="help-block with-errors"></div>
                    </div>
                    <!-- please -->
                    <div class="form-group label-floating">
                        <label class="control-label" for="please">Пожелание дарящему вам (необязательно)</label>
                        <input class="form-control" id="please" type="text" name="please"
                               data-error="Пожалуйста, введите ваше пожелание">
                        <div class="help-block with-errors"></div>
                    </div>
                    <label class="task">
                        <input type="checkbox" name="rules" value="1">
                        <span>Я прочитал правила участия и согласен с ними</pre></span>
                    </label>
                    <input type="hidden" name="newyear" value="true" class="form-submit mt-5 hidden">
                    <!-- Form Submit -->
                    <div class="form-submit mt-5">
                        <button class="btn btn-common" type="submit" id="newyear"><i
                                class="material-icons mdi mdi-account-plus"></i> Учавствовать
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
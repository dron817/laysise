<div class="container">
    <div class="row">
        <div class="col-12 wow animated fadeInLeft" data-wow-delay=".2s">
            <h1 class="section-title">Добро пожаловать, %nick%!</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12 wow animated fadeInUp" data-wow-delay=".3s">
            <div class="set-size charts-container">
                <div class="pie-wrapper progress-%percent% style-1">
                    <span class="label"><img src="/img/hero_%hero_id%.gif" alt=""></span></span>
                    <div class="pie">
                        <div class="left-side half-circle"></div>
                        <div class="right-side half-circle"></div>
                    </div>
                    <div class="shadow"></div>
                </div>
            </div>
            <p>Ваш уровень: <b>%lvl%</b></p>
            <a href="%logout_link%">Выйти</a>
        </div>
        <div class="col-md-8 col-sm-12 text-center wow animated fadeInUp" data-wow-delay=".4s">
            <form action="index.php" class="shake" role="form" method="post" id="saveTasks" name="saveTasks">
                <h2>Твои задания на сегодня</h2>
                %tasks%
                <input type="hidden" name="saveTasks" value="true" class="form-submit mt-5 hidden">
                <!-- Form Submit -->
                <button class="btn btn-common" type="submit" id="setup"><i class="material-icons mdi mdi-content-save"></i> Сохранить
                </button>
            </form>
        </div>
    </div>
</div>
</div>
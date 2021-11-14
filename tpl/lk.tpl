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
                <button class="btn btn-common" type="submit" id="setup"><i class="material-icons mdi mdi-content-save"></i> Сохранить
                </button>
            </form>

            <div class="mt-5 panel-group Material-default-accordion Material-accordion-2" id="Material-accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default mb-3">
                    <div class="panel-heading" role="tab" id="headingOne2">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#Material-accordion2" href="#collapseOne2" aria-expanded="false" aria-controls="collapseOne2" class="collapsed">
                                <i class="mdi mdi-plus"></i>
                                Добавить задачу
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne2" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne2" style="">
                        <div class="panel-body">
                            <form action="index.php" class="shake" role="form" method="post" id="addTask" name="addTask">
                                <div class="form-group label-floating is-empty has-error">
                                    <label class="control-label" for="newTask">Описание</label>
                                    <input class="form-control" id="newTask" type="text" name="newTask" required="" data-error="Запланируйте дело">
                                    <div class="help-block with-errors"><ul class="list-unstyled"><li>Запланируйте дело</li></ul></div>
                                </div>
                                <input type="hidden" name="addTask" value="true" class="form-submit mt-5 hidden">
                                <button class="btn btn-common" type="submit" id="setup"><i class="material-icons mdi mdi-plus"></i> Добавить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //Подключаемся к БД
    require "./includes/db.php";
?>
<?php // Инициализация страницы
	$GLOBALS['title'] = 'Панель администратора';

    include("header.php");
?>
<?php // Инициализация логина
    $data = $_POST;
   
    echo "<body>";
    
    if (isset($data['do_login'])) 
    {
        // Массив для ошибок
        $errors = array();
        // Пытаемся найти пользователя по логину
        $user = R::findOne('users', 'login = ?', array($data['login']));
        R::close();
        // Проверяем пользователя
        if ($user) 
        {
            // Нашил. Проверяем пароль
            if (password_verify($data['password'], $user->password))
            {
                // Пароль совпал. Запускаем сессию
                $_SESSION['logged_user'] = $user;
            } else 
            {
                $errors[] = "Неверно введен пароль!";
            } 
        } else 
        {
            $errors[] = "Пользователь с таким логином не найден!";
        }
        // Проверка ошибок
        if (!empty($errors)) 
        {
            // все хорошо, вывели на экран пользователя
            echo '
                <!-- Информационная полоса -->
                    <div class="alert alert-danger information-line" role="alert">'
                        .array_shift($errors).
                    '</div>
                <!-- Конец Информационная полоса -->
            ';
        }
    }
    // Сам сайт:
    if (isset($_SESSION['logged_user'])) : ?>
            <!-- Панель администратора-->
                <!-- Уведомление -->
                    <script>
                        sendNotification('Уведомление!', {
                            body: 'Вы успешно авторизировались!',
                            icon: 'favicon.ico',
                            dir: 'auto'
                        });
                    </script> 
                <!-- Конец уведомление -->
                
                <!-- Сведения о пользователе -->
                    <div class="card" style="width: 18rem; margin-left: 70px;">
                        <div class="card-header">
                            Профиль
                        </div>
                        <ul class="list-group list-group-flush">
                            <?$user = R::findOne('users', 'login = ?', array($_SESSION['logged_user']->login));?>
                            <li class="list-group-item">Логин: <? echo $user->login ?></li>
                            <li class="list-group-item">Email: <? echo $user->email ?></li>
                            <li class="list-group-item text-center">
                                <a href="./logout.php"><button class="btn btn-default">Выйти</button></a>
                            </li>
                        </ul>
                    </div>
                <!-- Конец сведения о пользователе -->

                <?php 
                    $data_from_db[] = R::findAll( 'lang' );
                    R::close();
                    //var_dump($data_from_db[0][1]['word']);
                ?>
                <div class="row">
                    <?php // word ?>
                    <div class="col-3 scrollbar scrollbar-primary">
                        <div class="list-group force-overflow" id="list-tab" role="tablist">
                        <?php
                            $i = 1;
                            echo '<a class="list-group-item list-group-item-action active" id="list-element'.$i.'-list" data-toggle="list" href="#list-element'.$i.'" role="tab" aria-controls="element'.$i.'">'
                                .$data_from_db[0][$i]['word'].
                            '</a>';
                            for (++$i; $i <= count($data_from_db[0]); ++$i) 
                            {
                                echo '<a class="list-group-item list-group-item-action" id="list-element'.$i.'-list" data-toggle="list" href="#list-element'.$i.'" role="tab" aria-controls="element'.$i.'">'
                                    .$data_from_db[0][$i]['word'].    
                                '</a>';
                            }
                            unset($i);
                        ?>
                        </div>
                    </div>
                    <?php // ru ?>
                    <div class="col-4 russian">
                        <div class="text-center">
                            <span class="input-group-text" style="margin-top: 20px;">RU</span>
                        </div>
                        <div id="summernote_ru" name="editordata"><? echo $data_from_db[0][1]['ru']; ?></div>
                        <script>
                            $('#summernote_ru').summernote({
                                height: 460,   
                                minHeight: null, 
                                maxHeight: null,  
                                focus: true 
                            });
                        </script>
                    </div>
                    <?php // en ?>
                    <div class="col-4 english">
                        <div class="text-center">
                            <span class="input-group-text" style="margin-top: 20px;">EN</span>
                        </div>
                        <div id="summernote_en" name="editordata"><? echo $data_from_db[0][1]['en']; ?></div>
                        <script>
                            $('#summernote_en').summernote({
                                placeholder: '',
                                height: 460,   
                                minHeight: null, 
                                maxHeight: null,  
                                focus: true 
                            });
                        </script>
                    </div>
                </div>

                <button type="submit" class="btnSave btn btn-default col-12" style="margin-top: 20px;">Сохранить</button>

                <script src="./js/admin.js"></script>

        <?php else : ?>
            <!-- Картточка логина -->
            <div class="card bg-light" style="max-width: 32rem; width: 32rem; height: 28rem; position: absolute;  top: 20%; right: 0; bottom: 0; left: 35%;">
                <div class="card-header text-center">
                    Панель администратора
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Авторизация</h5>
                    <div class="form">
                        <form class="form-horizontal" role="form" method="POST" action="admin.php">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="inputLogin" class="col-sm-6 control-label">Логин</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" placeholder="Логин" name="login">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-sm-6 control-label">Пароль</label>
                                    <div class="col-sm-12">
                                        <input type="password" class="form-control" placeholder="Пароль" name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-6 col-sm-12">
                                        <button type="submit" name="do_login" class="btn btn-default col-12">Войти</button>
                                    </div>
                                </div>  
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </body>
</html>
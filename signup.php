<?php
    require "./includes/db.php";

    $data = $_POST;
    if ( isset($data['do_signup']) )
    {
        // Здесь регистрация

        $errors = array();
        if (trim($data['login']) == '')
        {
            $errors[] = 'Введите логин!';
        } else if (trim($data['email']) == '')
        {
            $errors[] = 'Введите Email!';
        } else if (trim($data['password']) == '')
        {
            $errors[] = 'Введите пароль!';
        } else if (trim($data['password_2']) == '')
        {
            $errors[] = 'Введите проверочный пароль!';
        }
        
        if (R::count('users', "login = ?", array($data['login'])) > 0)
        {
            $errors[] = 'Пользователь с таким логином уже существует!';
        } else if (R::count('users', "email = ?", array($data['email'])) > 0)
        {
            $errors[] = 'Пользователь с таким Email уже существует!';
        }

        if (empty($errors)) 
        {
            // все хорошо, регистрируем
            $user = R::dispense('users');
            $user->login = $data['login'];
            $user->email = $data['email'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            $id = R::store($user);
            echo '<div style="color: green;">Вы успешно зарегистрированы!</div><hr>';
        } else 
        {
            echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
        }
    }
    R::close();
?>

<form action="/signup.php" method="POST">

    <p>
        <p><strong>Логин</strong>:</p>
        <input type="text" name="login" value="<?php echo @$data['login']; ?>">
    </p>

    <p>
        <p><strong>E-mail</strong>:</p>
        <input type="e-mail" name="email" value="<?php echo @$data['email']; ?>">
    </p>

    <p>
        <p><strong>Пароль</strong>:</p>
        <input type="password" name="password" value="<?php echo @$data['password']; ?>">
    </p>

    <p>
        <p><strong>Пароль еще раз</strong>:</p>
        <input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
    </p>

    <p>
        <button type="submit" name="do_signup">Зарегистрироваться</button>
    </p>

</form>
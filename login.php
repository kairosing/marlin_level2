<?php
require_once 'includes/init.php';

if (Input::exists()){
    if (Token::check(Input::get('token'))){
        $validate = new Validate();

        $validate->check($_POST,[
            'email' => ['required' => true, 'email' => true],
            'password' => ['required' => true]
        ]);
        if ($validate->passed()){

            $user = new User;
            $remember = (Input::get('remember')) === 'on' ? true : false;
            $login = $user->login(Input::get('email'), Input::get('password'));

            if ($login){
                Redirect::to("index.php");
                //var_dump(Redirect::to("index.php"));die();
            } else{
                echo 'login failed';
            }
        } else {
            foreach ($validate->errors() as $error){
                echo $error . '<br>';
            }
        }
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="post" action="">
    	  <img class="mb-4" src="images/apple-touch-icon.png" alt="" width="72" height="72">
    	  <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>

<!--        Ошибка валидации 1-->
        <?php if (Session::flashExists('danger')):?>
        <div class="alert alert-danger">
            <?php Session::flash('danger')?>
          <ul>
             <?php foreach ($validate->errors() as $error):?>
            <li>
                <?php echo $error;?>
            </li>
              <?php endforeach;?>
          </ul>
        </div>
        <?php endif;?>

        <div class="alert alert-info">
          Логин или пароль неверны
        </div>

    	  <div class="form-group">
          <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo Input::get('email')?>">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
        </div>

    	  <div class="checkbox mb-3">
    	    <label>
    	      <input type="checkbox" name="remember"> Запомнить меня
    	    </label>
              <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    	  </div>
    	  <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    	  <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
    </form>
</body>
</html>

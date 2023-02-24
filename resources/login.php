<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=BASE_URL;?>/assets/css/style-login.css">
    <title>Danki Code Financeiro</title>
</head>
<body>
    <div class="container">
        <div class="box-login">
            <h2>DankiCode Financeiro</h2>
            <form action="<?=BASE_URL?>/entrar" method="post">
                <div class="group">
                    <label for="login">Login</label>
                    <input type="text" name="login" id="login">
                </div>
                <div class="group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha">
                </div>
                <div class="group">
                    <button type="submit" class="btn btn-success">Entrar</button>
                </div> 
                <?php if (!empty($msg)): ?>
                    <div class="group">
                        <div class="alert alert-danger"><?=$msg?></div>
                    </div>  
                <?php endif;?>
            </form>
        </div>
    </div>
</body>
</html>
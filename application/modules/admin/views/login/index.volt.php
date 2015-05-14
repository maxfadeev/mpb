<!DOCTYPE html>
<html>
    <head>
        
        <link href="http://cdn.everything.io/kickstart/3.x/css/kickstart.min.css" rel="stylesheet" />
        <link href="/public/css/main.css" rel="stylesheet" />
        
        <title>Admin - Blog</title>
    </head>
    <body>
        <div id="header">
            <?php if ($this->auth->getIdentity()) { ?>
            <a href="<?php echo $this->url->get('/logout'); ?>">Logout</a>
            <?php } ?>
        </div>
        <div id="content">
            
    <?php echo $this->getContent(); ?>
    <div id="login-block">
        <form method="post">
            <?php echo $form->render('login'); ?>
            <?php echo $form->render('password'); ?>
            <?php echo $form->render('submit'); ?>
        </form>
    </div>

        </div>

        <div id="footer">
            
            
        </div>
        <script type='text/javascript' src='http://cdn.everything.io/kickstart/3.x/js/kickstart.min.js'></script>
    </body>
</html>
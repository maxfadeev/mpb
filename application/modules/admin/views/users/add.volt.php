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
    <form method="post">
        
        <?php echo $form->messages('login'); ?>
        <?php echo $form->label('login'); ?>
        <?php echo $form->render('login'); ?>
        
        <?php echo $form->messages('email'); ?>
        <?php echo $form->label('email'); ?>
        <?php echo $form->render('email'); ?>
        
        <?php echo $form->messages('password'); ?>
        <?php echo $form->label('password'); ?>
        <?php echo $form->render('password'); ?>
        <?php echo $form->render('confirmPassword'); ?>
        
        <?php echo $form->label('role'); ?>
        <?php echo $form->render('role'); ?>

        
        <?php echo $form->messages('csrf'); ?>
        <?php echo $form->render('csrf', array('name' => $this->security->getTokenKey(), 'value' => $this->security->getToken())); ?>

        <?php echo $form->render('submit'); ?>
    </form>

        </div>

        <div id="footer">
            
            
        </div>
        <script type='text/javascript' src='http://cdn.everything.io/kickstart/3.x/js/kickstart.min.js'></script>
    </body>
</html>
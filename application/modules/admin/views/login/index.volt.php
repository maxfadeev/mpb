<!DOCTYPE html>
<html>
    <head>
        
        
        <title>Admin - Blog</title>
    </head>
    <body>
        <div id="content">
            
    <?php echo $this->getContent(); ?>
    <form method="post">
        <?php echo $form->render('login'); ?>
        <?php echo $form->render('password'); ?>
        <?php echo $form->render('submit'); ?>
    </form>

        </div>

        <div id="footer">
            
        </div>
    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        
            <link href="/public/css/main.css" rel="stylesheet" media="all" />
        
        <title>Admin - Blog</title>
    </head>
    <body>
        <div id="header">
            <a href="<?php echo $this->url->get('a/logout'); ?>">Logout</a>
        </div>
        <div id="content">
            
    <?php echo $this->getContent(); ?>
    <?php foreach ($users as $user) { ?>
        <p><?php echo $user->login; ?></p>
    <?php } ?>

        </div>

        <div id="footer">
            
        </div>
    </body>
</html>
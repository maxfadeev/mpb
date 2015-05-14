<!DOCTYPE html>
<html>
    <head>
        
            <link href="http://cdn.everything.io/kickstart/3.x/css/kickstart.min.css" rel="stylesheet" />
            <link href="/public/css/main.css" rel="stylesheet" />
        
        <title>Admin - Blog</title>
    </head>
    <body>
        <div id="header">
            <a href="<?php echo $this->url->get('/logout'); ?>">Logout</a>
        </div>
        <div id="content">
            
    <?php echo $this->getContent(); ?>
    <?php foreach ($users as $user) { ?>
        <p><?php echo $user->login; ?><a href="<?php echo $this->url->get('/users/delete/id'); ?>/<?php echo $user->id; ?>/<?php echo $token; ?>">delete</a></p>
    <?php } ?>

        </div>

        <div id="footer">
            
        </div>
        <script type='text/javascript' src='http://cdn.everything.io/kickstart/3.x/js/kickstart.min.js'></script>
    </body>
</html>
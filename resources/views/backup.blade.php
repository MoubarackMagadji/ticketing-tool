<?php
if(isset($_GET['error']) || isset($_COOKIE['lock'])){
    ?>
    <p class="error">
        <?php if(isset($_COOKIE['error'])) echo $_GET['error'];?>
        <span><?php if(isset($_COOKIE['error'])) echo '<br>You have '. (3 - (int)$_COOKIE['error']) .' attemps(s) left' ?></span>
        <?php

        if(isset($_COOKIE['lock'])){ ?>
            <br><span>Your attempts are exceded.</span>
        <br><br><span style='display: block'> You must wait for <span id='timeDisplay'><?php echo $_COOKIE['lock'] - time(); ?> </span>s</span>
        <span style='display:none' id='timesample'><?php echo $_COOKIE['lock'] - time(); ?></span>
        <?php
        }else if(isset($_COOKIE['inactive'])){ ?>
            <span>Your account is not active, contact the admin.</span>
        <?php }
        ?>
        
        </p>

            <?php
    }
    else{
    ?>
        <p class="message">
            Enter your credentials. You have only <strong><em>03 attemps</em></strong>.
        </p>
    <?php
    }
          
    
?>

<?php if(isset($_COOKIE['lock'])) echo 'disabled' ?>

<?php if(isset($_COOKIE['lock'])) echo 'disabled' ?>
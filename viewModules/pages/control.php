<?php 
if(isLogged()) {
    switch(getUserPermissions()) {
        case 0:
            $control = ('./viewModules/pages/control_client.php');
            break;
    
        case 1:
            $control = ('./viewModules/pages/control_worker.php');
            break;
        
        case 2:
            $control = ('./viewModules/pages/control_admin.php');
            break;
    }
} else header('Location: index.php?site=home');
?>


<div class='background'>
    <?php include($control); ?>
</div>
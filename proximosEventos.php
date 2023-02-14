<!DOCTYPE html>
<html lang="en">
  
<?php 
require_once('./includes/head.php');
$active = 'proximosEventos';
?>

  <body>
    <script src="./assets/js/initTheme.js"></script>
    <div id="app">

        <?php require_once('./includes/sidebar.php') ?>

      <div id="main">
        <header class="mb-3">
          <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
          </a>
        </header>

        <div class="page-header">
          <h3>Proximos Eventos</h3>
        </div>
        
        <div class="page-content">
            
        </div>
        
        <?php require_once('./includes/footer.php') ?>

      </div>
    </div>

    <?php require_once('./includes/footerScriptsJs.php') ?>
    
  </body>
</html>

<?php
  include_once 'user.php';
?>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/22.png" alt="">Admin. <?php echo "$nombre";?><!--Imagen y nombre que aparecen en la esquina superior derecha de la página-->
                    <span class="fas fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right"> <!--Lista desplegable de opciones que aparece al dar click en el nombre de usuario que se encuentra en la esquina superior derecha de la página -->
                   
                    <li><a href="login.php?token=salir"><i class="fas fa-sign-out-alt pull-right"></i> Salir</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
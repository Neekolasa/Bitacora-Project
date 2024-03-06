<?php 
  include_once 'user.php';
?>
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-book-reader"></i> <span>Bitácora Digital</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_info">
                <span>Bienvenido</span>
                <h2>Administrador <?php echo "$nombre"; ?></h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="inicio.php"><i class="fas fa-home"></i> Inicio <span ></span></a>
                  </li>
                  <li><a><i class="fas fa-book"></i> Bitácora <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="admin"><a href="agregar_bitacora.php"><i class="fas fa-plus-square sss"></i> Nuevo</a></li>
                      <li><a href="bitacora.php"><i class="fas fa-list-ul sss"></i> Administrar</a></li>       
                    </ul>
                  </li>
                  <li><a><i class="fas fa-file-alt"></i> Formatos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="carta_cond.php"><i class="far fa-file sss"></i>Carta de Condicionamiento</a></li>
                      <li><a href="carta_comp.php"><i class="far fa-file sss"></i>Carta de Compromiso</a></li>
                      <li><a href="citatorio.php"><i class="far fa-file sss"></i>Citatorio</a></li>
                      <li><a href="justificante.php"><i class="far fa-file sss"></i>Justificante</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-address-card"></i> Alumnos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="admin"><a href="registrar_alumno.php"><i class="fas fa-plus-square sss"></i> Nuevo</a></li>
                      <li><a href="alumnos.php"><i class="fas fa-list-ul sss"></i> Administrar</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fas fa-user"></i></i> Docentes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="admin"><a href="agregar_docente.php"><i class="fas fa-plus-square sss"></i> Nuevo</a></li>
                      <li><a href="ver_docentes.php"><i class="fas fa-list-ul sss"></i> Administrar</a></li>
                    </ul>
                  </li>

                  <li class="admin"><a><i class="fas fa-user-cog"></i></i> Administradores <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="admins.php"><i class="fas fa-plus-square sss"></i> Nuevo</a></li>
                      <li><a href="veradmins.php"><i class="fas fa-list-ul sss"></i> Administrar</a></li>
                      <li><a href="ajustes.php"><i class="fas fa-cog sss"></i> Ajustes</a></li>
                     
                    </ul>
                  </li>
                  <li><a href="login.php?token=salir"><i class="fas fa-power-off"></i> Cerrar sesión <span ></span></a>
                  </li>
                  
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>


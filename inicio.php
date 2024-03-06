<?php 
	session_start();
	if (!isset($_SESSION['usuario']))
	{
		echo "<script>window.location.replace('login.php')</script>";
	}
	else
	{
		$privilegio=$_SESSION['privilegio'];

	}

  	require_once 'cont/conexion.php';

	$query = "SELECT COUNT(*) FROM alumno";
	$ex = mysqli_query($conexion, $query);
	$a = mysqli_fetch_array($ex);

	$total_alumno = $a['COUNT(*)'];

	$query = "SELECT COUNT(*) FROM docentes";
	$ex = mysqli_query($conexion, $query);
	$a = mysqli_fetch_array($ex);

	$total_docente = $a['COUNT(*)'];

	$query = "SELECT (SELECT COUNT(*) FROM formato_carta_comp)+
	          (SELECT COUNT(*) FROM formato_carta_cond)+
	          (SELECT COUNT(*) FROM formato_citatorio)+
	          (SELECT COUNT(*) FROM formato_justificante) 
	          AS suma";

	$ex = mysqli_query($conexion, $query);
	$a = mysqli_fetch_array($ex);

	$total_docs = $a['suma'];

	$query = "SELECT COUNT(*) FROM bitacora";
	$ex = mysqli_query($conexion, $query);
	$a = mysqli_fetch_array($ex);

	$total_bitacora = $a['COUNT(*)'];
?>
<!DOCTYPE html>
<html lang="es">
<?php
    include_once 'templates/head.php';
?>
 <title>Administración | Inicio</title> <!-- AQUÍ SE CAMBIA EL TITULO QUE APARECE EN LA PESTAÑA DEL NAVEGADOR -->
  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
<?php
    include_once 'templates/barra.php';

    include_once 'templates/navegacion.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"> <!-- Barra de busqueda dentro de la sección principal de la página-->
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Inicio</h2>
                    <div class="clearfix"></div>
                    <nav aria-label="breadcrumb" id="bread">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="#">Inicio</a></li>
                      </ol>
                    </nav>
                  </div>
                  <div class="x_content">
  	                    <div class="row top_tiles">
	                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	                        <div class="tile-stats">
	                          <div style="margin-right: 15px;" class="icon"><i class="fa fa-users"></i></div>
	                          <div class="count"><?php echo $total_alumno; ?></div>
	                          <h3>Total de alumnos</h3>
	                          <p>Guardados en el sistema</p>
	                        </div>
	                      </div>

	                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	                        <div class="tile-stats">
	                          <div style="margin-right: 15px;" class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
	                          <div class="count"><?php echo $total_docente; ?></div>
	                          <h3>Total de docentes</h3>
	                          <p>Guardados en el sistema</p>
	                        </div>
	                      </div>

	                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	                        <div class="tile-stats">
	                          <div class="icon"><i class="fas fa-file-alt"></i></div>
	                          <div class="count"><?php echo $total_docs; ?></div>
	                          <h3>Total de formatos </h3>
	                          <p>Generados por el sistema</p>
	                        </div>
	                      </div>
	                      
	                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	                        <div class="tile-stats">
	                          <div class="icon"><i class="fas fa-book"></i></div>
	                          <div class="count"><?php echo $total_bitacora; ?></div>
	                          <h3>Total de registros</h3>
	                          <p>Guardados en la bitacora</p>
	                        </div>
	                      </div>
	                    </div>

	                    <div class="col-md-5 col-sm-6 col-xs-12">
	                      <div class="x_panel">
	                        <div class="x_title">
	                          <h2>Formatos generados</h2>
	                          <div class="clearfix"></div>
	                        </div>
	                        <div class="x_content">
	                        <div id="container" style="height: 450% !important; margin-right: 50px;"></div>
	                        </div>
	                      </div>
	                    </div>

	                    <div class="col-md-7 col-sm-6 col-xs-12">
	                      <div class="x_panel">
	                        <div class="x_title">
	                          <h2>Alumnos más frecuentes</h2>
	                          <div class="clearfix"></div>
	                        </div>
	                        <div class="x_content">
	                        <div id="container2" style="height: 450% !important;"></div>
	                        </div>
	                      </div>
	                    </div>

                      <div class="col-md-12 col-sm-6 col-xs-12 admin">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Funcionamiento del sistema</h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <div class="video-container">
                              <iframe width="853" height="480" src="https://www.youtube.com/embed/6sAZN8XllgI" frameborder="0" allowfullscreen></iframe>
                              </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-6 col-xs-12 admin">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Editar Formatos</h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <div class="video-container">
                              <iframe width="853" height="480" src="https://www.youtube.com/embed/v_qnmk2Sbz8" frameborder="0" allowfullscreen></iframe>
                              </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-6 col-xs-12 admin">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Cambiar conexión a la base de datos</h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <div class="video-container">
                              <iframe width="853" height="480" src="https://www.youtube.com/embed/bQQH8xN6ySo" frameborder="0" allowfullscreen></iframe>
                              </div>
                          </div>
                        </div>
                      </div>
                      
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php  
    include_once 'templates/footer.php';
?>
  </body>
</html>
<?php
  $query = "SELECT COUNT(*) FROM formato_carta_cond";
  $ex = mysqli_query($conexion, $query);
  $a = mysqli_fetch_array($ex);

  $carta_cond = $a['COUNT(*)'];

  $query = "SELECT COUNT(*) FROM formato_carta_comp";
  $ex = mysqli_query($conexion, $query);
  $a = mysqli_fetch_array($ex);

  $carta_comp = $a['COUNT(*)'];

  $query = "SELECT COUNT(*) FROM formato_citatorio";
  $ex = mysqli_query($conexion, $query);
  $a = mysqli_fetch_array($ex);

  $citatorio = $a['COUNT(*)'];

  $query = "SELECT COUNT(*) FROM formato_justificante";
  $ex = mysqli_query($conexion, $query);
  $a = mysqli_fetch_array($ex);

  $justificante = $a['COUNT(*)'];

?>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
<script type="text/javascript">
  var dom = document.getElementById("container");
  var myChart = echarts.init(dom);
  var app = {};
  option = null;
  var data = genData(50);

  option = {
      tooltip : {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
      },
      legend: {
          type: 'scroll',
          orient: 'vertical',
          right: 10,
          top: 20,
          bottom: 20,
          data: data.legendData,

          selected: data.selected
      },
      series : [
          {
              name: 'Formatos',
              type: 'pie',
              radius : '55%',
              center: ['50%', '50%'],
              data: data.seriesData,
              itemStyle: {
                  emphasis: {
                      shadowBlur: 10,
                      shadowOffsetX: 0,
                      shadowColor: 'rgba(0, 0, 0, 0.5)'
                  }
              }
          }
      ]
  };

  function genData(count) {

      var legendData = [];
      var seriesData = [{'name': 'Carta de condicionamiento', 'value': <?php echo $carta_cond?>}, {'name': 'Carta de compromiso', 'value': <?php echo $carta_comp?>}, {'name': 'Citatorio', 'value': <?php echo $citatorio?>}, {'name': 'Justificante', 'value': <?php echo $justificante?>}];
      var selected = {};

      return {
        legendData: legendData,
        seriesData: seriesData,
        selected: selected
      };

      return {
        legendData: legendData,
        seriesData: seriesData,
        selected: selected
      };

      function makeWord(max, min) {
          var nameLen = Math.ceil(Math.random() * max + min);
          var name = [];
          for (var i = 0; i < nameLen; i++) {
              name.push(nameList[Math.round(Math.random() * nameList.length - 1)]);
          }
          return name.join('');
      }
  }
  ;
  if (option && typeof option === "object") {
      myChart.setOption(option, true);
  }
</script>

<?php

  $nameArray = array();
  $countArray = array();

  $query = "SELECT COUNT(fk_alumno) as cuenta,
  CONCAT(alumno.nombre,' ',alumno.ape_paterno,' ',alumno.ape_materno) AS nombre 
  FROM bitacora 
  JOIN alumno 
  ON bitacora.fk_alumno = alumno.id_alumno 
  GROUP BY fk_alumno
  ORDER BY cuenta DESC 
  LIMIT 4";

  $ex = mysqli_query($conexion, $query);

  $i = 0;
  while($res = mysqli_fetch_array($ex)) {
    $countArray[$i] = $res['cuenta'];
    $nameArray[$i] = $res['nombre'];
    $i++;
  }

  $conexion->close();

?>
<script type="text/javascript">

    var dom = document.getElementById("container2");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    app.title = 'Bitacora';

    option = {
        color: ['#159d82'],
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                data : ['<?php echo $nameArray[0]."','".$nameArray[1]."','".$nameArray[2]."','".$nameArray[3];?>'],
                axisTick: {
                    alignWithLabel: true
                }
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'Visitas',
                type:'bar',
                barWidth: '25%',
                data:[<?php echo $countArray[0].", ".$countArray[1].", ".$countArray[2].", ".$countArray[3];?>]
            }
        ]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>

<script type="text/javascript">
  
  var privilegio='<?php echo $privilegio ?>';
  gestor_recursos(privilegio);

</script>

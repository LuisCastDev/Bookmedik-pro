<?php


  $dateB = new DateTime(date('Y-m-d')); 
  $dateA = $dateB->sub(DateInterval::createFromDateString('30 days'));
  $sd= strtotime(date_format($dateA,"Y-m-d"));
  $ed = strtotime(date("Y-m-d"));
  $ntot = 0;
  $nsells = 0;
  $sumatot = array();
for($i=$sd;$i<=$ed;$i+=(60*60*24)){
  $operations[$i] = ReservationData::getGroupByDate(date("Y-m-d",$i),date("Y-m-d",$i));


//    $sumatot[date("Y-m-d",$i)]=$sum;
}


?>
    <section class="content-header">
      <h1>
        BookMedik Pro
        <small>Version 4.0</small>
      </h1>
    </section>

<section class="content">

<!-- Button trigger modal -->



 <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Citas</span>
              <span class="info-box-number"><?php echo count(ReservationData::getAll());?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-male"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pacientes</span>
              <span class="info-box-number"><?php echo count(PacientData::getAll());?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-support"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Medicos</span>
              <span class="info-box-number"><?php echo count(MedicData::getAll());?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-th-list"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Areas Medicas</span>
              <span class="info-box-number"><?php echo count(CategoryData::getAll());?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
      <!-- /.row -->

<div class="box box-primary">
<div class="box-header">
<div class="box-title">Citas totales de los ultimos 30 dias</div>
</div>
<div class="box-body">
<div id="graph" class="animate" data-animate="fadeInUp" ></div>
</div>
</div>

<script>

<?php 
echo "var c=0;";
echo "var dates=Array();";
echo "var data=Array();";
echo "var total=Array();";
for($i=$sd;$i<=$ed;$i+=(60*60*24)){
  echo "dates[c]=\"".date("Y-m-d",$i)."\";";
  echo "data[c]=".$operations[$i][0]->s.";";
  echo "total[c]={x: dates[c],y: data[c]};";
  echo "c++;";
}
?>
// Use Morris.Area instead of Morris.Line
Morris.Area({
  element: 'graph',
  data: total,
  xkey: 'x',
  ykeys: ['y',],
  labels: ['Y']
}).on('click', function(i, row){
  console.log(i, row);
});
</script>


</section>
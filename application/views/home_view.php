<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
          Kontrolna ploča
          <small>- <?php // TODO: fali opis ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> LogTrack</a></li>
          <li class="active">Kontrolna ploča</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

          <div class="col-md-3 col-sm-6 col-sx-12">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>#0</h3>
                <p>Ukupno artikala</p>
              </div>
              <div class="icon">
                <i class="ion ion-pricetags"></i>
              </div>
              <a href="#" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-sx-12">
            <div class="small-box bg-green">
              <div class="inner">
                <h3>#0</h3>
                <p>Dostupnih artikala</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="#" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-sx-12">
            <div class="small-box bg-red">
              <div class="inner">
                <h3>#1</h3>
                <p>Zaduženih artikala</p>
              </div>
              <div class="icon">
                <i class="ion ion-pricetag"></i>
              </div>
              <a href="#" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-sx-12">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>#2</h3>
                <p>Izdanih artikala</p>
              </div>
              <div class="icon">
                <i class="ion ion-close"></i>
              </div>
              <a href="#" class="small-box-footer">Više informacija <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-lg-7 connectedSortable ui-sortable">
            <div class="nav-tabs-custom" style="cursor: move;">
              <!-- Custom tabs (Charts with tabs)-->
                      <!-- /.nav-tabs-custom -->

                      <!-- Chat box -->
                      <div style="cursor: move;" class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-right ui-sortable-handle">
                          <li class=""><a aria-expanded="false" href="#typechart" data-toggle="tab">Donut</a></li>
                          <li class="active"><a aria-expanded="true" href="#borrowchart" data-toggle="tab">Area</a></li>
                          <li class="pull-left header"><i class="fa fa-inbox"></i> Uređaji</li>
                        </ul>
                        <div class="tab-content no-padding">
                          <div class="tab-pane active" id="borrowchart" style="position: relative; height: 300px;"></div>
                          <div class="tab-pane" id="typechart" style="position: relative; height: 300px;"></div>
                        </div>
            </div>
          </div>
          <div class="col-lg-5 connectedSortable ui-sortable">

          </div>
        </div>

    </section>

</div>

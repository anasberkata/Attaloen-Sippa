<?php
session_start();
include "../templates/header.php";
?>


<div class="page-wrapper">
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 d-flex no-block align-items-center">
        <h4 class="page-title">Dashboard</h4>
      </div>
    </div>
  </div>

  <div class="container-fluid">

    <div class="row">
      <!-- Column -->
      <div class="col-md-6 col-lg-3">
        <div class="card card-hover">
          <div class="box bg-cyan text-center">
            <h1 class="font-light text-white">
              <i class="mdi mdi-view-dashboard"></i>
            </h1>
            <h6 class="text-white">Dashboard</h6>
          </div>
        </div>
      </div>
      <!-- Column -->
      <div class="col-md-6 col-lg-3">
        <div class="card card-hover">
          <div class="box bg-success text-center">
            <h1 class="font-light text-white">
              <i class="mdi mdi-chart-areaspline"></i>
            </h1>
            <h6 class="text-white">Charts</h6>
          </div>
        </div>
      </div>
      <!-- Column -->
      <div class="col-md-6 col-lg-3">
        <div class="card card-hover">
          <div class="box bg-warning text-center">
            <h1 class="font-light text-white">
              <i class="mdi mdi-collage"></i>
            </h1>
            <h6 class="text-white">Widgets</h6>
          </div>
        </div>
      </div>
      <!-- Column -->
      <div class="col-md-6 col-lg-3">
        <div class="card card-hover">
          <div class="box bg-danger text-center">
            <h1 class="font-light text-white">
              <i class="mdi mdi-border-outside"></i>
            </h1>
            <h6 class="text-white">Tables</h6>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h5 class="card-title">Calender</h5>
        <div class="card">
          <div class="card-body b-l calender-sidebar">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php
  include "../templates/footer.php";
  ?>
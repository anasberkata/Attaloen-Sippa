<?php
session_start();

if (isset($_SESSION['login'])) {
  header("Location: view_admin/dashboard.php");
  exit;
}

include "templates/auth_header.php";
?>

<div class="auth-wrapper py-5">
  <div class="row justify-content-center">
    <div class="col-12 col-md-6 col-lg-4">
      <div class="auth-box border-top border-secondary p-3">
        <div class="text-center">
          <span><img src="assets/img/logo-attaloen.png" alt="logo" width="50%" /></span>
          <h3 class="mt-2">
            SISTEM INFORMASI <br />
            PEMINJAMAN ALAT & BAHAN
          </h3>
          <h4 class="">ATTALOEN</h4>
        </div>

        <?php if (isset($_GET["pesan"])): ?>
          <p class="alert alert-danger my-4" style="font-style: italic; color: red; text-align: center;">
            <?= $_GET["pesan"]; ?>
          </p>
        <?php endif; ?>


        <!-- Form -->
        <form class="form-horizontal mt-3" id="loginform" action="cek_login.php" method="POST">
          <div class="row">
            <div class="col-12">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i
                      class="mdi mdi-account fs-4"></i></span>
                </div>
                <input type="text" class="form-control form-control-lg" placeholder="Username" name="username"
                  required />
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i
                      class="mdi mdi-lock fs-4"></i></span>
                </div>
                <input type="password" class="form-control form-control-lg" placeholder="Password" name="password"
                  required />
              </div>
            </div>
          </div>

          <div class="row border-top border-secondary">
            <div class="col-12">
              <div class="form-group">
                <div class="pt-3">
                  <button class="btn btn-success w-100 text-white" type="submit" name="login">
                    Login
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include "templates/auth_footer.php";
?>
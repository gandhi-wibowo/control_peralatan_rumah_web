<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Saklar</title>
    <link href="<?php echo base_url()."bootstrap/"; ?>css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <script src="<?php echo base_url()."bootstrap/"; ?>js/jquery.min.js"></script>
    <script src="<?php echo base_url()."bootstrap/"; ?>js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        selesai();
    });

    function selesai() {
    	setTimeout(function() {
    		update();
    		selesai();
    	}, 200);
    }

    function update() {
    	$.getJSON("<?php echo base_url()."index.php/Welcome/GetLast/"; ?>",
      function(data) {
    		$('input[name="suhu"]').empty();
    		$.each(data.result, function() {
          if(this['data_suhu'] <= 25){
            $("#suhu").html(this['data_suhu']+"&deg C #Dingin");
          }
          if(this['data_suhu'] >25 && this['data_suhu'] <= 30){
            $("#suhu").html(this['data_suhu']+"&deg C #Gerah");
          }
          if(this['data_suhu'] > 30){
            $("#suhu").html(this['data_suhu']+"&deg C #Panas");
          }
    		});
    	});
    }
    </script>
    <div class="container">
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url()."index.php/"; ?>">Kontrol</a>
          </div>
          <ul class="nav navbar-nav">
            <li  class="active"><a href="#" id="suhu"></a></li>
          </ul>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="Users/Logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Settings <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="Welcome/Saklar">Saklar</a></li>
                  <li><a href="Users">User</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="login-alert" class="alert alert-<?php echo $this->session->flashdata('class'); ?> col-sm-12"><?php echo $this->session->flashdata('value'); ?></div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              Ubah Nama
            </div>
            <div class="panel-body">

              <?php
              $form = array("class"=>"form-horizontal");
               echo form_open('Users/Ubahnama',$form); ?>
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Username:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name='username' placeholder="Username">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" ></label>
                <div class="col-sm-10">
                  <button type='submit' name='ubahnama' class="btn btn-info">Ubah Nama</button>
                </div>
              </div>

              </form>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              Ubah Password
            </div>
            <div class="panel-body">
              <?php echo form_open('Users/Ubahpassword',$form); ?>
              <div class="form-group">
                <label class="control-label col-sm-4">Password Lama :</label>
                <div class="col-sm-8">
                  <input type='password' name='oldpassword' class="form-control" placeholder="Password Lama">
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label col-sm-4">Password Baru :</label>
                <div class="col-sm-8">
                  <input type='password' name='newpassword' class="form-control" placeholder="Password baru">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4">Ulangi Password :</label>
                <div class="col-sm-8">
                  <input type='password' name='verpassword' class="form-control" placeholder="Ulangi Password">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4"></label>
                <div class="col-sm-8">
                  <button type='submit' class="btn btn-info" name='ubahpassword'>Ubah Password</button>
                </div>
              </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

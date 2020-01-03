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
                  <li><a href="Saklar">Saklar</a></li>
                  <li><a href="../Users">User</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <div class="container">
      <div class="alert alert-<?php echo $this->session->flashdata('class'); ?> col-sm-12"><?php echo $this->session->flashdata('value'); ?></div>
    </div>
    <div class="container">
      <div class="col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading">
            Saklar Setting
          </div>
          <div class="panel-body">
            <table class="table table-hover">
              <tbody>
                <?php $no=1; foreach ($saklar as $switch) { ?>
                  <?php echo form_open('Welcome/Rename'); ?>
                  <input type='hidden' name="id" value="<?php echo $switch->id_saklar; ?>">
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><input type='text' class='form-control' name='saklarName' value='<?php echo $switch->nama_saklar; ?>' ></td>
                    <td><button type='submit' name='rename' class='btn btn-info'>Ubah Nama</button></td>
                  </tr>
                </form>
                <?php $no ++; } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

    <?php
    #-------------------------------------------------------------------------------------------------------------------#
    #                                                     Information                                                   #
    #-------------------------------------------------------------------------------------------------------------------#
    #                                               Created By    : Fajar Nurrohmat                                     #
    #                                               Email         : Fajarnur24@gmail.com                                #
    #                                               Name File     : slider.tambah.php                               #
    #                                               Release Date  :                                                     #
    #                                               Created       : 20/04/16 02.23                                      #
    #                                               Last Modified : 22/04/16 01.08                                      #
    #                                                                                                                   #
    #-------------------------------------------------------------------------------------------------------------------#
    #                                                SIK BERKAITAN KARO LOGIN                                           #
    #-------------------------------------------------------------------------------------------------------------------#

    # Include Dari System
    require ('../system/jenglot.php');

    session_start();
    hakAksesKakakz();

    cekTingkatUser(array(1));
    # Sudah Login Dan Menyimpan Session 

    DataMetaTabel();  ?>

    <title>Tambah slider</title>
    
    <?php

    # MEMBUAT NILAI DATA PADA FORM
    # SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)

    $dataKode   = buatKode("slider", "SL");
    $data_title= isset($_POST['title']) ?  $_POST['title'] : '';
    $data_deskribsi= isset($_POST['deskribsi']) ?  $_POST['deskribsi'] : '';


    headfixdatatabel();
    ?>

    <?php

    validator();

    BagianSideBarPanelAdmin();

    BagianTopNavi();

    ?>

    <!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>
              Tambah Data slider
              <small>
                Manage Your Data slider
              </small>
            </h3>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Tambah Data <small>slider</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <p class="text-muted font-13 m-b-30">
                  Isi Data Dengan Benar
                </p>
                <?php 
    # TOMBOL SIMPAN DIKLIK
                if (isset($_POST['buttonsubmit'])) {
    # baca variabel 
    
                  $title= $_POST['title'];
                  $deskribsi = $_POST['deskribsi'];

      #VALIDASI UNTUK FORM JIKA FORM KOSONG

                  function compress_image($source_url, $destination_url, $quality) 
                  { 
                    $info = getimagesize($source_url); 
                    if ($info['mime'] == 'image/jpeg') 
                      $image = imagecreatefromjpeg($source_url); 
                    elseif ($info['mime'] == 'image/gif') 
                      $image = imagecreatefromgif($source_url); 
                    elseif ($info['mime'] == 'image/png') 
                      $image = imagecreatefrompng($source_url); 
                    imagejpeg($image, $destination_url, $quality); 
                    return $destination_url; 
                  } 

      $nama_foto = $_FILES["file"]["name"];
      $file_sik_dipilih = substr($nama_foto, 0, strripos($nama_foto, '.')); // strip extention
      $bagian_extensine = substr($nama_foto, strripos($nama_foto, '.')); // strip name
      $ukurane = $_FILES["file"]["size"];

      $pesanError= array();
      if (trim($title)=="") {
        $pesanError[] = "Data <b>Nama Title slider</b> tidak boleh kosong !";    
      }
      if (trim($deskribsi)=="") {
        $pesanError[] = "Data <b>Description slider</b> tidak boleh kosong !";    
      }
      if (empty($file_sik_dipilih)){
        $pesanError[] = "Anda Belum Memilih Foto !";    
      }

      #JIKA ADA PESAN ERROR DARI VALIDASI FORM 
      if (count($pesanError)>=1) {
        echo "
        <div class='alert alert-danger alert-dismissable'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
          $noPesan= 0;
          foreach ($pesanError as $indeks => $pesan_tampil) {
            $noPesan++;
            echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
          }
          echo "</div><br />";
        }
        else{

         if(($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/pjpeg")){
             $lokasi = '../assets/user/images/slider/';
             
             //$jeneng = $id_pegawai.'.jpg';

             $file = md5(rand(1000,1000000000))."-".$nama_foto;
             $newfilename = $file . $bagian_extensine;
             $jeneng=str_replace(' ','-',$file);
             $url = $lokasi . $jeneng;
             $filename = compress_image($_FILES["file"]["tmp_name"], $url, 80); 
             $kodeBaru= buatKode("slider", "SL");
             $query = mysql_query("INSERT INTO slider SET kd_slider='$kodeBaru', title='$title', deskribsi='$deskribsi', foto='$jeneng' ") or die(mysql_error());
                

             }
             if ($query){
             header('location: ./slider');
              }
  else { $error = "Uploaded image should be jpg or gif or png"; } 

      }
    
    }
    ?>
    <form id="formslider" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
      <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_slider">Kode slider <span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="kd_slider" name="kd_slider" value="<?php echo $dataKode; ?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Image <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="col-lg-8">
          <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../assets/fileupload/images/nopict.jpg" alt="" /></div>
            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
            <div>
              <span class="btn btn-file btn-primary btn-xs"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" accept="image/*" name="file" id="file" placeholder="file" /></span>
              <a href="#" class="btn btn-danger btn-xs fileupload-exists" data-dismiss="fileupload">Remove</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title Slider <span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="title" value="<?php echo $data_title; ?>" name="title" required="required" class="form-control col-md-7 col-xs-12">
    </div>
    </div>
    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskribsi">Description Slider<span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="deskribsi" value="<?php echo $data_deskribsi; ?>" name="deskribsi" required="required" class="form-control col-md-7 col-xs-12">
    </div>
    </div>
    <div style="text-align:center" class="form-actions no-margin-bottom">
     <button type="submit" id="buttonsubmit" name="buttonsubmit" class="btn btn-success">Submit</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    <script type="text/javascript">
     var formslider = $("#formslider").serialize();
     var validator = $("#formslider").bootstrapValidator({
      framework: 'bootstrap',
      feedbackIcons: {
        valid: "fa fa-smile-o",
        invalid: "fa fa-frown-o", 
        validating: "glyphicon glyphicon-refresh"
      }, 
      excluded: [':disabled'],
      fields : {
       title : {
         validators: {
          notEmpty: {
           message: 'Nama Title slider Harus Diisi'
         },
       }
     },
     deskribsi : {
       validators: {
        notEmpty: {
         message: 'Description slider Harus Diisi'
       },
     }
    },
    file : {
      validators : {
        notEmpty: {
         message: 'Belum Memilih Gambar'
       },
       file : {
        extention : 'jpeg,jpg,png',
        type : 'image/jpeg,image/png',
              //maxSize : 2097152, //2048*1024
              message : 'file tidak benar'
            }
          }
        } 
      }
    });

    </script>

    <?php

    BagianFooterPanelAdmin();

    NgisoraneJsDataTabel();
    ?>

<?php
include '../layout/header.php';
if ($_SESSION['login'] != true) {
    header("Location: " . $baseUrl);
    exit();
}
include '../layout/navbar.php';
include '../layout/sidebar.php';
include '../config/functions.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Simulasi LSB</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simulasi LSB</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="">Input File Mp3 : </label>
                                        <input type="file">
                                    </div>
                                </form>
                                <h3 class="card-title">Binary Original File mp3</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                binary output
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="">Input Secret Message : </label>
                                        <input type="text">
                                        <label for="" class="text-success">* Enter jika selesai</label>
                                    </div>
                                </form>
                                <h3 class="card-title">Binary Original File MP3 with Secret Message</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                binary output
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </section>

        <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label for="" class="col-sm-2">ID Number</label>
                                <div class="col-sm-10">
                                    <input type="text" required name="id_number" id="id_number" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" required name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2">Role</label>
                                <div class="col-sm-10">
                                    <select name="role" id="role" class="form-control">
                                        <option value="">-- Pilih Role --</option>
                                        <option value="1">Admin</option>
                                        <option value="0">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary" id="btn_form">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<?php
include '../layout/footer.php';
?>
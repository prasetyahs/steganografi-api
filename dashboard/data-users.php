<?php

include '../layout/header.php';
if ($_SESSION['login'] != true) {
    header("Location: " . $baseUrl);
    exit();
}
include '../layout/navbar.php';
include '../layout/sidebar.php';
$dataUsers = readDataAllRow($conn, "SELECT * FROM users");
if (isset($_POST['submit_add'])) {
    addUsers($_POST, $conn);
}

if (isset($_POST['submit_update'])) {
    updateUsers($_POST, $conn);
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Users</li>
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
                                <h3 class="card-title">Data Users</h3>
                                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAdd" onclick="addData()" style="float: right;"><i class="fa fa-plus"></i> Tambah</button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($dataUsers as $row) { ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td>
                                                    <?php if ($row['role'] == 1) { ?>
                                                        Admin
                                                    <?php } else { ?>
                                                        Users
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <center>
                                                        <button data-toggle="modal" data-target="#modalAdd" onclick="updateData('<?= $row['personal_number'] ?>','<?= $row['name'] ?>','<?= $row['password'] ?>','<?= $row['role'] ?>')" class="btn btn-outline-success btn-sm"> Edit</button>
                                                        <a data-toggle="modal" id="delete" data-target="#modalDelete" onclick="deleteData('<?= $row['personal_number'] ?>','<?= $baseUrl ?>')" class="btn btn-outline-danger btn-sm"> Hapus</a>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>

                                </table>
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
        <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Form Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Anda yakin ingin menghapus data ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a id="btn_delete" class="btn btn-primary">Hapus Data</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
    function addData() {
        document.getElementById('modal-title').innerHTML = "Form Tambah Data";
        document.getElementById('btn_form').innerHTML = "Tambah Data";
        document.getElementById('id_number').value = "";
        document.getElementById('name').value = "";
        document.getElementById('role').value = "";
        $('#btn_form').attr('name', 'submit_add');

        document.getElementById('id_number').readOnly = false;
    }

    function updateData(id, name, password, role) {
        document.getElementById('modal-title').innerHTML = "Form Update Data";
        document.getElementById('btn_form').innerHTML = "Perbarui Data";
        document.getElementById('id_number').value = id;
        document.getElementById('name').value = name;
        document.getElementById('role').value = role;
        $('#btn_form').attr('name', 'submit_update');
        document.getElementById('id_number').readOnly = true;
    }

    function deleteData(id,baseUrl){
        document.getElementById('btn_delete').href = baseUrl+'dashboard/delete-users.php?id='+id;
    }
</script>

<?php
include '../layout/footer.php';
?>
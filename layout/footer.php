<?php if (isset($_SESSION['message'])) { ?>
  <p style="display: none;" id="message"><?= $_SESSION['message'] ?></p>
  <p style="display: none;" id="type"><?= $_SESSION['type'] ?></p>
  <p style="display: none;" id="title"><?= $_SESSION['title'] ?></p>
<?php } ?>
<?php
unset($_SESSION['message']);
unset($_SESSION['type']);
unset($_SESSION['title']);
?>
<footer class="main-footer">
  <strong>Copyright &copy; 2014-2021 Syncode</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.1.0
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>

<!-- jQuery -->
<script src="<?= $baseUrl ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= $baseUrl ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= $baseUrl ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= $baseUrl ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= $baseUrl ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= $baseUrl ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= $baseUrl ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= $baseUrl ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= $baseUrl ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?= $baseUrl ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= $baseUrl ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= $baseUrl ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= $baseUrl ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= $baseUrl ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $baseUrl ?>assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= $baseUrl ?>assets/dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= $baseUrl ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $baseUrl ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= $baseUrl ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= $baseUrl ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= $baseUrl ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= $baseUrl ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= $baseUrl ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= $baseUrl ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= $baseUrl ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= $baseUrl ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= $baseUrl ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= $baseUrl ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  let message = document.getElementById('message');
  if (message != null) {
    let title = document.getElementById('title').innerHTML;
    let type = document.getElementById('type').innerHTML;
    swal({
      title: title,
      text: message.innerHTML,
      icon: type,
    });
  }
</script>
<script>
  $('input[type="file"]').change(function(e) {
    convertFileToBase64($('input[type="file"]')[0].files[0]).then((v) => {
      $.ajax({
        type: "POST",
        url: "show_simulation.php",
        data: {
          mp3: v
        },
        dataType: "json",
        encode: true,
      }).done(function(d) {
        datatable(d)
      })
    });
  });
  datatable = async (d) => {
    body = $('#tbody');
    i = 0, size = 8
    var i, j, temporary, chunk = 8;
    await new Promise(resolve => setTimeout(resolve, 1000))
    body.each(function() {
      $(this).children('td').remove();
    });
    for (i = 0, j = d.length; i < j; i += chunk) {
      await new Promise(resolve => setTimeout(resolve, 1000))
      body.append("<tr>")
      temporary = d.slice(i, i + chunk);
      for (tmp of temporary) {
        body.append("<td>" + tmp + "</td>")
      }
      body.append("</tr>")
    }
  }

  function convertFileToBase64(file) {
    return new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => resolve(reader.result);
      reader.onerror = reject;
    });
  }
</script>
</body>

</html>
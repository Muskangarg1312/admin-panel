

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<footer class="footer">
  <!-- <div class="container-fluid d-flex justify-content-between">
    <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
    <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin template</a> from Bootstrapdash.com</span>
  </div> -->
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
 <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->

<script src="<?= base_url() ?>public/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?= base_url() ?>public/assets/vendors/chart.js/Chart.min.js"></script>
<script src="<?= base_url() ?>public/assets/js/jquery.cookie.js" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?= base_url() ?>public/assets/js/off-canvas.js"></script>
<script src="<?= base_url() ?>public/assets/js/hoverable-collapse.js"></script>
<script src="<?= base_url() ?>public/assets/js/misc.js?v=<?= time(); ?>"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="<?= base_url() ?>public/assets/js/dashboard.js"></script>


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>public/assets/js/delete.js?ver=<?= time() ?>">
</script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            pageLength: 10,
             // scrollX: true
        });

        $('#entryTable').DataTable({
            pageLength: 10,
            scrollX: true,
            dom: 'Bfrtip',
            buttons: [
                 'excel'
                ]
        });

        $('#entryNewTable').DataTable({
            pageLength: 10,
            dom: 'Bfrtip',
            buttons: [
                 'excel'
                ]
        });

        $('.js-example-basic-single').select2();
        
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $('.select2').select2();
</script>
<!-- End custom js for this page -->
</body>
</html>
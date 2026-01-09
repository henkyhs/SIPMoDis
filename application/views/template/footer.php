</div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin akan keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik tombol logout untuk  keluar dari SIPMoDis</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="<?= site_url('auth/logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Pelaporan Download -->

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url ('assets/') ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url ('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url ('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url ('assets/') ?>js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url ('assets/') ?>vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url ('assets/') ?>js/demo/chart-area-demo.js"></script>
  <script src="<?= base_url ('assets/') ?>js/demo/chart-pie-demo.js"></script>
	
	<!-- Dari AI -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="<?= base_url('assets/js/custom.js'); ?>"></script>
  
	<script>
  $(function() {
    $('#tanggal_pinjam').datepicker({
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true
    });
  });

	</script>
<script>
  (function(){
  function pad(n){ return n<10 ? '0'+n : ''+n; }
  function toISO(d){
    return d.getFullYear()+'-'+pad(d.getMonth()+1)+'-'+pad(d.getDate());
  }

  var preset = document.getElementById('presetExport');
  var from = document.getElementById('exportFrom');
  var to = document.getElementById('exportTo');

  if (!preset || !from || !to) return;

  preset.addEventListener('change', function(){
    var now = new Date();
    var start, end;

    if (this.value === '7d') {
      end = new Date(now);
      start = new Date(now); start.setDate(start.getDate() - 6);
    } else if (this.value === 'this_month') {
      end = new Date(now);
      start = new Date(now.getFullYear(), now.getMonth(), 1);
    } else if (this.value === 'last_month') {
      start = new Date(now.getFullYear(), now.getMonth() - 1, 1);
      end = new Date(now.getFullYear(), now.getMonth(), 0);
    } else {
      return;
    }

    from.value = toISO(start);
    to.value = toISO(end);
  });

  // default isi hari ini agar tidak kosong
  var today = toISO(new Date());
  if (!from.value) from.value = today;
  if (!to.value) to.value = today;
})();
</script>
</body>

</html>

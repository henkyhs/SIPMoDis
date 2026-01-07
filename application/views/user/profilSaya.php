<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-5">

      <div class="card shadow-sm border-0">
        <div class="card-body text-center">

          <!-- Nama -->
          <h5 class="mb-1 font-weight-bold">
            <?= htmlspecialchars($user->namaPegawai); ?>
          </h5>
          
          <hr>

          <!-- Detail -->
          <div class="text-left">
            <div class="d-flex justify-content-between mb-2">
              <span class="text-muted">NIP</span>
              <span class="font-weight-medium">
                <?= htmlspecialchars($user->nip); ?>
              </span>
            </div>

             <div class="d-flex justify-content-between mb-2">
              <span class="text-muted">Seksi</span>
              <span class="font-weight-medium">
                <?= htmlspecialchars($user->namaSeksi); ?>
              </span>
            </div>

        </div>
      </div>

    </div>
  </div>
</div>

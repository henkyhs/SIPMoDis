function toggleCustomRange(){
  var rCustom = document.getElementById('rCustom');
  if (!rCustom) return; // safety

  var wrap = document.getElementById('customRangeWrap');
  var start = document.getElementById('tglMulai');
  var end = document.getElementById('tglSelesai');

  var isCustom = rCustom.checked;
  wrap.style.display = isCustom ? 'block' : 'none';
  start.required = isCustom;
  end.required = isCustom;
}

document.addEventListener('DOMContentLoaded', function(){
  document.querySelectorAll('input[name="range"]').forEach(function(r){
    r.addEventListener('change', toggleCustomRange);
  });
  toggleCustomRange();
});

function toggleLampiran() {
  const radioLainnya = document.getElementById('keperluan_visit');
  const lampiranWrap = document.getElementById('lampiranWrapper');
  const lampiranInput = document.getElementById('lampiran');

  if (!radioLainnya || !lampiranWrap || !lampiranInput) return;

  if (radioLainnya.checked) {
    lampiranWrap.style.display = 'block';
    lampiranInput.required = true;
  } else {
    lampiranWrap.style.display = 'none';
    lampiranInput.required = false;
    lampiranInput.value = ''; // reset file jika pindah pilihan
  }
}

document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('input[name="keperluan"]').forEach(function (radio) {
    radio.addEventListener('change', toggleLampiran);
  });

  // set kondisi awal (jika form edit / reload)
  toggleLampiran();
});

function togglePassword(btnId, inputId) {
  document.getElementById(btnId).addEventListener('click', function () {
    const input = document.getElementById(inputId);
    const icon = this.querySelector('i');

    if (input.type === 'passwordBaru') {
      input.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      input.type = 'passwordBaru';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  });
}

togglePassword('togglePassword', 'passwordBaru');
togglePassword('togglePassword2', 'konfirmasiPassword');

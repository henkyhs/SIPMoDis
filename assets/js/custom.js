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

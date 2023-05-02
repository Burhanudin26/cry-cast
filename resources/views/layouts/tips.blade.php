<!-- Modal -->
</style>
<div class="modal fade" id="tips" tabindex="-1" role="dialog" aria-labelledby="tips" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="tips">Tips</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Beberapa tips dalam memasukkan data:</p>
        <ul>
          <li>Pastikan dataset anda valid agae prediksi akurat</li>
          <li>Dataset harus memiliki kolom tanggal, High, Low dan Volume</li>
          <li>Dataset dapat di unduh di <a href="https://sg.finance.yahoo.com/crypto/">Yahoo Finance</a></li>
          <li>Take your time and be thorough!</li>
        </ul>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- jquery link --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $("#tips").modal("show"); // modal is for tips
  });
</script>

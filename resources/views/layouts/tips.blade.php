<!-- Modal -->
<style>
  img:hover {
    transform: scale(3);
    /* Increase the size of the image by 20% */
    transition: 0.3s !important;
    /* Add transition effect */
  }

    img {
      transition: 0.3s !important;
      /* Add transition effect */
    }
</style>
<div class="modal fade" id="tips" tabindex="-1" role="dialog" aria-labelledby="tips" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="tips">Tips</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Here are some tips for entering data:</p>
        <ul>
          <li>Make sure to double-check your entries for accuracy</li>
          <li>Use the correct format for dates, numbers, and other data types</li>
          <li>Dataset example:</li>
          <img src="{{ url('pictures/table.png') }}" alt="" class="img-fluid" style="max-width:">
          <li>Take your time and be thorough!</li>
        </ul>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

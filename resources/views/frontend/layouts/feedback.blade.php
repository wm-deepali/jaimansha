<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content p-4 rounded-3" style="background-color: #fff;">
      <div class="modal-header border-0">
        <h5 class="modal-title">Submit Your Feedback</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <form action="#" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" required />
          </div>

          <div class="mb-3">
            <label class="form-label">Email ID</label>
            <input type="email" name="email" class="form-control" required />
          </div>

          <div class="mb-3">
            <label class="form-label">Mobile Number</label>
            <input type="tel" name="mobile" class="form-control" maxlength="10" required />
          </div>

          <div class="mb-3">
            <label class="form-label d-block">Star Rating</label>
            <div class="d-flex gap-1">
              <input type="radio" name="rating" id="star5" value="5">
              <label for="star5" class="text-warning">&#9733;</label>
              <input type="radio" name="rating" id="star4" value="4">
              <label for="star4" class="text-warning">&#9733;</label>
              <input type="radio" name="rating" id="star3" value="3">
              <label for="star3" class="text-warning">&#9733;</label>
              <input type="radio" name="rating" id="star2" value="2">
              <label for="star2" class="text-warning">&#9733;</label>
              <input type="radio" name="rating" id="star1" value="1">
              <label for="star1" class="text-warning">&#9733;</label>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Your Feedback</label>
            <textarea name="feedback" class="form-control" rows="3" required></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Upload Profile Picture</label>
            <input type="file" name="profile_image" class="form-control" accept="image/*" />
          </div>

        </div>
        <div class="modal-footer border-0">
          <button type="submit" class="btn btn-primary">Submit Feedback</button>
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

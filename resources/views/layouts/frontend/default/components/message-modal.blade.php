<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModal" aria-hidden="true">
    <form method="post" action="/message/new">
        @csrf <!-- {{ csrf_field() }} -->
        <input type="hidden" name="ad" id="ad" value="{{ $ad['id'] }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Üzenet küldése</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="abc..." id="message" name="message" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">bezár</button>
                    <button type="submit" class="btn btn-primary">Küldés</button>
                </div>
            </div>
        </div>
    </form>
</div>

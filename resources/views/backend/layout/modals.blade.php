<!-- Seo Modal -->
<div class="modal fade" id="seoModal" tabindex="-1" aria-labelledby="seoModallLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seoModalLabel">Seo for: <span id="seoObject"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="seoTitle">{{ __('Title') }}</label>
                    <input type="text" class="form-control" name="title" id="seoTitle">
                </div>
                <div class="form-group mb-3">
                    <label for="seoDescription">{{ __('Description') }}</label>
                    <textarea cols="3" rows="3" class="form-control" name="description" id="seoDescription"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="seoKeywords">{{ __('Keywords') }}</label>
                    <textarea cols="3" rows="3" class="form-control" name="keywords" id="seoKeywords"></textarea>
                </div>
                <input type="hidden" id="seoId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-primary store-seo-data">{{ __('Update') }}</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to get SEO data for model
    async function getSeo(model, id) {
        try {
            const response = await fetch('/backend/seo/' + model + '/' + id);
            const seo = await response.json();
            return seo;
        } catch (error) {
            return null;
        }
    }

    // Function to set SEO data for model
    async function setSeo(model, id, data) {
        const token = '{{ csrf_token() }}';
        fetch('/backend/seo/' + model + '/' + id + '/update', {
                method: 'POST',
                body: JSON.stringify({
                    _token: token,
                    title: data.title,
                    description: data.description,
                    keywords: data.keywords,
                    id: data.id
                }),
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": token
                },
            })
            .then(function(response) {
                return response.json()
            })
            .then(function(data) {
                // Do something if needed
            }).catch(error => console.error('Error:', error));
    }

    $(document).ready(function() {
        let id = null;
        let model = null;
        let method = 'store';
        // Handle Seo Modal
        let seoModal = new bootstrap.Modal(document.getElementById('seoModal'))
        let seoTitle = $('#seoTitle');
        let seoDescription = $('#seoDescription');
        let seoKeywords = $('#seoKeywords');
        let seoId = $('#seoId');
        $(".show-seo-modal").on('click', async function() {
            id = $(this).data('id')
            model = $(this).data('model')
            // Fetch data of exist
            let seoData = await getSeo(model, id);
            if (seoData) {
                seoTitle.val(seoData.title)
                seoDescription.val(seoData.description)
                seoKeywords.val(seoData.keywords)
                seoId.val(seoData.id)
            }
            seoModal.show();
        });

        $(".store-seo-data").on('click', async function() {
            let data = {
                title: seoTitle.val(),
                description: seoDescription.val(),
                keywords: seoKeywords.val(),
                id: seoId.val()
            }
            let seoResponse = await setSeo(model, id, data)
            seoModal.hide();
        });
    });
</script>

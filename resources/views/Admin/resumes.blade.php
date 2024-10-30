@include('ui.header')
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6>Add New Blog Post</h6>
                </div>
                <div class="ms-panel-body">
                    <!-- Blog Form -->
                    <form action="{{route('add-new-blog')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Blog Title -->
                        <div class="form-group">
                            <label for="title">Blog Title</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter blog title" required>
                        </div>

                        <!-- Blog Thumbnail with Preview -->
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail Image</label>
                            <input type="file" id="thumbnail" name="thumbnail" class="form-control-file" accept="image/*" required onchange="previewThumbnail(event)">
                            <img id="thumbnailPreview" src="" alt="Thumbnail Preview" style="display: none; max-width: 25%; max-height: 25%; margin-top: 10px;">
                        </div>

                        <!-- Quill Editor for Blog Content -->
                        <div class="form-group">
                            <label for="content">Blog Content</label>
                            <div id="quillEditor"></div>
                            <!-- Hidden Textarea for Form Submission -->
                            <textarea name="content" id="hiddenContent" style="display:none;" ></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit Blog Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('ui.footer')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize Quill editor with a full-featured toolbar
        var quill = new Quill('#quillEditor', {
            theme: 'snow',
            placeholder: 'Write your blog content here...',
            modules: {
                toolbar: [
                    [{ font: [] }, { size: ['small', false, 'large', 'huge'] }],
                    [{ header: '1' }, { header: '2' }, { header: '3' }, { header: '4' }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ color: [] }, { background: [] }],
                    [{ align: [] }],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    [{ indent: '-1' }, { indent: '+1' }],
                    ['link', 'blockquote', 'code-block', 'image', 'video'],
                    ['clean']
                ]
            }
        });

        // Get the form element
        const form = document.querySelector("form");

        // Sync editor content with hidden textarea on form submit
        form.onsubmit = function() {
            document.querySelector('#hiddenContent').value = quill.root.innerHTML;
        };
    });

    // Thumbnail Preview Function
    function previewThumbnail(event) {
        const thumbnailPreview = document.getElementById('thumbnailPreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                thumbnailPreview.src = e.target.result;
                thumbnailPreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>

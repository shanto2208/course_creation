@extends('layouts.app')

@section('title', 'Course List')

@section('header')
    Course List
@endsection



@section('content')

<div class="content">
    <div class="title">
        <h1>Create a Course</h1>
        <a href="{{ url('/') }}" class="back-link">< Back to Course Page</a>
    </div>

    <div class="main">
        <form id="courseForm">
            @csrf
            <div class="row">
                <div class="form_field">
                    <label for="">Course Title</label>
                    <input type="text" class="input" name="course_title">
                    <div id="error_course_title" class="text_red"></div>
                </div>
                <div class="form_field">
                    <label for="">Feature Video</label>
                    <input type="text" class="input" name="feature_video">
                </div>
            </div>
            <hr style="border: none; border-top: 2px solid #c4c4c4; margin: 20px 0;">

            <div class="add_module">
                <button type="button" class="add_btn_primary" onclick="addModule()">&#10010; Add Module</button>
                <br>
                <div id="module_container"></div>
            </div>

            <div>
                <button type="button" id="saveBtn" class="add_btn_success">Save</button>
                <a href="{{ url('/') }}" class="back-link"><button type="button" class="add_btn_danger" >Cancel</button></a>
            </div>

        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal_content">
        <p>Are you sure you want to delete this item?</p>
        <div class="modal_actions">
            <button class="confirm_btn" onclick="confirmDelete()">Yes, Delete</button>
            <button class="cancel_btn" onclick="closeDeleteModal()">Cancel</button>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        let moduleCount = 1;
        let contentCount = 1;
        let itemToDelete = null;

        function addModule() {
            const container = document.getElementById('module_container');

            const moduleHTML = `
                <div class="module" data-content-count="1">
                    <div class="module_top" onclick="toggleModuleContent(this)">
                        <p>Module <span>${moduleCount}</span></p>
                        <div>
                            <button class="delete_btn" type="button" onclick="event.stopPropagation(); showDeleteModal(this)">🗑</button>
                            <span class="arrow">&#9654;</span>
                        </div>
                    </div>
                    <div class="module_content">
                        <div class="row">
                            <div class="form_field">

                                <label>Module Title</label>
                                <input type="text" class="input" name="module_title">
                                <div id="error_module_title_${moduleCount}" class="text_red"></div>

                            </div>
                        </div>
                        <br>
                        <div class="content_container"></div>
                        <button type="button" class="add_btn_primary" onclick="addContent(this)">&#10010; Add Content</button>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', moduleHTML);
            moduleCount++;
        }

        function addContent(button) {
            const module = button.closest('.module');
            const moduleCount = module.querySelector('.module_top p span').textContent.trim();
            const contentContainer = module.querySelector('.content_container');

            // Get current count and increment
            let count = parseInt(module.dataset.contentCount, 10);
            module.dataset.contentCount = count + 1;

            const contentHTML = `
                <div class="content_item">
                    <div class="module_top" onclick="toggleContentBody(this)">
                        <p>Content <span>${count}</span></p>
                        <div>
                            <button class="delete_btn" type="button" onclick="event.stopPropagation(); showDeleteModal(this)">🗑</button>
                            <span class="arrow">&#9654;</span>
                        </div>
                    </div>
                    <div class="content_body">
                        <div class="collumn">
                            <div class="form_field">
                                <label>Content Title</label>
                                <input type="text" class="input" name="content_title">
                                <div id="${moduleCount}_content_title_${count}_title" class="text_red"></div>
                            </div>
                            <div class="form_field">
                                <label>Video Source Type</label>
                                <input type="text" class="input" name="source_type">
                            </div>
                            <div class="form_field">
                                <label>Video URL</label>
                                <input type="text" class="input" name="video_url">
                                <div id="${moduleCount}_content_url_${count}_url" class="text_red"></div>
                            </div>
                            <div class="form_field">
                                <label>Video Length</label>
                                <input type="text" class="input video_length_input" name="video_length" placeholder="HH:MM:SS">
                                <div id="${moduleCount}_content_length_${count}_length" class="text_red"></div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            contentContainer.insertAdjacentHTML('beforeend', contentHTML);

            const newInput = contentContainer.querySelector('.content_item:last-child .video_length_input');

            flatpickr(newInput, {
                enableTime: true,
                noCalendar: true,
                enableSeconds: true,
                time_24hr: true,
                dateFormat: "H:i:S"
            });
        }

        


        function toggleModuleContent(el) {
            const module = el.closest('.module');
            const content = module.querySelector('.module_content');
            const arrow = el.querySelector('.arrow');

            content.classList.toggle('collapsed');
            arrow.innerHTML = content.classList.contains('collapsed') ? '&#9654;' : '&#9660;';
        }

        function toggleContentBody(el) {
            const contentItem = el.closest('.content_item');
            const contentBody = contentItem.querySelector('.content_body');
            const arrow = el.querySelector('.arrow');

            contentBody.classList.toggle('collapsed');
            arrow.innerHTML = contentBody.classList.contains('collapsed') ? '&#9654;' : '&#9660;';
        }

        function showDeleteModal(button) {
            const contentItem = button.closest('.content_item');
            const moduleItem = button.closest('.module');

            if (contentItem) {
                itemToDelete = contentItem;
            } else if (moduleItem) {
                itemToDelete = moduleItem;
            }

            document.getElementById('deleteModal').style.display = 'block';
        }


        function closeDeleteModal() {
            itemToDelete = null;
            document.getElementById('deleteModal').style.display = 'none';
        }

        function confirmDelete() {
            if (itemToDelete) {
                itemToDelete.remove();
            }
            closeDeleteModal();
        }

    </script>

    <script>
        document.getElementById('saveBtn').addEventListener('click', function (e) {
            e.preventDefault();
            
            let formData = new FormData(document.getElementById('courseForm'));

            const modules = [];
            const moduleElements = document.querySelectorAll('.module');
            

            moduleElements.forEach(function(module) {
                const moduleData = {
                    title: module.querySelector('[name="module_title"]').value,
                    content: []
                };
                
                const contentItems = module.querySelectorAll('.content_item');
                contentItems.forEach(function(contentItem) {
                    moduleData.content.push({
                        title: contentItem.querySelector('[name="content_title"]').value,
                        video_url: contentItem.querySelector('[name="video_url"]').value,
                        video_length: contentItem.querySelector('[name="video_length"]').value
                    });
                });

                modules.push(moduleData);
            });
            
            formData.append('course_title', document.querySelector('[name="course_title"]').value);
            formData.append('feature_video', document.querySelector('[name="feature_video"]').value);

            formData.append('modules', JSON.stringify(modules));
            formData.append('_token', '{{ csrf_token() }}'); // Important for Laravel CSRF

            fetch("{{ route('saveCourse') }}", {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    sessionStorage.setItem('success', 'Course created successful!');
                    window.location.href = '{{ url("/") }}';
                } else {
                    alert("There was an error saving the course.");
                }
            })
            .catch(error => {


                document.querySelectorAll('.text_red').forEach(el => el.innerText = '');

                if (error.errors) {

                    if (error.errors.course_title) {
                        document.getElementById('error_course_title').innerText = error.errors.course_title[0];
                    }

                    // For module titles
                    Object.keys(error.errors).forEach(key => {

                        let newKey = key.replace(/\./g, '_');
                        if (key.includes('modules')) {

                            let moduleIndex = key.split('.')[1];
                            const errorMessage = error.errors[key];
                            const errorElement = document.getElementById('error_module_title_' + moduleIndex);
                            
                            if (errorElement) {
                                errorElement.innerText = errorMessage;
                            }
                        }

                        if ( key.includes('title')) {
                            let Index = 1;
                            const errorMessage = error.errors[key];
                            const errorElement = document.getElementById(newKey );
                            console.log(newKey);
                            if (errorElement) {
                                errorElement.innerText = errorMessage;
                            }
                            Index++;
                        }

                        if ( key.includes('length')) {
                            let Index = 1;
                            const errorMessage = error.errors[key];
                            const errorElement = document.getElementById(newKey);
                            if (errorElement) {
                                errorElement.innerText = errorMessage;
                            }
                            Index++;
                        }

                        if ( key.includes('url')) {
                            let Index = 1;
                            const errorMessage = error.errors[key];
                            const errorElement = document.getElementById(newKey + Index);
                            if (errorElement) {
                                errorElement.innerText = errorMessage;
                            }
                            Index++;
                        }

                    });
                } else {
                    console.error("Unexpected error:", error);
                }


            });
        });

    </script>

@endsection

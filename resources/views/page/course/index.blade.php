
@extends('layouts.app')

@section('title', 'Course List')

@section('header')
    Course List
@endsection

@section('content')
<style>
    .card_delete{
        float: right;
    }


</style>
    <div class="content">
        <div class="title">
            <h1>Course List</h1>
        </div>
        <div class="main">
        
            <a href="{{ url('/create') }}">
                <button class="create_btn">&#10010; Create New Course</button>
            </a>
            
            <div class="course_list">
                @foreach ($courses as $item)
                <form action="{{ route('deleteCourse', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE') <!-- Method spoofing -->
                    
                    <div class="course_card" data-course-id="{{ $item->id }}">
                        
                        <button class="delete_btn card_delete" type="submit">🗑</button>
                        <h2>{{ $item->title }}</h2>
                        <p>{{ $item->feature_video }}</p>
                    
                        
                    </div>
                
                </form>
                @endforeach


            </div>
        
        </div>
    </div>

    @if (session('success'))
        <div id="successModal" class="pop_modal" style="display:none;">
            <div class="pop-modal-content">
                <span class="close-btn" onclick="popCloseModal()">&times;</span>
                <p id="modalMessage">{{ session('success') }}</p>
            </div>
        </div>
        
        <script>
            // Show the modal with the success message
            document.getElementById('successModal').style.display = 'block';

            // Auto-close after 5 seconds
            setTimeout(() => {
                popCloseModal();
            }, 5000);
        </script>
    @endif






@endsection



</body>
</html>

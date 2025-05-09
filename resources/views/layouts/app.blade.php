
<html>
<head>
    <title>@yield('title', 'Course Platform')</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 250px; /* Sidebar width */
            background-color: #fdfdfd;
            color: rgb(0, 0, 0);
            height: 100%;
            padding-top: 20px;
            position: fixed;
            /* text-align: center; */
            border-right: 2px solid #ddd; /* Right border */
            transform: translateX(0); /* Default position */
            transition: transform 0.3s ease; /* Add transition effect */
        }

        .sidebar.hidden {
            transform: translateX(-250px); /* Move sidebar off screen */
        }

        .sidebar img {
            width: 220px;
            margin-bottom: 20px;
        }
        
        /* .sidebar a {
            display: block;
            color: rgb(7, 0, 0);
            padding: 10px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #b9b9b9;
        } */

        body
        {
            background-color: #e7e7e7;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #e7e7e7;
            transition: margin-left 0.3s ease;
            width: 100%;
        }

        .header {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .top-nav {
            position: fixed;
            top: 0;
            left: 250px; /* Adjusted for sidebar width */
            width: calc(100% - 250px);
            height: 80px;
            background-color: #ffffff;
            color: black;
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 1;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid #ddd;
            transition: left 0.3s ease; /* Add transition effect for top-nav */
        }

        .menu-btn {
            background: none;
            border: none;
            color: rgb(0, 0, 0);
            font-size: 35px;
            cursor: pointer;
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: 100%;
                position: absolute;
            }

            .main-content {
                margin-left: 0;
            }

            .top-nav {
                left: 0;
                width: 100%;
            }

            .sidebar.hidden {
                display: none;
            }
        }

        .sidebar.hidden + .top-nav {
            left: 0;
            width: 100%;
        }

        .sidebar.hidden + .top-nav + .main-content {
            margin-left: 0;
        }

        .title {
            padding: 10px;
        }

        .title h1 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }

        .course_list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 10px;
        }

        .course_card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1);
        }

        .course_card h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .course_card p {
            font-size: 14px;
            color: #666;
        }
        .create_btn {
            background-color: green;
            color: #fff;
            padding: 10px 20px;
            margin-left: 10px; 
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;

        }

        .create_btn:hover {
            background-color: darkgreen;
        }

        .add_btn_primary {
            background-color: rgb(65, 105, 225); /* Royal Blue */
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add_btn_success, .add_btn_danger {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 5px;
            margin-top: 10px;
        }

        .add_btn_success {
            background-color: #28a745; /* Bootstrap green */
            color: white;
        }

        .add_btn_success:hover {
            background-color: #218838;
        }

        .add_btn_danger {
            background-color: #dc3545; /* Bootstrap red */
            color: white;
        }

        .add_btn_danger:hover {
            background-color: #c82333;
        }


        .add_btn_primary:hover {
            background-color: rgb(50, 90, 200); /* Slightly darker Royal Blue */
        }


        .menu_list {
            padding: 10px;
        }

        .menu_op {
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1);
            padding: 10px;
            margin: 5px 0;
            transition: background-color 0.3s ease;
            border-radius: 8px;
        }

        .menu_op a {
            display: block;
            color: rgb(98, 98, 98);
            text-decoration: none;
            font-size: 20px;
            padding: 5px 10px;
            transition: color 0.3s ease;
        }

        .menu_op:hover {
            background-color: rgb(65, 105, 225);
        }

        .menu_op:hover a {
            color: white;
        }



        .logo {
            text-align: center;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1); 
            padding-bottom: 5px;
        }



        .title {
            padding: 10px;
        }

        .title h1 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .back-link {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .create_btn {
            background-color: green;
            color: #fff;
            padding: 10px 20px;
            margin-left: 10px; 
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .create_btn:hover {
            background-color: darkgreen;
        }


        .menu_op.active {
            background-color: rgb(65, 105, 225); /* Royal blue */
        }

        .menu_op.active a {
            color: white;
        }

        .title {
        padding: 10px;
        }

        .title h1 {
        font-size: 28px;
        font-weight: bold;
        color: #333;
        border-bottom: 2px solid #ddd;
        padding-bottom: 5px;
        }

        .course_list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        padding: 10px;
        }

        .course_card {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1);
        }

        .course_card h2 {
        font-size: 18px;
        margin-bottom: 10px;
        }

        .course_card p {
        font-size: 14px;
        color: #666;
        }
        .create_btn {
        background-color: green;
        color: #fff;
        padding: 10px 20px;
        margin-left: 10px; 
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;

        }

        .create_btn:hover {
        background-color: darkgreen;
        }

        .main-content {
            width: 100%;
        }

        .content{
            padding-left: 10px;
            padding-top: 10px;
        }


        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* optional spacing between fields */
        }

        .form_field {
            flex: 1;
            min-width: 250px;
            display: flex;
            flex-direction: column;
        }

        /* Optional: control column layout for very small screens */
        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }
        }

        .pop_modal {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: rgb(57, 141, 57);
            color: aliceblue;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            max-width: 300px;
            min-width: 200px;
        }
        .pop-modal-content {
            text-align: center;
        }
        .close-btn {
            color: #aaa;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 10px;
        }
        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
        }

        .input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .input:focus {
            border-color: #4169e1;
            outline: none;
        }

        .main {
            background-color: #fff4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            max-height: 82vh;       
            overflow-y: auto;       
        }

        .module, .content_item {
            margin-top: 10px;
            background-color: #ffffff;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
        }

        .module_top {
            background-color: #e3e3e3;
            padding-left: 10px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .arrow {
            font-size: 16px;
            transition: transform 0.3s ease;
            padding-right: 20px;
        }

        .module_content, .content_body {
            display: block;
            padding: 10px;
            background-color: #fdfdfd;
            border-top: 1px solid #ccc;
        }

        .module.collapsed .module_content,
        .module_content.collapsed,
        .content_body.collapsed {
            display: none;
        }

        .module.collapsed .arrow {
            transform: rotate(90deg);
        }

        .delete_btn {
            background: none;
            border: none;
            color: red;
            font-size: 18px;
            margin-right: 10px;
            cursor: pointer;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal_content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }

        .modal_actions button {
            margin: 10px;
            padding: 8px 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .confirm_btn {
            background-color: #dc3545;
            color: #fff;
        }

        .cancel_btn {
            background-color: #6c757d;
            color: #fff;
        }

        .text_red{
            color: #dc3545;
        }


    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <div class="sidebar" id="sidebar">
        <div class="logo">
            <img src="../public/image/softy_black.png" alt="Logo" class="sidebar-logo">
        </div>
        <div class="menu_list">

            <div class="menu_op {{ Request::is('*') ? 'active' : '' }}">
                <a href="{{ url('/') }}">Courses</a>
            </div>

        </div>
    </div>

    <div class="top-nav">
        <button class="menu-btn" onclick="toggleSidebar()">☰</button>
        <span>Course Platform</span>
    </div>

    <div class="main-content">
        <div class="header">@yield('header')</div>
        @yield('content')
    </div>

    <div id="successModal" class="pop_modal" style="display:none;">
        <div class="pop-modal-content">
            <span class="close-btn" onclick="popCloseModal()">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>




    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('hidden');
            document.querySelector('.main-content').classList.toggle('sidebar-hidden');
            document.querySelector('.top-nav').classList.toggle('sidebar-hidden');
        }

        window.onload = function() {

            let successMessage = sessionStorage.getItem('success');
            if (successMessage) {
                document.getElementById('modalMessage').textContent = successMessage;
                document.getElementById('successModal').style.display = 'block';
                
                sessionStorage.removeItem('success');
                
                setTimeout(function() {
                    document.getElementById('successModal').style.display = 'none';
                }, 5000); 
            }
        };

        function popCloseModal() {
            document.getElementById('successModal').style.display = 'none';
        }

    </script>

</body>
</html>

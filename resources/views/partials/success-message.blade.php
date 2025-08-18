@if(session('success'))
    <div class="alert alert-success success-toast">
        {{ session('success') }}
    </div>

    <style>
        .success-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            padding: 12px 20px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            animation: slideIn 0.5s ease, fadeOut 0.5s ease 3s forwards;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeOut {
            to { opacity: 0; transform: translateX(100%); }
        }
    </style>
@endif

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-md-6 text-center welcome-container">
                    <!-- Welcome Text dengan animasi -->
                    <h1 class="animate-welcome">Welcome</h1>
                    
                    <!-- Coffee Icon dengan animasi -->
                    <div class="coffee-container mb-4">
                        <i class="fas fa-coffee coffee-icon"></i>
                    </div>
                    
                    <!-- Text dengan animasi fade-in -->
                    <p class="lead text-muted fade-in">Selamat datang di Kedai Ngobat</p>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
.welcome-container {
    padding: 2rem;
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Animasi Welcome Text */
.animate-welcome {
    font-size: 3.5rem; /* Ukuran dikecilkan */
    font-weight: bold;
    color: #1a237e;
    margin-bottom: 1.5rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    animation: titleGlow 2s ease-in-out infinite alternate;
}

@keyframes titleGlow {
    from {
        text-shadow: 0 0 5px rgba(26,35,126,0.3);
        transform: scale(1);
    }
    to {
        text-shadow: 0 0 10px rgba(26,35,126,0.5);
        transform: scale(1.02);
    }
}

/* Coffee Icon Styling */
.coffee-icon {
    font-size: 3rem;
    color: #795548;
    margin: 1.5rem 0;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* Text Animation */
.fade-in {
    animation: fadeIn 1.5s ease-in;
    font-size: 1.2rem;
    color: #666;
    margin-top: 1rem;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .animate-welcome {
        font-size: 2.5rem;
    }
    
    .coffee-icon {
        font-size: 2.5rem;
    }
    
    .fade-in {
        font-size: 1rem;
    }
}

/* Background */
#layoutSidenav_content {
    background: #f5f7fa;
}
</style>
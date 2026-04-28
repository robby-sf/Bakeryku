import './bootstrap';

// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
});

// Desktop user menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const userMenuBtn = document.getElementById('user-menu-btn');
    const userMenu = document.getElementById('user-menu');

    if (userMenuBtn && userMenu) {
        userMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userMenu.classList.toggle('hidden');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!userMenuBtn.contains(e.target) && !userMenu.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });
    }
});

// Quantity input functionality
document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    
    quantityInputs.forEach(container => {
        const minusBtn = container.querySelector('.quantity-minus');
        const plusBtn = container.querySelector('.quantity-plus');
        const input = container.querySelector('.quantity-value');
        
        if (minusBtn && plusBtn && input) {
            minusBtn.addEventListener('click', function() {
                let value = parseInt(input.value);
                if (value > 1) {
                    value--;
                    input.value = value;
                }
            });
            
            plusBtn.addEventListener('click', function() {
                let value = parseInt(input.value);
                value++;
                input.value = value;
            });
        }
    });
});

// Heart (favorite) toggle
document.addEventListener('DOMContentLoaded', function() {
    const heartBtns = document.querySelectorAll('.heart-btn');
    
    heartBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (icon) {
                if (icon.classList.contains('fa-regular')) {
                    // Not favorited, make it active
                    icon.classList.remove('fa-regular', 'text-gray-500', 'hover:text-red-500');
                    icon.classList.add('fa-solid', 'text-red-500');
                    this.classList.remove('hover:text-red-500', 'hover:border-red-500');
                    this.classList.add('text-red-500', 'border-red-500');
                } else {
                    // Favorited, make it inactive
                    icon.classList.remove('fa-solid', 'text-red-500');
                    icon.classList.add('fa-regular', 'text-gray-500', 'hover:text-red-500');
                    this.classList.remove('text-red-500', 'border-red-500');
                    this.classList.add('hover:text-red-500', 'hover:border-red-500');
                }
            }
        });
    });
});

// Share functionality
document.addEventListener('DOMContentLoaded', function() {
    const shareBtns = document.querySelectorAll('.share-btn');
    
    shareBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const url = window.location.href;
            const title = document.title;
            
            if (navigator.share) {
                // Use Web Share API if available
                navigator.share({
                    title: title,
                    url: url
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(url).then(function() {
                    // Show some feedback
                    const originalIcon = btn.querySelector('i');
                    if (originalIcon) {
                        originalIcon.classList.remove('fa-share-nodes');
                        originalIcon.classList.add('fa-check');
                        setTimeout(() => {
                            originalIcon.classList.remove('fa-check');
                            originalIcon.classList.add('fa-share-nodes');
                        }, 2000);
                    }
                });
            }
        });
    });
});

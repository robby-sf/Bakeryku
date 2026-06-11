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
            minusBtn.addEventListener('click', function(e) {
                e.preventDefault();
                let value = parseInt(input.value) || 1;
                if (value > 1) {
                    value--;
                    input.value = value;
                    const orderQty = document.getElementById('order-quantity');
                    if (orderQty) {
                        orderQty.value = value;
                    }
                }
            });
            
            plusBtn.addEventListener('click', function(e) {
                e.preventDefault();
                let value = parseInt(input.value) || 1;
                value++;
                input.value = value;
                const orderQty = document.getElementById('order-quantity');
                if (orderQty) {
                    orderQty.value = value;
                }
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
                }).catch(err => {
                    copyFallback(url, btn);
                });
            } else {
                copyFallback(url, btn);
            }
        });
    });

    function copyFallback(text, btn) {
        let copyPromise;
        if (navigator.clipboard && window.isSecureContext) {
            copyPromise = navigator.clipboard.writeText(text);
        } else {
            // Fallback for non-secure HTTP contexts
            const textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.position = "fixed";
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.opacity = "0";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                const successful = document.execCommand('copy');
                document.body.removeChild(textArea);
                copyPromise = successful ? Promise.resolve() : Promise.reject("Copy command failed");
            } catch (err) {
                document.body.removeChild(textArea);
                copyPromise = Promise.reject(err);
            }
        }

        if (copyPromise) {
            copyPromise.then(function() {
                // Show feedback icon
                const originalIcon = btn.querySelector('i');
                if (originalIcon) {
                    originalIcon.classList.remove('fa-share-nodes');
                    originalIcon.classList.add('fa-check', 'text-green-500');
                    btn.classList.add('border-green-500');
                    setTimeout(() => {
                        originalIcon.classList.remove('fa-check', 'text-green-500');
                        originalIcon.classList.add('fa-share-nodes');
                        btn.classList.remove('border-green-500');
                    }, 2000);
                }

                // Show toast notification
                showToast("Link sudah disalin!");
            }).catch(function(err) {
                console.error("Gagal menyalin link: ", err);
            });
        }
    }

    function showToast(message) {
        // Remove existing toast if present
        const existingToast = document.getElementById('share-toast');
        if (existingToast) {
            existingToast.remove();
        }

        // Create toast element
        const toast = document.createElement('div');
        toast.id = 'share-toast';
        
        // Premium styling (fixed top center, brand brown bg, gold border, shadow)
        toast.className = 'fixed top-6 left-1/2 -translate-x-1/2 z-50 bg-[#4A2B1D] text-[#FFFDFB] px-6 py-3 rounded-full shadow-2xl flex items-center gap-2.5 text-sm font-semibold transition-all duration-500 ease-out opacity-0 -translate-y-4 border border-[#C28C62]/20 backdrop-blur-md';
        
        toast.innerHTML = `
            <i class="fa-solid fa-circle-check text-green-400"></i>
            <span>${message}</span>
        `;

        document.body.appendChild(toast);

        // Force reflow
        toast.offsetHeight;

        // Animate in
        toast.classList.remove('opacity-0', '-translate-y-4');
        toast.classList.add('opacity-100', 'translate-y-0');

        // Auto remove after 2.5 seconds
        setTimeout(() => {
            toast.classList.remove('opacity-100', 'translate-y-0');
            toast.classList.add('opacity-0', '-translate-y-4');
            setTimeout(() => {
                toast.remove();
            }, 500);
        }, 2500);
    }
});

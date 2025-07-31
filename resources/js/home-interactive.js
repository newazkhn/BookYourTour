/**
 * Home Screen Interactive Features
 * Implements smooth scrolling, lazy loading, modals, and animations
 */

class HomeInteractive {
    constructor() {
        this.init();
    }

    init() {
        this.setupSmoothScrolling();
        this.setupLazyLoading();
        this.setupDestinationModal();
        this.setupAnimations();
        this.setupBackToTop();
        this.setupImageGallery();
    }

    /**
     * 1. Implement smooth scrolling between sections
     */
    setupSmoothScrolling() {
        // Handle all anchor links with smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = anchor.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    const headerOffset = 80; // Account for fixed header
                    const elementPosition = targetElement.offsetTop;
                    const offsetPosition = elementPosition - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Smooth scroll to section function for buttons
        window.scrollToSection = (sectionId) => {
            const element = document.getElementById(sectionId);
            if (element) {
                const headerOffset = 80;
                const elementPosition = element.offsetTop;
                const offsetPosition = elementPosition - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        };
    }

    /**
     * 2. Add image lazy loading for better performance
     */
    setupLazyLoading() {
        // Create intersection observer for lazy loading
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    
                    // Load the image
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    
                    // Add fade-in animation
                    img.classList.add('fade-in');
                    
                    // Stop observing this image
                    observer.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.1
        });

        // Observe all images with data-src attribute
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });

        // Convert existing images to lazy loading
        document.querySelectorAll('img[src]:not([data-src])').forEach(img => {
            if (img.src && !img.complete) {
                const src = img.src;
                img.dataset.src = src;
                img.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMjAiIGZpbGw9IiNmM2Y0ZjYiLz4KPHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEwIDEwTDEwIDEwWiIgc3Ryb2tlPSIjOWNhM2FmIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPgo8L3N2Zz4KPC9zdmc+';
                imageObserver.observe(img);
            }
        });

        // Add loading animation styles
        const style = document.createElement('style');
        style.textContent = `
            .fade-in {
                animation: fadeIn 0.5s ease-in-out;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            .loading-placeholder {
                background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
                background-size: 200% 100%;
                animation: loading 1.5s infinite;
            }
            
            @keyframes loading {
                0% { background-position: 200% 0; }
                100% { background-position: -200% 0; }
            }
        `;
        document.head.appendChild(style);
    }

    /**
     * 3. Create modal functionality for quick destination previews
     */
    setupDestinationModal() {
        // Create modal HTML if it doesn't exist
        if (!document.getElementById('destinationPreviewModal')) {
            const modalHTML = `
                <div id="destinationPreviewModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
                    <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden transform transition-all duration-300 scale-95" id="previewModalContent">
                        <!-- Modal Header -->
                        <div class="flex justify-between items-center p-6 border-b border-gray-200">
                            <h3 class="text-2xl font-bold text-gray-900" id="previewModalTitle">Destination Preview</h3>
                            <button onclick="closeDestinationPreview()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 rounded-full hover:bg-gray-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Modal Body -->
                        <div class="overflow-y-auto max-h-[calc(90vh-120px)]" id="previewModalBody">
                            <div class="p-6">
                                <div class="animate-pulse">
                                    <div class="h-64 bg-gray-300 rounded-lg mb-4"></div>
                                    <div class="h-4 bg-gray-300 rounded w-3/4 mb-2"></div>
                                    <div class="h-4 bg-gray-300 rounded w-1/2"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="p-6 border-t border-gray-200 bg-gray-50">
                            <div class="flex space-x-3 justify-end">
                                <button onclick="closeDestinationPreview()" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                    Close
                                </button>
                                <button id="previewBookButton" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    Book Now
                                </button>
                                <a id="previewDetailsButton" href="#" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', modalHTML);
        }

        // Add preview buttons to destination cards
        document.querySelectorAll('.destination-card, [class*="destination"]').forEach(card => {
            // Add quick preview button if it doesn't exist
            if (!card.querySelector('.quick-preview-btn')) {
                const previewBtn = document.createElement('button');
                previewBtn.className = 'quick-preview-btn absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-gray-700 p-2 rounded-full hover:bg-white transition-all duration-200 opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0';
                previewBtn.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                `;
                previewBtn.title = 'Quick Preview';
                
                // Find destination data
                const destinationName = card.querySelector('h3')?.textContent || 'Unknown';
                const destinationId = card.querySelector('a[href*="destinations"]')?.href?.split('/').pop() || '1';
                
                previewBtn.onclick = (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    this.openDestinationPreview(destinationId, destinationName);
                };
                
                // Add to card if it has relative positioning
                const imageContainer = card.querySelector('.relative');
                if (imageContainer) {
                    imageContainer.appendChild(previewBtn);
                }
            }
        });

        // Global functions for modal control
        window.openDestinationPreview = (destinationId, destinationName) => {
            this.openDestinationPreview(destinationId, destinationName);
        };

        window.closeDestinationPreview = () => {
            this.closeDestinationPreview();
        };
    }

    openDestinationPreview(destinationId, destinationName) {
        const modal = document.getElementById('destinationPreviewModal');
        const modalContent = document.getElementById('previewModalContent');
        const modalTitle = document.getElementById('previewModalTitle');
        const modalBody = document.getElementById('previewModalBody');
        const bookButton = document.getElementById('previewBookButton');
        const detailsButton = document.getElementById('previewDetailsButton');

        modalTitle.textContent = destinationName;
        
        // Show modal with animation
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);

        // Load destination preview content
        this.loadDestinationPreview(destinationId, modalBody);

        // Set up action buttons
        bookButton.onclick = () => {
            window.location.href = `/destinations/${destinationId}#booking`;
        };
        
        detailsButton.href = `/destinations/${destinationId}`;
    }

    closeDestinationPreview() {
        const modal = document.getElementById('destinationPreviewModal');
        const modalContent = document.getElementById('previewModalContent');
        
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    loadDestinationPreview(destinationId, container) {
        // Simulate loading destination data
        container.innerHTML = `
            <div class="space-y-6">
                <!-- Image Gallery -->
                <div class="relative h-64 bg-gray-200 rounded-lg overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=400&fit=crop&crop=center" 
                         alt="Destination" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
                
                <!-- Destination Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-lg font-semibold mb-2">About This Destination</h4>
                        <p class="text-gray-600 mb-4">Experience the beauty and culture of this amazing destination. Perfect for travelers seeking adventure and relaxation.</p>
                        
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                Location: Various Locations
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Duration: 3-7 days
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                                Group Size: 2-15 people
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-2">What's Included</h4>
                        <ul class="space-y-1 text-sm text-gray-600">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Professional tour guide
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Transportation
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Meals as specified
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Accommodation
                            </li>
                        </ul>
                        
                        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Starting from</span>
                                <span class="text-2xl font-bold text-blue-600">$299</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    /**
     * 4. Add animation effects using CSS transitions and transforms
     */
    setupAnimations() {
        // Add scroll-triggered animations
        const animationObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Observe elements for animation
        document.querySelectorAll('.destination-card, .testimonial-card, section').forEach(el => {
            el.classList.add('animate-on-scroll');
            animationObserver.observe(el);
        });

        // Add hover animations to cards
        document.querySelectorAll('[class*="card"], [class*="destination"]').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-8px) scale(1.02)';
                card.style.boxShadow = '0 20px 40px rgba(0,0,0,0.15)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
                card.style.boxShadow = '';
            });
        });

        // Add animation styles
        const animationStyles = document.createElement('style');
        animationStyles.textContent = `
            .animate-on-scroll {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.6s ease-out;
            }
            
            .animate-in {
                opacity: 1;
                transform: translateY(0);
            }
            
            .stagger-animation:nth-child(1) { transition-delay: 0.1s; }
            .stagger-animation:nth-child(2) { transition-delay: 0.2s; }
            .stagger-animation:nth-child(3) { transition-delay: 0.3s; }
            .stagger-animation:nth-child(4) { transition-delay: 0.4s; }
            .stagger-animation:nth-child(5) { transition-delay: 0.5s; }
            .stagger-animation:nth-child(6) { transition-delay: 0.6s; }
            
            .hover-lift {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .hover-lift:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            }
            
            .pulse-animation {
                animation: pulse 2s infinite;
            }
            
            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.7; }
            }
            
            .slide-up {
                animation: slideUp 0.6s ease-out;
            }
            
            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(animationStyles);
    }

    /**
     * Enhanced back to top functionality
     */
    setupBackToTop() {
        let backToTopBtn = document.getElementById('backToTop');
        
        // Create back to top button if it doesn't exist
        if (!backToTopBtn) {
            backToTopBtn = document.createElement('button');
            backToTopBtn.id = 'backToTop';
            backToTopBtn.className = 'fixed bottom-8 right-8 z-40 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white p-4 rounded-full shadow-2xl transition-all duration-500 opacity-0 pointer-events-none transform translate-y-2 hover:scale-110 hover:shadow-blue-500/25 group';
            backToTopBtn.innerHTML = `
                <svg class="w-6 h-6 transition-transform duration-300 group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
                <div class="absolute inset-0 rounded-full bg-blue-600 animate-ping opacity-20"></div>
            `;
            backToTopBtn.title = 'Back to Top';
            document.body.appendChild(backToTopBtn);
        }

        // Enhanced scroll behavior
        let scrollTimeout;
        window.addEventListener('scroll', () => {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                if (window.scrollY > 400) {
                    backToTopBtn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-2');
                    backToTopBtn.classList.add('opacity-100', 'translate-y-0');
                } else {
                    backToTopBtn.classList.remove('opacity-100', 'translate-y-0');
                    backToTopBtn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
                }
            }, 10);
        });

        // Smooth scroll to top
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Global function
        window.scrollToTop = () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };
    }

    /**
     * Setup image gallery functionality
     */
    setupImageGallery() {
        // Add click handlers to destination images for gallery view
        document.querySelectorAll('img[src*="storage"], img[src*="unsplash"]').forEach(img => {
            img.style.cursor = 'pointer';
            img.addEventListener('click', (e) => {
                if (!e.target.closest('.modal')) {
                    this.openImageGallery(img.src, img.alt);
                }
            });
        });
    }

    openImageGallery(imageSrc, imageAlt) {
        // Create gallery modal if it doesn't exist
        if (!document.getElementById('imageGalleryModal')) {
            const galleryHTML = `
                <div id="imageGalleryModal" class="fixed inset-0 bg-black/90 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
                    <div class="relative max-w-4xl w-full">
                        <button onclick="closeImageGallery()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10 p-2 rounded-full bg-black/50 backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <img id="galleryImage" src="" alt="" class="w-full h-auto max-h-[80vh] object-contain rounded-lg">
                        <div class="text-center mt-4">
                            <p id="galleryCaption" class="text-white text-lg"></p>
                        </div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', galleryHTML);
        }

        const modal = document.getElementById('imageGalleryModal');
        const image = document.getElementById('galleryImage');
        const caption = document.getElementById('galleryCaption');

        image.src = imageSrc;
        image.alt = imageAlt;
        caption.textContent = imageAlt;

        modal.classList.remove('hidden');

        // Close on click outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                this.closeImageGallery();
            }
        });

        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeImageGallery();
            }
        });

        window.closeImageGallery = () => {
            this.closeImageGallery();
        };
    }

    closeImageGallery() {
        const modal = document.getElementById('imageGalleryModal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new HomeInteractive();
});

// Export for potential use in other scripts
window.HomeInteractive = HomeInteractive;
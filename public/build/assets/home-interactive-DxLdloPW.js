class l{constructor(){this.init()}init(){this.setupSmoothScrolling(),this.setupLazyLoading(),this.setupDestinationModal(),this.setupAnimations(),this.setupBackToTop(),this.setupImageGallery()}setupSmoothScrolling(){document.querySelectorAll('a[href^="#"]').forEach(e=>{e.addEventListener("click",t=>{t.preventDefault();const o=e.getAttribute("href").substring(1),s=document.getElementById(o);if(s){const i=s.offsetTop-80;window.scrollTo({top:i,behavior:"smooth"})}})}),window.scrollToSection=e=>{const t=document.getElementById(e);if(t){const a=t.offsetTop-80;window.scrollTo({top:a,behavior:"smooth"})}}}setupLazyLoading(){const e=new IntersectionObserver((o,s)=>{o.forEach(a=>{if(a.isIntersecting){const n=a.target;n.dataset.src&&(n.src=n.dataset.src,n.removeAttribute("data-src")),n.classList.add("fade-in"),s.unobserve(n)}})},{rootMargin:"50px 0px",threshold:.1});document.querySelectorAll("img[data-src]").forEach(o=>{e.observe(o)}),document.querySelectorAll("img[src]:not([data-src])").forEach(o=>{if(o.src&&!o.complete){const s=o.src;o.dataset.src=s,o.src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMjAiIGZpbGw9IiNmM2Y0ZjYiLz4KPHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEwIDEwTDEwIDEwWiIgc3Ryb2tlPSIjOWNhM2FmIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPgo8L3N2Zz4KPC9zdmc+",e.observe(o)}});const t=document.createElement("style");t.textContent=`
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
        `,document.head.appendChild(t)}setupDestinationModal(){document.getElementById("destinationPreviewModal")||document.body.insertAdjacentHTML("beforeend",`
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
            `),document.querySelectorAll('.destination-card, [class*="destination"]').forEach(e=>{if(!e.querySelector(".quick-preview-btn")){const t=document.createElement("button");t.className="quick-preview-btn absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-gray-700 p-2 rounded-full hover:bg-white transition-all duration-200 opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0",t.innerHTML=`
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                `,t.title="Quick Preview";const o=e.querySelector("h3")?.textContent||"Unknown",s=e.querySelector('a[href*="destinations"]')?.href?.split("/").pop()||"1";t.onclick=n=>{n.preventDefault(),n.stopPropagation(),this.openDestinationPreview(s,o)};const a=e.querySelector(".relative");a&&a.appendChild(t)}}),window.openDestinationPreview=(e,t)=>{this.openDestinationPreview(e,t)},window.closeDestinationPreview=()=>{this.closeDestinationPreview()}}openDestinationPreview(e,t){const o=document.getElementById("destinationPreviewModal"),s=document.getElementById("previewModalContent"),a=document.getElementById("previewModalTitle"),n=document.getElementById("previewModalBody"),i=document.getElementById("previewBookButton"),r=document.getElementById("previewDetailsButton");a.textContent=t,o.classList.remove("hidden"),setTimeout(()=>{s.classList.remove("scale-95"),s.classList.add("scale-100")},10),this.loadDestinationPreview(e,n),i.onclick=()=>{window.location.href=`/destinations/${e}#booking`},r.href=`/destinations/${e}`}closeDestinationPreview(){const e=document.getElementById("destinationPreviewModal"),t=document.getElementById("previewModalContent");t.classList.remove("scale-100"),t.classList.add("scale-95"),setTimeout(()=>{e.classList.add("hidden")},300)}loadDestinationPreview(e,t){t.innerHTML=`
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
        `}setupAnimations(){const e=new IntersectionObserver(o=>{o.forEach(s=>{s.isIntersecting&&s.target.classList.add("animate-in")})},{threshold:.1,rootMargin:"0px 0px -50px 0px"});document.querySelectorAll(".destination-card, .testimonial-card, section").forEach(o=>{o.classList.add("animate-on-scroll"),e.observe(o)}),document.querySelectorAll('[class*="card"], [class*="destination"]').forEach(o=>{o.addEventListener("mouseenter",()=>{o.style.transform="translateY(-8px) scale(1.02)",o.style.boxShadow="0 20px 40px rgba(0,0,0,0.15)"}),o.addEventListener("mouseleave",()=>{o.style.transform="translateY(0) scale(1)",o.style.boxShadow=""})});const t=document.createElement("style");t.textContent=`
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
        `,document.head.appendChild(t)}setupBackToTop(){let e=document.getElementById("backToTop");e||(e=document.createElement("button"),e.id="backToTop",e.className="fixed bottom-8 right-8 z-40 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white p-4 rounded-full shadow-2xl transition-all duration-500 opacity-0 pointer-events-none transform translate-y-2 hover:scale-110 hover:shadow-blue-500/25 group",e.innerHTML=`
                <svg class="w-6 h-6 transition-transform duration-300 group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
                <div class="absolute inset-0 rounded-full bg-blue-600 animate-ping opacity-20"></div>
            `,e.title="Back to Top",document.body.appendChild(e));let t;window.addEventListener("scroll",()=>{clearTimeout(t),t=setTimeout(()=>{window.scrollY>400?(e.classList.remove("opacity-0","pointer-events-none","translate-y-2"),e.classList.add("opacity-100","translate-y-0")):(e.classList.remove("opacity-100","translate-y-0"),e.classList.add("opacity-0","pointer-events-none","translate-y-2"))},10)}),e.addEventListener("click",()=>{window.scrollTo({top:0,behavior:"smooth"})}),window.scrollToTop=()=>{window.scrollTo({top:0,behavior:"smooth"})}}setupImageGallery(){document.querySelectorAll('img[src*="storage"], img[src*="unsplash"]').forEach(e=>{e.style.cursor="pointer",e.addEventListener("click",t=>{t.target.closest(".modal")||this.openImageGallery(e.src,e.alt)})})}openImageGallery(e,t){document.getElementById("imageGalleryModal")||document.body.insertAdjacentHTML("beforeend",`
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
            `);const o=document.getElementById("imageGalleryModal"),s=document.getElementById("galleryImage"),a=document.getElementById("galleryCaption");s.src=e,s.alt=t,a.textContent=t,o.classList.remove("hidden"),o.addEventListener("click",n=>{n.target===o&&this.closeImageGallery()}),document.addEventListener("keydown",n=>{n.key==="Escape"&&this.closeImageGallery()}),window.closeImageGallery=()=>{this.closeImageGallery()}}closeImageGallery(){const e=document.getElementById("imageGalleryModal");e&&e.classList.add("hidden")}}document.addEventListener("DOMContentLoaded",()=>{new l});window.HomeInteractive=l;

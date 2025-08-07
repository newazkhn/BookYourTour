@extends('layouts.admin')

@section('page-title', 'Edit Destination')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Edit Destination</h1>
            <p class="mt-1 text-sm text-slate-600">Update the details for {{ $destination->name }}</p>
        </div>
        <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-300 shadow-sm text-sm font-medium rounded-md text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Destinations
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-sm rounded-lg">
        <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="px-6 py-4 border-b border-slate-200">
                <h3 class="text-lg font-medium text-slate-900">Destination Information</h3>
                <p class="mt-1 text-sm text-slate-600">Update the details for your destination</p>
            </div>

            <div class="px-6 pb-6 space-y-6">
                <!-- Upload Error Display -->
                @error('upload')
                    <div class="bg-red-50 border border-red-200 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Upload Error</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <p>{{ $message }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @enderror
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Destination Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $destination->name) }}" required
                               class="block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-slate-700 mb-2">Location *</label>
                        <input type="text" name="location" id="location" value="{{ old('location', $destination->location) }}" required
                               class="block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('location') border-red-300 @enderror">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Description *</label>
                    <div class="@error('description') border-red-300 @enderror">
                        <!-- Quill Editor Container -->
                        <div id="quill-editor" style="height: 200px;" class="bg-white border border-slate-300 rounded-md"></div>
                        <!-- Hidden textarea for form submission -->
                        <textarea name="description" id="description" required class="hidden">{{ old('description', $destination->description) }}</textarea>
                    </div>
                    <p class="mt-1 text-xs text-slate-500">Use the editor above to format your destination description with rich text, lists, and links.</p>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Main Image Upload -->
                <div>
                    <label for="image" class="block text-sm font-medium text-slate-700 mb-2">Main Destination Image *</label>
                    
                    @if($destination->image)
                        <div class="mb-4">
                            <p class="text-sm text-slate-600 mb-2">Current image:</p>
                            <div class="w-32 h-24 rounded-lg overflow-hidden border border-slate-200">
                                <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->name }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    @endif

                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-md hover:border-slate-400 transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex text-sm text-slate-600">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>{{ $destination->image ? 'Replace main image' : 'Upload main image' }}</span>
                                    <input id="image" name="image" type="file" accept="image/jpeg,image/jpg,image/png,image/webp" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-slate-500">PNG, JPG, WEBP up to 10MB</p>
                        </div>
                    </div>
                    <div id="main-image-preview" class="mt-3 hidden">
                        <img id="main-preview-img" class="h-32 w-32 object-cover rounded-lg border border-slate-300" alt="Preview">
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gallery Images Upload -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Gallery Images *</label>
                    <p class="text-sm text-slate-500 mb-3">Manage gallery images for your destination (minimum 3 images required)</p>
                    
                    <!-- Gallery Container -->
                    <div id="gallery-container" class="space-y-4">
                        <!-- Gallery Images Grid -->
                        <div id="gallery-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <!-- Existing Gallery Images -->
                            @php
                                $existingGallery = [];
                                if ($destination->gallery) {
                                    $existingGallery = is_string($destination->gallery) ? json_decode($destination->gallery, true) : $destination->gallery;
                                    $existingGallery = $existingGallery ?? [];
                                }
                            @endphp
                            
                            @foreach($existingGallery as $index => $imagePath)
                                <div class="relative group existing-image" data-index="{{ $index }}" data-path="{{ $imagePath }}">
                                    <div class="aspect-square relative overflow-hidden rounded-lg border border-slate-300">
                                        <img src="{{ asset('storage/' . $imagePath) }}" class="w-full h-full object-cover" alt="Gallery image {{ $index + 1 }}">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-200 flex items-center justify-center">
                                            <button type="button" onclick="removeExistingImage({{ $index }})" class="opacity-0 group-hover:opacity-100 bg-red-500 hover:bg-red-600 text-white rounded-full p-2 transition-all duration-200 transform scale-90 hover:scale-100">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="absolute top-2 left-2 bg-blue-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                                            {{ $index + 1 }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            <!-- Add New Image Button -->
                            <div id="add-image-btn" class="relative group cursor-pointer">
                                <div class="aspect-square border-2 border-dashed border-slate-300 rounded-lg flex flex-col items-center justify-center hover:border-slate-400 transition-colors bg-slate-50 hover:bg-slate-100">
                                    <svg class="w-8 h-8 text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span class="text-sm text-slate-500 font-medium">Add Image</span>
                                    <span class="text-xs text-slate-400 mt-1">PNG, JPG, WEBP</span>
                                </div>
                                <input type="file" class="gallery-input sr-only" accept="image/jpeg,image/jpg,image/png,image/webp">
                            </div>
                        </div>
                        
                        <!-- Gallery Counter -->
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-600">
                                Images: <span id="image-count" class="font-medium text-blue-600">{{ count($existingGallery) }}</span> / 10
                            </span>
                            <span class="text-slate-500">
                                Minimum 3 images required
                            </span>
                        </div>
                    </div>
                    
                    <!-- Hidden inputs for form submission -->
                    <div id="hidden-inputs">
                        <!-- Hidden inputs for existing images to keep -->
                        @foreach($existingGallery as $index => $imagePath)
                            <input type="hidden" name="existing_gallery[]" value="{{ $imagePath }}" data-index="{{ $index }}">
                        @endforeach
                    </div>
                    
                    @error('gallery')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('gallery.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pricing and Details -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Price From -->
                    <div>
                        <label for="price_from" class="block text-sm font-medium text-slate-700 mb-2">Price From ($) *</label>
                        <input type="number" name="price_from" id="price_from" value="{{ old('price_from', $destination->price_from) }}" step="0.01" min="0" required
                               class="block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('price_from') border-red-300 @enderror"
                               placeholder="Enter starting price">
                        @error('price_from')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rating -->
                    <div>
                        <label for="rating" class="block text-sm font-medium text-slate-700 mb-2">Rating (1-5) *</label>
                        <select name="rating" id="rating" required
                                class="block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('rating') border-red-300 @enderror">
                            <option value="">Select rating</option>
                            <option value="1" {{ old('rating', $destination->rating) == '1' ? 'selected' : '' }}>1 Star</option>
                            <option value="2" {{ old('rating', $destination->rating) == '2' ? 'selected' : '' }}>2 Stars</option>
                            <option value="3" {{ old('rating', $destination->rating) == '3' ? 'selected' : '' }}>3 Stars</option>
                            <option value="4" {{ old('rating', $destination->rating) == '4' ? 'selected' : '' }}>4 Stars</option>
                            <option value="5" {{ old('rating', $destination->rating) == '5' ? 'selected' : '' }}>5 Stars</option>
                        </select>
                        @error('rating')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration" class="block text-sm font-medium text-slate-700 mb-2">Duration *</label>
                        <input type="text" name="duration" id="duration" value="{{ old('duration', $destination->duration) }}" placeholder="e.g., 7 days" required
                               class="block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('duration') border-red-300 @enderror">
                        @error('duration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Featured -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Featured Destination</label>
                    <div class="flex items-center">
                        <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $destination->featured) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                        <label for="featured" class="ml-2 block text-sm text-slate-700">
                            Mark as featured destination
                        </label>
                    </div>
                    <p class="mt-1 text-xs text-slate-500">Featured destinations appear prominently on the homepage</p>
                </div>



                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-slate-200">
                    <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-300 shadow-sm text-sm font-medium rounded-md text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Update Destination
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Main image preview functionality
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('main-image-preview');
    const previewImg = document.getElementById('main-preview-img');
    
    if (file) {
        // Validate file size (10MB)
        if (file.size > 10 * 1024 * 1024) {
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
            alert(`File size (${fileSizeMB}MB) exceeds the 10MB limit. Please choose a smaller image or compress it.`);
            e.target.value = ''; // Clear the input
            preview.classList.add('hidden');
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
    }
});

// Gallery functionality for edit form
let galleryImages = [];
let imageCounter = {{ count($existingGallery) }};
let existingImages = @json($existingGallery);

function updateImageCounter() {
    const totalImages = document.querySelectorAll('#gallery-grid > div:not(#add-image-btn)').length;
    document.getElementById('image-count').textContent = totalImages;
    
    // Show/hide add button based on limit
    const addBtn = document.getElementById('add-image-btn');
    if (totalImages >= 10) {
        addBtn.style.display = 'none';
    } else {
        addBtn.style.display = 'block';
    }
}

function createImagePreview(file, index) {
    const reader = new FileReader();
    reader.onload = function(e) {
        const imageDiv = document.createElement('div');
        imageDiv.className = 'relative group new-image';
        imageDiv.dataset.index = index;
        
        imageDiv.innerHTML = `
            <div class="aspect-square relative overflow-hidden rounded-lg border border-slate-300">
                <img src="${e.target.result}" class="w-full h-full object-cover" alt="Gallery image ${index + 1}">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-200 flex items-center justify-center">
                    <button type="button" onclick="removeNewImage(${index})" class="opacity-0 group-hover:opacity-100 bg-red-500 hover:bg-red-600 text-white rounded-full p-2 transition-all duration-200 transform scale-90 hover:scale-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
                <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                    New
                </div>
            </div>
        `;
        
        // Insert before the add button
        const addBtn = document.getElementById('add-image-btn');
        addBtn.parentNode.insertBefore(imageDiv, addBtn);
    };
    reader.readAsDataURL(file);
}

function removeExistingImage(index) {
    // Remove from DOM
    const imageDiv = document.querySelector(`.existing-image[data-index="${index}"]`);
    if (imageDiv) {
        imageDiv.remove();
    }
    
    // Remove the hidden input for this existing image
    const hiddenInput = document.querySelector(`input[name="existing_gallery[]"][data-index="${index}"]`);
    if (hiddenInput) {
        hiddenInput.remove();
    }
    
    updateImageCounter();
}

function removeNewImage(index) {
    // Remove from array
    galleryImages = galleryImages.filter((_, i) => i !== index);
    
    // Remove from DOM
    const imageDiv = document.querySelector(`.new-image[data-index="${index}"]`);
    if (imageDiv) {
        imageDiv.remove();
    }
    
    updateImageCounter();
    updateHiddenInputs();
    reindexNewImages();
}

function reindexNewImages() {
    const newImageDivs = document.querySelectorAll('.new-image');
    newImageDivs.forEach((div, newIndex) => {
        div.dataset.index = newIndex;
        
        // Update the remove button onclick
        const removeBtn = div.querySelector('button[onclick]');
        if (removeBtn) {
            removeBtn.setAttribute('onclick', `removeNewImage(${newIndex})`);
        }
    });
}

function updateHiddenInputs() {
    // Remove existing new image inputs
    const existingNewInputs = document.querySelectorAll('input[name="gallery[]"]');
    existingNewInputs.forEach(input => input.remove());
    
    const hiddenInputsContainer = document.getElementById('hidden-inputs');
    
    galleryImages.forEach((file, index) => {
        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'gallery[]';
        input.style.display = 'none';
        
        // Create a new FileList with just this file
        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        
        hiddenInputsContainer.appendChild(input);
    });
}

// Handle add image button click
document.getElementById('add-image-btn').addEventListener('click', function() {
    const totalImages = document.querySelectorAll('#gallery-grid > div:not(#add-image-btn)').length;
    if (totalImages >= 10) {
        alert('Maximum 10 images allowed');
        return;
    }
    
    this.querySelector('input').click();
});

// Handle file selection
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('gallery-input')) {
        const file = e.target.files[0];
        if (file) {
            const totalImages = document.querySelectorAll('#gallery-grid > div:not(#add-image-btn)').length;
            if (totalImages >= 10) {
                alert('Maximum 10 images allowed');
                return;
            }
            
            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                alert('Please select a valid image file (JPG, PNG, WEBP)');
                return;
            }
            
            // Validate file size (10MB)
            if (file.size > 10 * 1024 * 1024) {
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                alert(`File size (${fileSizeMB}MB) exceeds the 10MB limit. Please choose a smaller image or compress it.`);
                return;
            }
            
            galleryImages.push(file);
            createImagePreview(file, galleryImages.length - 1);
            updateImageCounter();
            updateHiddenInputs();
        }
        
        // Reset the input
        e.target.value = '';
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const totalImages = document.querySelectorAll('#gallery-grid > div:not(#add-image-btn)').length;
    if (totalImages < 3) {
        e.preventDefault();
        alert('Please ensure you have at least 3 gallery images.');
        document.getElementById('add-image-btn').scrollIntoView({ behavior: 'smooth' });
        return false;
    }
});

// Initialize
updateImageCounter();
</script>

<!-- Quill.js Editor -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
// Initialize Quill editor
var quill = new Quill('#quill-editor', {
    theme: 'snow',
    placeholder: 'Describe what makes this destination special...',
    modules: {
        toolbar: [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],
            [{ 'align': [] }],
            ['link'],
            ['clean']
        ]
    }
});

// Sync Quill content with hidden textarea
var descriptionTextarea = document.querySelector('#description');

// Update textarea on any content change
quill.on('text-change', function() {
    var html = quill.root.innerHTML;
    // Clean up empty paragraphs and ensure we have content
    if (html === '<p><br></p>' || html === '<p></p>') {
        html = '';
    }
    descriptionTextarea.value = html;
});

// Also update on selection change (for formatting)
quill.on('selection-change', function() {
    var html = quill.root.innerHTML;
    if (html === '<p><br></p>' || html === '<p></p>') {
        html = '';
    }
    descriptionTextarea.value = html;
});

// Set initial content if editing
if (descriptionTextarea.value) {
    quill.root.innerHTML = descriptionTextarea.value;
}

// Ensure content is saved before form submission
document.querySelector('form').addEventListener('submit', function() {
    var html = quill.root.innerHTML;
    if (html === '<p><br></p>' || html === '<p></p>') {
        html = '';
    }
    descriptionTextarea.value = html;
});
</script>
@endsection
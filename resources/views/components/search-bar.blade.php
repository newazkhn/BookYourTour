<!-- Search Bar Component -->
<div class="relative max-w-2xl mx-auto" x-data="searchComponent()">
    <form action="{{ route('destinations.index') }}" method="GET" class="relative">
        <div class="flex flex-col md:flex-row gap-4 bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
            <!-- Search Input -->
            <div class="flex-1 relative">
                <input type="text" 
                       name="search" 
                       x-model="searchQuery"
                       @input="handleSearch"
                       @focus="showSuggestions = true"
                       @blur="hideSuggestions"
                       placeholder="Where do you want to go?" 
                       class="w-full px-6 py-4 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition-all duration-300 text-base md:text-lg"
                       value="{{ request('search') }}"
                       autocomplete="off">
                
                <!-- Search Icon -->
                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                    <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- Suggestions Dropdown -->
                <div x-show="showSuggestions && (suggestions.length > 0 || isLoading || searchQuery.length > 0)" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 max-h-80 overflow-y-auto">
                    
                    <!-- Loading State -->
                    <div x-show="isLoading" class="p-4 text-center text-gray-500">
                        <div class="inline-flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Searching...
                        </div>
                    </div>

                    <!-- Suggestions List -->
                    <template x-for="(suggestion, index) in suggestions" :key="suggestion.id">
                        <a :href="'/destinations/' + suggestion.id" 
                           class="block px-4 py-3 hover:bg-gray-50 transition-colors duration-150 border-b border-gray-100 last:border-b-0">
                            <div class="flex items-center space-x-3">
                                <img :src="suggestion.image_url" 
                                     :alt="suggestion.name"
                                     class="w-12 h-12 object-cover rounded-lg">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900" x-text="suggestion.name"></h4>
                                    <p class="text-sm text-gray-600" x-text="suggestion.location"></p>
                                    <p class="text-xs text-gray-500 mt-1" x-text="suggestion.description.substring(0, 60) + '...'"></p>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-semibold text-blue-600" x-text="'$' + suggestion.price_from"></span>
                                </div>
                            </div>
                        </a>
                    </template>

                    <!-- No Results -->
                    <div x-show="!isLoading && suggestions.length === 0 && searchQuery.length > 0" 
                         class="p-4 text-center text-gray-500">
                        <div class="mb-2">
                            <svg class="w-8 h-8 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <p class="font-medium">No destinations found</p>
                        <p class="text-sm mt-1">Try searching for "beach", "mountain", or "city"</p>
                        
                        <!-- Popular Suggestions -->
                        <div class="mt-3 pt-3 border-t border-gray-200">
                            <p class="text-xs font-medium text-gray-700 mb-2">Popular destinations:</p>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="popular in popularDestinations">
                                    <button @click="selectSuggestion(popular)" 
                                            class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs hover:bg-blue-200 transition-colors"
                                            x-text="popular"></button>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Search Button -->
            <button type="submit" 
                    class="px-8 py-4 bg-gradient-to-r from-yellow-400 to-orange-500 hover:from-yellow-500 hover:to-orange-600 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 focus:ring-offset-transparent">
                <span class="hidden md:inline">Search Destinations</span>
                <span class="md:hidden">Search</span>
            </button>
        </div>
    </form>
</div>

<script>
function searchComponent() {
    return {
        searchQuery: '{{ request('search') }}',
        suggestions: [],
        showSuggestions: false,
        isLoading: false,
        debounceTimer: null,
        popularDestinations: ['Bali', 'Paris', 'Tokyo', 'New York', 'London'],

        handleSearch() {
            clearTimeout(this.debounceTimer);
            
            if (this.searchQuery.length < 2) {
                this.suggestions = [];
                return;
            }

            this.debounceTimer = setTimeout(() => {
                this.fetchSuggestions();
            }, 300);
        },

        async fetchSuggestions() {
            this.isLoading = true;
            
            try {
                const response = await fetch(`/api/search/suggestions?q=${encodeURIComponent(this.searchQuery)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                });
                
                if (response.ok) {
                    const data = await response.json();
                    this.suggestions = data.suggestions || [];
                } else {
                    this.suggestions = [];
                }
            } catch (error) {
                console.error('Search error:', error);
                this.suggestions = [];
            } finally {
                this.isLoading = false;
            }
        },

        selectSuggestion(suggestion) {
            this.searchQuery = suggestion;
            this.showSuggestions = false;
            // Trigger form submission
            this.$el.querySelector('form').submit();
        },

        hideSuggestions() {
            // Delay hiding to allow clicks on suggestions
            setTimeout(() => {
                this.showSuggestions = false;
            }, 200);
        }
    }
}
</script>

class SearchWidget {
    constructor() {
        this.searchInput = document.getElementById('searchInput');
        this.searchSuggestions = document.getElementById('searchSuggestions');
        this.searchTimeout = null;
        this.selectedIndex = -1;
        this.suggestions = [];
        
        this.init();
    }
    
    init() {
        if (!this.searchInput) return;
        
        this.searchInput.addEventListener('input', (e) => this.handleInput(e));
        this.searchInput.addEventListener('keydown', (e) => this.handleKeyDown(e));
        this.searchInput.addEventListener('focus', () => this.handleFocus());
        this.searchInput.addEventListener('blur', (e) => this.handleBlur(e));
        
        document.addEventListener('click', (e) => this.handleClickOutside(e));
    }
    
    handleInput(e) {
        clearTimeout(this.searchTimeout);
        const query = e.target.value.trim();
        
        if (query.length < 2) {
            this.hideSuggestions();
            return;
        }
        
        this.searchTimeout = setTimeout(() => {
            this.fetchSuggestions(query);
        }, 300);
    }
    
    handleKeyDown(e) {
        if (!this.searchSuggestions || this.searchSuggestions.style.display === 'none') {
            return;
        }
        
        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                this.navigateDown();
                break;
            case 'ArrowUp':
                e.preventDefault();
                this.navigateUp();
                break;
            case 'Enter':
                e.preventDefault();
                this.selectCurrent();
                break;
            case 'Escape':
                this.hideSuggestions();
                break;
        }
    }
    
    handleFocus() {
        if (this.suggestions.length > 0) {
            this.showSuggestions();
        }
    }
    
    handleBlur(e) {
        // Delay hiding to allow clicking on suggestions
        setTimeout(() => {
            if (!this.searchSuggestions.contains(document.activeElement)) {
                this.hideSuggestions();
            }
        }, 200);
    }
    
    handleClickOutside(e) {
        if (!this.searchInput.contains(e.target) && !this.searchSuggestions.contains(e.target)) {
            this.hideSuggestions();
        }
    }
    
    async fetchSuggestions(query) {
        try {
            const response = await fetch(`/search/ajax?q=${encodeURIComponent(query)}`);
            const data = await response.json();
            
            this.suggestions = data;
            this.selectedIndex = -1;
            this.renderSuggestions();
        } catch (error) {
            console.error('Search error:', error);
            this.hideSuggestions();
        }
    }
    
    renderSuggestions() {
        if (this.suggestions.length === 0) {
            this.hideSuggestions();
            return;
        }
        
        let html = '';
        this.suggestions.forEach((product, index) => {
            const isSelected = index === this.selectedIndex;
            html += `
                <div class="search-suggestion ${isSelected ? 'selected' : ''}" 
                     data-index="${index}" 
                     onclick="window.location.href='${product.url}'">
                    <img src="${product.image ? '/template/images/products/' + product.image : '/template/images/product-details/1.jpg'}" 
                         alt="${this.escapeHtml(product.name)}" 
                         onerror="this.src='/template/images/product-details/1.jpg'">
                    <div class="search-suggestion-info">
                        <div class="search-suggestion-name">${this.highlightQuery(product.name)}</div>
                        <div class="search-suggestion-price">$${product.price}</div>
                    </div>
                </div>
            `;
        });
        
        this.searchSuggestions.innerHTML = html;
        this.showSuggestions();
    }
    
    navigateDown() {
        if (this.selectedIndex < this.suggestions.length - 1) {
            this.selectedIndex++;
            this.updateSelection();
        }
    }
    
    navigateUp() {
        if (this.selectedIndex > 0) {
            this.selectedIndex--;
            this.updateSelection();
        }
    }
    
    updateSelection() {
        const suggestions = this.searchSuggestions.querySelectorAll('.search-suggestion');
        suggestions.forEach((suggestion, index) => {
            suggestion.classList.toggle('selected', index === this.selectedIndex);
        });
    }
    
    selectCurrent() {
        if (this.selectedIndex >= 0 && this.selectedIndex < this.suggestions.length) {
            window.location.href = this.suggestions[this.selectedIndex].url;
        } else {
            // Submit the search form
            this.searchInput.closest('form').submit();
        }
    }
    
    showSuggestions() {
        this.searchSuggestions.style.display = 'block';
    }
    
    hideSuggestions() {
        this.searchSuggestions.style.display = 'none';
        this.selectedIndex = -1;
    }
    
    highlightQuery(text) {
        const query = this.searchInput.value.trim();
        if (!query) return this.escapeHtml(text);
        
        const escapedQuery = this.escapeRegex(query);
        const regex = new RegExp(`(${escapedQuery})`, 'gi');
        return this.escapeHtml(text).replace(regex, '<mark>$1</mark>');
    }
    
    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    escapeRegex(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }
}

// Initialize search widget when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new SearchWidget();
});

// Additional CSS for enhanced styling
const additionalCSS = `
.search-suggestion.selected {
    background-color: #e8f4f8 !important;
}

.search-suggestion mark {
    background-color: #ffeb3b;
    padding: 0 2px;
    border-radius: 2px;
}

.search-suggestions {
    border-radius: 0 0 4px 4px;
}

.search-suggestion:last-child {
    border-bottom: none;
}

.search-form .form-control {
    border-radius: 4px 0 0 4px;
}

.search-form .btn {
    border-radius: 0 4px 4px 0;
}

@media (max-width: 768px) {
    .search-form {
        width: 100%;
    }
    
    .search-suggestions {
        left: 0;
        right: 0;
    }
}
`;

// Inject additional CSS
const style = document.createElement('style');
style.textContent = additionalCSS;
document.head.appendChild(style);
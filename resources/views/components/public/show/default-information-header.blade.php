<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">                        
        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
    </li>
    <li class="nav-item" role="presentation">                        
        <button class="nav-link" id="information-tab" data-bs-toggle="tab" data-bs-target="#information" type="button" role="tab" aria-controls="information" aria-selected="true">Détail</button>
    </li>
    <li class="nav-item" role="presentation">                        
        <button class="nav-link" id="equipement-tab" data-bs-toggle="tab" data-bs-target="#equipement" type="button" role="tab" aria-controls="equipement" aria-selected="true">Équipements</button>
    </li>
     {{-- Commentaires --}}
    <li class="nav-item" role="comments">                        
        <button class="nav-link" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments" type="button" role="tab" aria-controls="comments" aria-selected="true">Commentaires</button>
    </li>
</ul>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the equipement tab and information tab
    const equipementTab = document.getElementById('equipement-tab');
    const informationTab = document.getElementById('information-tab');
    const tabContainer = document.querySelector('.nav-tabs');
    
    // Handle click on the third tab (equipement)
    if (equipementTab) {
        equipementTab.addEventListener('click', function() {
            setTimeout(function() {
                // Get the tab container and comments tab
                const commentsTab = document.getElementById('comments-tab');
                
                if (tabContainer && commentsTab) {
                    // Calculate if comments tab is visible
                    const containerRect = tabContainer.getBoundingClientRect();
                    const tabRect = commentsTab.getBoundingClientRect();
                    
                    // If comments tab is not fully visible
                    if (tabRect.right > containerRect.right) {
                        // Scroll to show the comments tab
                        tabContainer.scrollLeft = tabContainer.scrollLeft + (tabRect.right - containerRect.right) + 20;
                    }
                }
            }, 50); // Small delay to ensure DOM is updated
        });
    }
    
    // Handle click on the second tab (information/détail)
    if (informationTab && tabContainer) {
        informationTab.addEventListener('click', function() {
            // Scroll back to the beginning
            tabContainer.scrollLeft = 0;
        });
    }
});
</script>

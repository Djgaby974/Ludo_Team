document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour initialiser les tooltips de validation
    function initFormValidationTooltips() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            const inputs = form.querySelectorAll('input, textarea, select');
            
            inputs.forEach(input => {
                // Supprimer les tooltips existants
                if (input.nextElementSibling && input.nextElementSibling.classList.contains('validation-tooltip')) {
                    input.nextElementSibling.remove();
                }
                
                // Créer un tooltip personnalisé
                const tooltip = document.createElement('div');
                tooltip.classList.add('validation-tooltip', 'text-danger', 'd-none');
                tooltip.style.fontSize = '0.8rem';
                input.parentNode.insertBefore(tooltip, input.nextSibling);
                
                // Gestion des erreurs de validation
                input.addEventListener('invalid', function(e) {
                    e.preventDefault();
                    
                    // Afficher le message de validation
                    tooltip.textContent = this.validationMessage;
                    tooltip.classList.remove('d-none');
                    
                    // Style visuel pour l'input
                    this.classList.add('is-invalid');
                });
                
                // Réinitialiser quand l'utilisateur commence à saisir
                input.addEventListener('input', function() {
                    tooltip.classList.add('d-none');
                    this.classList.remove('is-invalid');
                });
            });
        });
    }

    // Initialiser les tooltips au chargement et après des changements dynamiques
    initFormValidationTooltips();

    // Réinitialiser les tooltips après des soumissions de formulaire ou des rechargements
    document.addEventListener('ajax:complete', initFormValidationTooltips);
});

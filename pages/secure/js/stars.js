document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.querySelector('input[name="rating"]');
    
    stars.forEach(star => {
        star.addEventListener('mouseover', function() {
            const value = this.getAttribute('data-value');
            ratingInput.value = value;

            // Remover estrelas preenchidas
            stars.forEach(s => {
                s.classList.remove('filled');
            });

            // Preencher estrelas até a clicada
            this.classList.add('filled');
            let prev = this.previousElementSibling;
            while (prev !== null) {
                prev.classList.add('filled');
                prev = prev.previousElementSibling;
            }
        });
    });
});
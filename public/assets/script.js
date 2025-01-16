
document.addEventListener('DOMContentLoaded', function () {
    // Liste des images disponibles
    const images = [
        'assets/imgs/heroes/hero1.png',
        'assets/imgs/heroes/hero1.png',
        'assets/imgs/heroes/hero1.png'
    ];

    // Sélection de toutes les cartes des héros
    const heroCards = document.querySelectorAll('.hero-card');

    // Parcours de chaque carte de héros
    heroCards.forEach(function (card) {
        // Sélection de l'image et du champ caché dans la carte actuelle
        const img = card.querySelector('.hero-image');
        const hiddenInput = card.querySelector('.hero-image-src');

        if (img && hiddenInput) {
            // Attribution d'une image aléatoire
            const randomImage = images[Math.floor(Math.random() * images.length)];
            img.src = randomImage;

            // Mise à jour de la valeur du champ caché
            hiddenInput.value = randomImage;
        }
    });
});




// document.addEventListener('DOMContentLoaded', function () {
   
//     const images = [
//         'assets/imgs/heroes/hero1.png',
//         'assets/imgs/heroes/hero1.png',
//         'assets/imgs/heroes/hero1.png'
    
       
//     ];

    
//     const heroImages = document.querySelectorAll('.hero-image');

 
//     heroImages.forEach(function (img) {
//         const randomImage = images[Math.floor(Math.random() * images.length)];
//         img.src = randomImage;

//         // // Trouver le formulaire correspondant et mettre à jour le champ caché
//         // const form = img.closest('.hero-card').querySelector('.hero-form');
//         // const hiddenInput = form.querySelector('.hero-image-src');
//         // hiddenInput.value = randomImage;
//     });
// });

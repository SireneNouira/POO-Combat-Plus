document.addEventListener("DOMContentLoaded", function () {
  // Liste des images disponibles
  const images = [
    "assets/imgs/heroes/hero1.png",
    "assets/imgs/heroes/hero3.png",
    "assets/imgs/heroes/hero4.png",
    "assets/imgs/heroes/hero5.png",
  ];

  // Sélection de toutes les cartes des héros
  const heroCards = document.querySelectorAll(".hero-card");

  // Parcours de chaque carte de héros
  heroCards.forEach(function (card) {
    // Sélection de l'image et du champ caché dans la carte actuelle
    const img = card.querySelector(".hero-image");
    const hiddenInput = card.querySelector(".hero-image-src");

    if (img && hiddenInput) {
      // Attribution d'une image aléatoire
      const randomImage = images[Math.floor(Math.random() * images.length)];
      img.src = randomImage;

      // Mise à jour de la valeur du champ caché
      hiddenInput.value = randomImage;
    }
  });
});




// document.addEventListener("DOMContentLoaded", function () {
//     const images = [
//       "assets/imgs/monstres/monstre1.png",
//       "assets/imgs/monstres/monstre1.png",
//       "assets/imgs/monstres/monstre1.png",
//     ];
  
//     // Sélection de l'élément img avec la classe monstre-image
//     const monstreImage = document.querySelector(".monstre-image");
  
//     if (monstreImage) {
//       // Attribution d'une image aléatoire
//       const randomImage = images[Math.floor(Math.random() * images.length)];
//       monstreImage.src = randomImage;
//     }
//   });
  

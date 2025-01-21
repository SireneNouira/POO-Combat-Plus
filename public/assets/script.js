// document.addEventListener("DOMContentLoaded", function () {
//   // Liste des images disponibles
//   const images = [
//     "assets/imgs/heroes/hero1.png",
//     "assets/imgs/heroes/hero3.png",
//     "assets/imgs/heroes/hero4.png",
//     "assets/imgs/heroes/hero5.png",
//   ];

//   // Sélection de toutes les cartes des héros
//   const heroCards = document.querySelectorAll(".hero-card");

//   // Parcours de chaque carte de héros
//   heroCards.forEach(function (card) {
//     // Sélection de l'image et du champ caché dans la carte actuelle
//     const img = card.querySelector(".hero-image");
//     const hiddenInput = card.querySelector(".hero-image-src");

//     if (img && hiddenInput) {
//       // Attribution d'une image aléatoire
//       const randomImage = images[Math.floor(Math.random() * images.length)];
//       img.src = randomImage;

//       // Mise à jour de la valeur du champ caché
//       hiddenInput.value = randomImage;
//     }
//   });
// });


document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("avatar-modal");
  const chooseAvatarBtn = document.getElementById("choose-avatar");
  const closeModalBtn = modal.querySelector(".close");
  const selectedImageInput = document.getElementById("selected-image");
  const avatarOptions = document.querySelectorAll(".avatar-option");

  // Ouvrir la modal
  chooseAvatarBtn.addEventListener("click", function () {
      modal.style.display = "flex"; // Afficher la modal en flex pour centrer le contenu
  });

  // Fermer la modal
  closeModalBtn.addEventListener("click", function () {
      modal.style.display = "none";
  });

  // Sélectionner une image
  avatarOptions.forEach(function (avatar) {
      avatar.addEventListener("click", function () {
          const selectedImage = avatar.getAttribute("data-src");
          selectedImageInput.value = selectedImage;
          modal.style.display = "none";

          // Sauvegarder l'image dans le localStorage avec le nom du héros comme clé
          const heroName = document.getElementById("name").value;
          if (heroName) {
              localStorage.setItem(`hero-image-${heroName}`, selectedImage);
          }
      });
  });
});



document.addEventListener("DOMContentLoaded", function () {
  const heroCards = document.querySelectorAll(".hero-card");

  heroCards.forEach(function (card) {
      const img = card.querySelector(".hero-image");
      const heroName = img.getAttribute("data-hero-name");
      const heroImageSrcInput = card.querySelector(".hero-image-src");

      if (heroName) {
          const savedImage = localStorage.getItem(`hero-image-${heroName}`);
          if (savedImage) {
              img.src = savedImage;
              heroImageSrcInput.value = savedImage;
          }
      }
  });
});
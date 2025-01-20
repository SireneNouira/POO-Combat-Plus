document.addEventListener("DOMContentLoaded", function () {
    const images = [
      "assets/imgs/monstres/monstre1.png",
      "assets/imgs/monstres/monstre2.png",
      "assets/imgs/monstres/monstre3.png",
      "assets/imgs/monstres/monstre4.png",
    ];
  
    // Sélection de l'élément img avec la classe monstre-image
    const monstreImage = document.querySelector(".monstre-image");
  
    if (monstreImage) {
      // Attribution d'une image aléatoire
      const randomImage = images[Math.floor(Math.random() * images.length)];
      monstreImage.src = randomImage;
    }
  });
  



  document.addEventListener('keydown', function(event) {
    if ((event.key === " " || event.code === "Space") && !event.repeat) {
        heroAttack();
         attack();
     }
});
 
// bouge hero en appyant sur espace
  function heroAttack() {
    const heroImage = document.getElementById('heroImage');
    
    
    heroImage.style.transform = 'translateX(100px)'; // Déplace le héros de 100px vers la droite

    // Attendre quelques secondes puis revenir à sa position initiale
    setTimeout(() => {
        heroImage.style.transform = 'translateX(0)';
    }, 500); // 500ms pour que l'attaque soit visible
}


// simule click attack hero
function attack(){

      // preventDefault();

      const hiddenButton = document.getElementById('hiddenButton');
      hiddenButton.click();
  }



// function attack() {
//   console.log("fetch appelé");

//   // Créez les paramètres correctement encodés
//   const params = new URLSearchParams();
//   params.append('action', 'attack');

//   fetch('./fight.php', {
//       method: 'POST',
//       headers: {
//           'Content-Type': 'application/x-www-form-urlencoded',
//       },
//       body: params.toString(),
//   })
//       .then(response => {
//           console.log('Réponse reçue:', response);
//           if (!response.ok) {
//               throw new Error(`Erreur HTTP : ${response.status}`);
//           }
//           return response.text();
//       })
//       .then(data => {
//           console.log('Données reçues du serveur :', data);
//           location.reload(); // Recharge la page
//           console.log('hhh');
//       })
//       .catch(error => console.error('Erreur lors de l\'attaque :', error));
// }






function moveMonster() {
  const monsterImage = document.getElementById('monsterImage');
  const randomDirection = Math.random() > 0.5 ? 1 : -1; // Déterminer une direction aléatoire (+1 pour avancer, -1 pour reculer)
  const randomDistance = Math.floor(Math.random() * 100) + 50; // Distance aléatoire entre 50px et 150px

  // Déplacer le monstre de manière aléatoire
  monsterImage.style.transform = `translateX(${randomDirection * randomDistance}px)`;
  
  // Après un petit délai, revenir à la position initiale du monstre
  setTimeout(() => {
      monsterImage.style.transform = 'translateX(0)';
  }, 500); // 500ms pour que le mouvement soit visible
}

  
setInterval(moveMonster, 2000); // Le monstre se déplace toutes les 2 secondes 


// simulation click sur button attackdu monstre
setInterval(() => {
  const monsterAttackButton = document.getElementById('monsterAttackButton');
  monsterAttackButton.click();
}, 1000); 
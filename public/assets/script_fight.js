document.addEventListener("DOMContentLoaded", function () {
    const images = [
      "assets/imgs/monstres/monstre1.png",
      "assets/imgs/monstres/monstre1.png",
      "assets/imgs/monstres/monstre1.png",
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
    if (event.key === " " || event.code === "Space") {
        heroAttack();
        attack();
    }
});

  function heroAttack() {
    const heroImage = document.getElementById('heroImage');
    
    
    heroImage.style.transform = 'translateX(100px)'; // Déplace le héros de 100px vers la droite

    // Attendre quelques secondes puis revenir à sa position initiale
    setTimeout(() => {
        heroImage.style.transform = 'translateX(0)';
    }, 500); // 500ms pour que l'attaque soit visible
}



function attack() {
  fetch('fight.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: 'action=attack'  // L'action que vous voulez appeler sur le serveur
  })
  .then(response => response.json())
  .then(data => {
      // Mettez à jour l'interface si nécessaire avec les nouvelles stats (PV, score, etc.)
      console.log(data);
  })
  .catch(error => console.error('Erreur lors de l\'attaque:', error));
}





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


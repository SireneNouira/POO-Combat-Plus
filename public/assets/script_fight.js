// image aleatoire du monstre
document.addEventListener("DOMContentLoaded", function () {
  const images = [
    "assets/imgs/monstres/monstre1.png",
    "assets/imgs/monstres/monstre2.png",
    "assets/imgs/monstres/monstre3.png",
    "assets/imgs/monstres/monstre4.png",
  ];

  const monstreImage = document.getElementById("monsterImage");

  if (monstreImage) {
    let savedImage = localStorage.getItem("monsterImage");

    if (!savedImage) {
      savedImage = images[Math.floor(Math.random() * images.length)];
      localStorage.setItem("monsterImage", savedImage);
    }
    monstreImage.src = savedImage;
     // Démarrer l'animation une fois l'image chargée
     monstreImage.onload = function () {
      moveMonster(); 
      setInterval(moveMonster, 2000); 

      // Attaquer toutes les 4 secondes
      setInterval(attackMonster, 1000);
    };
  }
});

const replays = document.querySelectorAll('.replay'); 

replays.forEach(replay => {
  replay.addEventListener('click', removeItem);
});

function removeItem() {
  localStorage.removeItem("monsterImage");
}

// ecouteur d'espace pour actions du Hero
document.addEventListener("keydown", function (event) {
  if ((event.key === " " || event.code === "Space") && !event.repeat) {
    heroAttack();
    attack();
  }
});

// bouge hero en appyant sur espace
function heroAttack() {
  const heroImage = document.getElementById("heroImage");

  heroImage.style.transform = "translateX(100px)"; 
  setTimeout(() => {
    heroImage.style.transform = "translateX(0)";
  }, 500); 
}

// simule click attack hero
function attack() {
  // preventDefault();

  const hiddenButton = document.getElementById("hiddenButton");
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

//monstre image move
function moveMonster() {
  const monsterImage = document.getElementById("monsterImage");
  const randomDirection = Math.random() > 0.5 ? 1 : -1;
  const randomDistance = Math.floor(Math.random() * 100) + 50;

  monsterImage.style.transform = `translateX(${
    randomDirection * randomDistance
  }px)`;

  setTimeout(() => {
    monsterImage.style.transform = "translateX(0)";
  }, 500);



}

// Fonction pour attaquer le hero
function attackMonster() {
  const monsterAttackButton = document.getElementById("monsterAttackButton");

  if (monsterAttackButton) {
    monsterAttackButton.click(); 
    
  } else {
    console.error("Le bouton 'monsterAttackButton' n'existe pas dans le DOM.");
  }
}

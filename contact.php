<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&family=Roboto:wght@700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&family=Oleo+Script:wght@700&family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/shared.css" />
  <link rel="stylesheet" href="assets/css/contact.css" />
  <title>fellah's portfolio</title>
</head>

<body>
  <header>
    <!--I added this.-->
    <a href="/index.html">Fellah</a>
    <?php
    include './assets/locales/en.php';
    include './assets/templates/nav.php'
    ?>
  </header>
  <main>
    <!-- <h1>Contactez-moi</h1> -->
    <div>
      <section>
        <h2>Entrez en contact</h2>
        <p>
          J’aime entendre parler de vous. Je suis toujours ici pour discuter
        </p>
        <ul>
          <li>
            <i class="mdi mdi-email-outline"></i>
            <div>
              <h3>Discutez-avec moi</h3>
              <p>Je suis là pour vous aider</p>
              <p>abdoulaziz@gmail.com</p>
            </div>
          </li>
          <li>
            <i class="mdi mdi-map-marker"></i>
            <div>
              <h3>Burreau</h3>
              <p>Venez me dire Bonjour</p>
              <p>67000 Strasbourg</p>
            </div>
          </li>
          <li>
            <i class="mdi mdi-phone"></i>
            <div>
              <h3>Numéro de téléphone</h3>
              <p>Lun-Vend de 8h-17h</p>
              <p>0753103914</p>
            </div>
          </li>
        </ul>
      </section>
      <section>
        <h1>CONTACTEZ-MOI</h1>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus
        </p>
        <!-- <p>
          Merci de l'intérêt que vous portez a mon profile. Veuillez utiliser ce
          formulaire pour nous contacter. Réponse rapide assurée !
        </p> -->
        <form action="">
          <label for="surname">Prénom</label>
          <input type="text" name="user-name" id="surname" placeholder="Prénom" />

          <label for="email">Email</label>
          <input type="email" id="email" name="user-email" placeholder="Email" />

          <label for="phone-number">Numéro de télépone</label>
          <input type="tel" id="phone-number" name="user-number" placeholder="Numéro de téléphone" />
          <label for="user-msg">Votre message</label>
          <textarea name="" id="user-msg" cols="30" rows="10" placeholder="Rédiger votre message"></textarea>
          <button>Soumettre</button>
        </form>
      </section>
    </div>
  </main>
  <footer>
    <ul>
      <li>
        <a href="https://www.instagram.com">
          <img src="/assets/images/icons/insta.png" alt="instagram logo" />
        </a>
      </li>
      <li>
        <a href="https://www.facebook"><img src="/assets/images/icons/facebook.png" alt="facebook logo" /></a>
      </li>
    </ul>
  </footer>
  <script src="./assets/js/contact.js"></script>
</body>

</html>
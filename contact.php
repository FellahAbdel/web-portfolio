<!DOCTYPE html>
<html lang="en">

<?php
require_once './assets/templates/head.php'
?>

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
  <?php
  require_once './assets/templates/footer.php'
  ?>
  <script src="./assets/js/contact.js"></script>
</body>

</html>
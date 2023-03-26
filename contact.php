<?php
$en_select = "";
$fr_select = "";
if (isset($_GET['lang']) && $_GET['lang'] == 'en' || !isset($_GET['lang'])) {
  require_once './assets/locales/en.php';
  $en_select = "selected";
} else {
  require_once './assets/locales/fr.php';
  $fr_select = "selected";
}
var_dump($_GET['lang']);

?>

<!DOCTYPE html>
<html lang="en">

<?php
require_once './assets/templates/head.php'
?>

<body>
  <header>
    <!--I added this.-->
    <a href="/index.php">Fellah</a>
    <?php
    include './assets/templates/nav.php'
    ?>
  </header>
  <main>
    <!-- <h1>Contactez-moi</h1> -->
    <div>
      <section>
        <h2><?= $trad["contact-first-section"]["h2"] ?></h2>
        <p>
          <?= $trad["contact-first-section"]["p"] ?>
        </p>
        <ul>
          <li>
            <i class="mdi mdi-email-outline"></i>
            <div>
              <h3> <?= $trad["contact-first-section"]["div1 h3"] ?> </h3>
              <p><?= $trad["contact-first-section"]["div1 p1"] ?></p>
              <p><?= $trad["contact-first-section"]["div1 p2"] ?></p>
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
  <script src="./assets/js/shared-js.js?parent=contact.php"></script>
  <script src="./assets/js/contact.js"></script>
</body>

</html>
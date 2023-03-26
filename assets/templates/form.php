<form action="">
  <label for="surname"><?= $trad["contact-second-section"]["label1"] ?></label>
  <input type="text" name="user-name" id="surname" placeholder="Prénom" />

  <label for="email"><?= $trad["contact-second-section"]["label2"] ?></label>
  <input type="email" id="email" name="user-email" placeholder="Email" />

  <label for="phone-number"><?= $trad["contact-second-section"]["label3"] ?></label>
  <input type="tel" id="phone-number" name="user-number" placeholder="Numéro de téléphone" />
  <label for="user-msg"><?= $trad["contact-second-section"]["label4"] ?></label>
  <textarea name="" id="user-msg" cols="30" rows="9" placeholder="Rédiger votre message"></textarea>
  <button><?= $trad["contact-second-section"]["submitBtn"] ?></button>
</form>
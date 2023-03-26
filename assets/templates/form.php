<form action="">
  <div class="form-control">
    <label for="surname"><?= $trad["contact-second-section"]["label1"] ?></label>
    <input type="text" name="user-name" id="surname" placeholder="Prénom" />
    <i class="mdi mdi-check-circle-outline"></i>
    <i class="mdi mdi-alert-circle"></i>
    <small>Error message</small>
  </div>

  <div class="form-control">
    <label for="email"><?= $trad["contact-second-section"]["label2"] ?></label>
    <input type="email" id="email" name="user-email" placeholder="Email" />
    <i class="mdi mdi-check-circle-outline"></i>
    <i class="mdi mdi-alert-circle"></i>
    <small>Error message</small>
  </div>

  <div class="form-control">
    <label for="phone-number"><?= $trad["contact-second-section"]["label3"] ?></label>
    <input type="tel" id="phone-number" name="user-number" placeholder="Numéro de téléphone" />
    <i class="mdi mdi-check-circle-outline"></i>
    <i class="mdi mdi-alert-circle"></i>
    <small>Error message</small>
  </div>
  <div class="form-control">
    <label for="user-msg"><?= $trad["contact-second-section"]["label4"] ?></label>
    <textarea name="" id="user-msg" cols="30" rows="9" placeholder="Rédiger votre message"></textarea>
    <small>Error message</small>
  </div>
  <small>Your message has been successfully sent!</small>
  <button><?= $trad["contact-second-section"]["submitBtn"] ?></button>
</form>
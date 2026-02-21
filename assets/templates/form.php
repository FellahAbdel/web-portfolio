<form action="/assets/php/contactUs.php" method="post" class="premium-form">
  <div class="form-row">
    <div class="form-control">
      <label for="surname"><?= $trad["contact-second-section"]["label1"] ?></label>
      <input type="text" name="user-name" id="surname" placeholder="Votre prénom" />
      <i class="mdi mdi-check-circle-outline success-icon"></i>
      <i class="mdi mdi-alert-circle error-icon"></i>
      <small>Error message</small>
    </div>

    <div class="form-control">
      <label for="phone-number"><?= $trad["contact-second-section"]["label3"] ?></label>
      <input type="tel" id="phone-number" name="user-number" placeholder="Votre numéro" />
      <i class="mdi mdi-check-circle-outline success-icon"></i>
      <i class="mdi mdi-alert-circle error-icon"></i>
      <small>Error message</small>
    </div>
  </div>

  <div class="form-control">
    <label for="email"><?= $trad["contact-second-section"]["label2"] ?></label>
    <input type="email" id="email" name="user-email" placeholder="Votre adresse email" />
    <i class="mdi mdi-check-circle-outline success-icon"></i>
    <i class="mdi mdi-alert-circle error-icon"></i>
    <small>Error message</small>
  </div>

  <div class="form-control">
    <label for="user-msg"><?= $trad["contact-second-section"]["label4"] ?></label>
    <textarea name="user-msg" id="user-msg" cols="30" rows="6" placeholder="Comment puis-je vous aider ?"></textarea>
    <small>Error message</small>
  </div>
  
  <div class="form-footer">
    <small class="success-msg">Your message has been successfully sent!</small>
    <button type="submit" class="btn-submit"><?= $trad["contact-second-section"]["submitBtn"] ?></button>
  </div>
</form>
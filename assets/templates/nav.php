      <nav>
        <ul>
          <li><a href="/index.php"><?= $trad['nav']['home'] ?> <i class="mdi mdi-home-circle"></i></a></li>
          <li><a href="/formation.html"><?= $trad['nav']['education'] ?></a></li>
          <li><a href="/contact.php"><?= $trad['nav']['contact'] ?> <i class="mdi mdi-account-box"></i></a></li>

          <li>
            <select id="lang" name="lang">
              <option value="fr" <?php echo $fr_select ?>>Français</option>
              <option value="en" <?php echo $en_select ?>>English</option>
            </select>
          </li>
        </ul>
        <div>
          <span></span>
          <span></span>
          <span></span>
        </div>
      </nav>
      <nav>
        <ul>
          <li><a href="/index.php"><i class="mdi mdi-home-circle"></i> <?= $trad['nav']['home'] ?> </a> </li>
          <li><a href="/cv.php"><i class="mdi mdi-file-account"></i> <?= $trad['nav']['cv'] ?></a></li>
          <li><a href="/admin/"><i class="mdi mdi-shield-crown"></i> <?= $trad['nav']['admin'] ?></a></li>
          <li><a href="/contact.php"><i class="mdi mdi-account-box"></i> <?= $trad['nav']['contact'] ?></a></li>
          <li><a href="/articles.php"><i class="mdi mdi-post"></i> <?= $trad['nav']['articles'] ?></a></li>

          <li class="select">
            <select id="lang" name="lang">
              <option value="fr" <?php echo $fr_select ?>>Français</option>
              <option value="en" <?php echo $en_select ?>>English</option>
            </select>
          </li>

          <li class="select">
            <select id="theme" name="theme" aria-label="Thème">
              <option value="dark">🌙 Sombre</option>
              <option value="light">☀️ Clair</option>
            </select>
          </li>
        </ul>
        <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </nav>
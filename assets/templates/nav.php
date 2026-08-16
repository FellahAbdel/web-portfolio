<?php
$current_page = basename($_SERVER['PHP_SELF'] ?? '');
?>
      <nav>
        <ul>
          <li><a href="/index.php" class="<?= ($current_page == 'index.php' || $current_page == '') ? 'active' : '' ?>"><i class="mdi mdi-home-circle"></i> <?= $trad['nav']['home'] ?> </a> </li>
          <li><a href="/cv.php" class="<?= ($current_page == 'cv.php') ? 'active' : '' ?>"><i class="mdi mdi-file-account"></i> <?= $trad['nav']['cv'] ?></a></li>
          <li><a href="/certifications.php" class="<?= ($current_page == 'certifications.php') ? 'active' : '' ?>"><i class="mdi mdi-certificate"></i> <?= $trad['nav']['certifications'] ?></a></li>
          <li><a href="/admin/" class="<?= (strpos($_SERVER['PHP_SELF'] ?? '', '/admin/') !== false) ? 'active' : '' ?>"><i class="mdi mdi-shield-crown"></i> <?= $trad['nav']['admin'] ?></a></li>
          <li><a href="/contact.php" class="<?= ($current_page == 'contact.php') ? 'active' : '' ?>"><i class="mdi mdi-account-box"></i> <?= $trad['nav']['contact'] ?></a></li>
          <li><a href="/articles.php" class="<?= ($current_page == 'articles.php' || $current_page == 'article.php') ? 'active' : '' ?>"><i class="mdi mdi-post"></i> <?= $trad['nav']['articles'] ?></a></li>

          <li class="nav-settings">
            <span class="nav-settings-label">Préférences</span>
            <div class="nav-settings-row">
              <div class="select">
                <select id="lang" name="lang">
                  <option value="fr" <?php echo $fr_select ?>>Français</option>
                  <option value="en" <?php echo $en_select ?>>English</option>
                </select>
              </div>

              <div class="select">
                <select id="theme" name="theme" aria-label="Thème">
                  <option value="dark">🌙 Sombre</option>
                  <option value="light">☀️ Clair</option>
                </select>
              </div>
            </div>
          </li>
        </ul>
        <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </nav>
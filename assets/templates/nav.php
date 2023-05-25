      <nav>
        <ul>
          <li><a href="/index.php"><?= $trad['nav']['home'] ?> <i class="mdi mdi-home-circle"></i></a></li>
          <li><a href="/public/cvDiallo.pdf" target="_blank"><?= $trad['nav']['cv'] ?><i class="mdi mdi-file-account"></i></a></li>
          <li><a href="/admin.php"><?= $trad['nav']['admin'] ?><i class="mdi mdi-shield-crown"></i></a></li>
          <li><a href="/contact.php"><?= $trad['nav']['contact'] ?> <i class="mdi mdi-account-box"></i></a></li>

          <li class="select">
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
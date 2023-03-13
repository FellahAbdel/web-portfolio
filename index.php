<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&family=Oleo+Script:wght@700&family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/shared.css" />
  <link rel="stylesheet" href="assets/css/styles.css" />
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
    <section>
      <div id="home">
        <div>
          <ul>
            <li>
              <a href=""><i class="mdi mdi-github"></i></a>
            </li>
            <li>
              <a href=""><i class="mdi mdi-twitter"></i></a>
            </li>
            <li>
              <a href=""><i class="mdi mdi-linkedin"></i></a>
            </li>
            <li></li>
          </ul>
          <svg viewBox="0 0 200 187" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <mask id="mask0" mask-type="alpha">
              <path d="M190.312 36.4879C206.582 62.1187 201.309 102.826 182.328 134.186C163.346 165.547 
        130.807 187.559 100.226 186.353C69.6454 185.297 41.0228 161.023 21.7403 129.362C2.45775 
        97.8511 -7.48481 59.1033 6.67581 34.5279C20.9871 10.1032 59.7028 -0.149132 97.9666 
        0.00163737C136.23 0.303176 174.193 10.857 190.312 36.4879Z" />
            </mask>
            <g mask="url(#mask0)">
              <path d="M190.312 36.4879C206.582 62.1187 201.309 102.826 182.328 134.186C163.346 
        165.547 130.807 187.559 100.226 186.353C69.6454 185.297 41.0228 161.023 21.7403 
        129.362C2.45775 97.8511 -7.48481 59.1033 6.67581 34.5279C20.9871 10.1032 59.7028 
        -0.149132 97.9666 0.00163737C136.23 0.303176 174.193 10.857 190.312 36.4879Z" />
              <image x="12" y="-13" xlink:href="./assets/images/DSC_0590.png" />
            </g>
          </svg>
        </div>
        <div>
          <h1>Hi, I'am DIALLO</h1>
          <h3>Web developer</h3>
          <p>
            High level experience in web desing and knowledge, producing
            quality work.
          </p>
          <a href="#projects">Discover projects</a>
        </div>
      </div>
    </section>
    <!-- <section>
        <h2>Favorites</h2>
        <ul id="favorites-projects">
          <li>
            <img
              src="/assets/images/projects/web1.jpg"
              alt="angela yu web 3 project"
            />
            <p>dbang app <strong>WEB 3</strong></p>
          </li>
          <li>
            <img
              src="/assets/images/projects/web2.jpg"
              alt="dkeeper-app image"
            />
            <p>dkeeper app <strong>WEB 3</strong></p>
          </li>
          <li>
            <img
              src="/assets/images/projects/web3.jpg"
              alt="sokoban Tec Dev project"
            />
            <p>Sokoban puzzle<strong>C programming</strong></p>
          </li>
        </ul>
      </section> -->
    <section id="projects">
      <h2>Projects</h2>
      <ul>
        <li>
          <img src="/assets/images/projects/alejandro-escamilla-xII7efH1G6o-unsplash.jpg" alt="" />
          <article>
            <div>
              <h2>Dang app</h2>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Officia ipsa laudantium aliquid dicta consequatur consectetur
                rerum Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Esse temporibus accusamus, ipsam adipisci voluptates non
                dolorem possimus asperiores tempore, beatae repellendus dolor
                maxime provident inventore totam omnis blanditiis! Nulla,
                placeat.
              </p>
            </div>
            <footer>
              <a href="/">explore -></a>
            </footer>
          </article>
        </li>
        <li>
          <img src="/assets/images/projects/alejandro-escamilla-xII7efH1G6o-unsplash.jpg" alt="" />
          <article>
            <div>
              <h2>Sokoban</h2>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Officia ipsa laudantium aliquid dicta consequatur consectetur
                rerum Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Esse temporibus accusamus, ipsam adipisci voluptates non
                dolorem possimus asperiores tempore, beatae repellendus dolor
                maxime provident inventore totam omnis blanditiis! Nulla,
                placeat.
              </p>
            </div>
            <footer>
              <a href="/">explore -></a>
            </footer>
          </article>
        </li>
        <li>
          <img src="/assets/images/projects/alejandro-escamilla-xII7efH1G6o-unsplash.jpg" alt="" />
          <article>
            <div>
              <h2>Labyrinthe MIPS</h2>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Officia ipsa laudantium aliquid dicta consequatur consectetur
                rerum Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Esse temporibus accusamus, ipsam adipisci voluptates non
                dolorem possimus asperiores tempore, beatae repellendus dolor
                maxime provident inventore totam omnis blanditiis! Nulla,
                placeat.
              </p>
            </div>
            <footer>
              <a href="/">explore -></a>
            </footer>
          </article>
        </li>
        <li>
          <img src="/assets/images/projects/alejandro-escamilla-xII7efH1G6o-unsplash.jpg" alt="" />
          <article>
            <div>
              <h2>Email Marketing</h2>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Officia ipsa laudantium aliquid dicta consequatur consectetur
                rerum Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Esse temporibus accusamus, ipsam adipisci voluptates non
                dolorem possimus asperiores tempore, beatae repellendus dolor
                maxime provident inventore totam omnis blanditiis! Nulla,
                placeat.
              </p>
            </div>
            <footer>
              <a href="/">explore -></a>
            </footer>
          </article>
        </li>
      </ul>
    </section>
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
  <script src="./assets/js/main.js"></script>
</body>

</html>
# Web Programming 2 Project

## Implementation

### Server-side

- GET (search bar) and POST (comment form) forms
- Validation of form data before submission with JavaScript and PHP
- Handling of XSS vulnerability
- Use of PDO (PHP Data Objects)
- Database management with MySQL (Production/Docker)
- Data insertion into the database using PHP -> PDO -> MySQL
- Handling of "SQL injection" vulnerability with the query and prepare functions
- Extraction of data from the database
- Use of PHP classes

### Client-side

- Translation system for static elements
- Responsive design (smartphone, tablet, and computer)
- AJAX request (event on scroll)
- Management of redundant elements with PHP (navigation bar, footer)
- Adherence to digital accessibility rules
- Use of named HTML tags
- Use of CSS selectors
- Adherence to the architecture of a web project

## Installation & Usage

### Local Development with Docker (Recommended)

To run the project locally using Docker:

1. Clone the repository:
   ```bash
   git clone https://github.com/FellahAbdel/web-portfolio.git
   cd web-portfolio
   ```

2. Create your `.env` file from the example:
   ```bash
   cp .env.example .env
   ```

3. Launch the containers:
   ```bash
   docker compose up -d
   ```

The application will be accessible at `http://localhost:8080`.

### Local Development with PHP built-in server

1. Clone the repository and navigate into it.
2. Ensure PHP and a MySQL server are installed and running.
3. Configure your `.env` file.
4. Start the server:
   ```bash
   php -S localhost:8000
   ```

## Deployment (CI/CD)

This project uses **GitHub Actions** for automated deployment to **Alwaysdata**.

### How it works

On every `push` to the `main` branch:
1. GitHub Actions triggers the deployment workflow.
2. It connects to the Alwaysdata server via **SSH**.
3. It performs a `git pull` to update the code in the `~/www` directory.

### Configuration

To enable this, the following **GitHub Secrets** must be configured:
- `SSH_HOST`: Your Alwaysdata SSH host.
- `SSH_USER`: Your Alwaysdata username.
- `SSH_PRIVATE_KEY`: Your SSH private key (paired with a public key added to Alwaysdata).

[👉️ Visit the live website](http://fellah.alwaysdata.net/)

juste un test

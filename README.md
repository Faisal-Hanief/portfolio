# Portfolio Website

Personal portfolio website of **Muhammad Faisal Hanief**, an Informatics student at Universitas Teknokrat Indonesia. Built with Laravel 12, Tailwind CSS v4, and MySQL. The skills and projects shown on the page are loaded from the site's own REST API.

> Live demo: coming soon

## Features

- Responsive dark design with a gradient background, scroll animations, typing effect, and a cursor spotlight on project cards
- Sections: Hero, About, Skills, Projects, Education, and Contact
- Skills and projects are loaded from a REST API (Laravel + MySQL), with loading and error states
- Contact form that saves messages to the database (rate limited)
- Token-based admin API (Laravel Sanctum) to manage projects and read messages
- Placeholder buttons for links that are not ready yet (CV, LinkedIn, project GitHub and demo links)

## Tech stack

Laravel 12 · PHP 8.2+ · MySQL · Tailwind CSS v4 · Vite · Vanilla JavaScript · Laravel Sanctum

## Getting started

Requirements: PHP 8.2+, Composer, Node.js 20.19+ (or 22.12+), and MySQL.

```bash
git clone https://github.com/Faisal-Hanief/portfolio.git
cd portfolio
composer install
npm install
cp .env.example .env        # on Windows: copy .env.example .env
php artisan key:generate
```

Create an empty MySQL database named `portfolio` and check the `DB_*` values in `.env`. Then set:

- `ADMIN_EMAIL` and `ADMIN_PASSWORD` for the admin account (use a strong, unique password)
- `PORTFOLIO_EMAIL`, `PORTFOLIO_GITHUB`, `PORTFOLIO_WHATSAPP`, `PORTFOLIO_LINKEDIN`, and `PORTFOLIO_CV` for the contact buttons (leave a value empty to show that button as "soon")

```bash
php artisan migrate --seed
npm run dev
```

Open the site in your local web server (for example Laragon, or `php artisan serve`).

## API

| Method              | Endpoint                          | Access                | Description                               |
| ------------------- | --------------------------------- | --------------------- | ----------------------------------------- |
| GET                 | `/api/projects`                   | Public                | List published projects with their skills |
| GET                 | `/api/projects/{slug}`            | Public                | Show one project                          |
| GET                 | `/api/skills`                     | Public                | Skills grouped by category                |
| GET                 | `/api/stats`                      | Public                | Project and skill counts                  |
| POST                | `/api/contact`                    | Public (5 per minute) | Save a contact message                    |
| POST                | `/api/login`                      | Public (5 per minute) | Get an admin token                        |
| POST                | `/api/logout`                     | Token                 | Revoke the current token                  |
| POST, PATCH, DELETE | `/api/projects`                   | Token                 | Create, update, and delete projects       |
| GET                 | `/api/contact-messages`           | Token                 | Read contact messages                     |
| PATCH               | `/api/contact-messages/{id}/read` | Token                 | Mark a message as read                    |

Admin endpoints need an `Authorization: Bearer <token>` header. Tokens expire after one day.

## Notes

- Never commit your `.env` file. Use `.env.example` as the template.
- After changing CSS or JavaScript for production, run `npm run build`.

## License

Personal portfolio project. All rights reserved.

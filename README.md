PhishGuard - Phishing Simulator

A cybersecurity awareness training tool built as part of the 1Stop.ai Cybersecurity Mentorship Program.

## About
PhishGuard is a phishing simulation platform that allows security teams to:
- Create and launch phishing campaigns
- Send simulated phishing emails to target users
- Track who clicked the phishing links
- Show awareness training to users who clicked
- Generate reports on campaign results

## Tech Stack
- **Backend:** Laravel (PHP)
- **Frontend:** Blade + Tailwind CSS
- **Database:** MySQL / MariaDB
- **Email:** Laravel Mailer (Mailtrap for testing)
- **Tracking:** Unique UUID tokens per recipient

## Features
- Admin login system
- Campaign management (Create, Edit, Delete)
- Recipient management per campaign
- Unique tracking links per recipient
- Click tracking (IP, device, timestamp)
- Security awareness page after click
- Reports and analytics dashboard

## Setup Instructions
1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env`
4. Configure database and mail in `.env`
5. Run `php artisan key:generate`
6. Run `php artisan migrate`
7. Run `npm install && npm run build`
8. Run `php artisan serve`

## Note
This tool is built for educational purposes only.
Only use on systems and people you have permission to test.

## Author
Built during 1Stop.ai Cybersecurity Mentorship Program
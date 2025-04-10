# School Whistleblowing System

A simple and privacy-focused web application built with Laravel 11 to help students safely report bullying incidents at school. This system empowers students to speak up without fear of exposure or retaliation.

## 🎯 Purpose

The goal of this project is to provide a secure, anonymous, and user-friendly platform for students who have witnessed or experienced bullying. It is designed to:

- Protect the identity of whistleblowers
- Encourage honest and safe reporting
- Help school administrators handle reports effectively

## 🔐 Key Features

- **Anonymous Reporting**: Users can choose to submit reports anonymously or include their identity if they're comfortable.
- **Auto-generated Usernames**: During registration, usernames are randomly generated to protect user identity.
- **Detailed Reporting**: Users can file reports specifying the incident, perpetrator information, and their role (victim/witness).
- **User Dashboard**: Logged-in users can view, edit, and delete their own reports.
- **Admin Panel**: Admins can view full report details, mark them as handled, and delete irrelevant or invalid reports.
- **Role-based Access**: Only registered users can submit reports, and only admins can manage them.

## 🛠 Tech Stack

- Laravel 11
- Breeze (Blade with Alpine.js)
- MySQL
- Tailwind CSS (via Breeze)

## 🚀 Getting Started

1. Clone the repo  

```bash
git clone https://github.com/your-username/whistleblowing-system.git
cd whistleblowing-system
```

2. Install Dependencies
```bash
composer install
npm install && npm run build
```

3. Set up your `.env`
```bash
cp .env.example .env
php artisan key:generate
```

4. Set your DB credentials in `.env`, then run migrations:
```bash
php artisan migrate
```

5. Start the dev server
```bash
php artisan serve
```

## 🙌 Contribution
This project is built for educational and ethical purposes. Contributions and improvements are welcome to make it even more secure and helpful.


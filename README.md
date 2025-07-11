📚 Laravel Book Library

A clean Laravel 12 Book Library app allowing users to:

Browse books by category, author, and details.

Leave private notes for personal reading.

Leave public comments requiring admin approval.

Admin dashboard to approve or delete comments.

Authentication system with Breeze (login, register, profile, logout).

Uses Tailwind CSS & Blade components for clean UI.

🚀 Features

✅ Authentication (register, login, profile edit, logout)✅ Books CRUD (add, edit, delete, view)✅ Public Comments with admin approval workflow✅ Private Notes per book, visible only to the user✅ Admin Panel to manage comments✅ Responsive Tailwind UI with Blade components

⚙️ Installation

1️️️ Clone the repository

git clone https://github.com/predragmitikj94/laravel-book-library.git
cd laravel-book-library

(If you already have the project inside your htdocs, skip the cd step.)

2️️️ Install dependencies

composer install
npm install

3️️️ Generate application key

php artisan key:generate

4️️️ Configure your database

Edit your .env file:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_library
DB_USERNAME=root
DB_PASSWORD=

5️️️ Run migrations

php artisan migrate

6️️️ Run the development server

php artisan serve

Visit: http://127.0.0.1:8000

7️️️ For real-time Tailwind CSS updates

npm run dev

🛠 Usage

✅ Register a user or log in with your credentials.✅ Browse, add, edit, and delete books.✅ Leave private notes on books, visible only to you.✅ Leave public comments (admin approval required).✅ Admin users can approve/delete comments at /admin/comments.✅ Edit your profile via the top navigation.✅ Logout from the navigation dropdown.

📂 Project Structure

✅ Laravel Breeze authentication✅ Tailwind CSS styling with Blade components✅ Books CRUD secured by authentication✅ Public comments with admin approval workflow✅ Private notes tied to user and book✅ Admin panel for comment moderation✅ Clean MVC structure for learning and extension

🤝 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss proposed changes.

📜 License

This project is open-sourced under the MIT license.

🚀 Enjoy your Laravel Book Library!
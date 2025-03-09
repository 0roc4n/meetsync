# Meetsync

Meetsync is a real-time note-taking web application built with Laravel Blade and Socket.io. It features real-time collaboration, auto-translation, and speech-to-text capabilities to enhance productivity and accessibility.

## Features
- Real-time collaborative note-taking
- Auto-translate feature (Bikol/Tagalog to English)
- Live editing visibility on both Manager and Members pages
- Speech-to-text functionality
- Laravel backend with RESTful APIs
- WebSocket communication using Socket.io

## Tech Stack
- **Backend:** Laravel
- **Frontend:** Laravel Blade
- **Real-time Communication:** Socket.io
- **Database:** (Specify if you're using MySQL, PostgreSQL, etc.)

## Installation

### Prerequisites
Ensure you have the following installed:
- PHP (Laravel supported version)
- Composer
- Node.js & npm
- MySQL (or any database used)

### Setup Steps
1. Clone the repository:
   ```sh
   git clone https://github.com/your-username/meetsync.git
   cd meetsync
   ```
2. Install dependencies:
   ```sh
   composer install
   npm install
   ```
3. Configure environment:
   - Copy `.env.example` to `.env`
   - Set up database connection in `.env`
   ```sh
   php artisan key:generate
   php artisan migrate --seed
   ```
4. Start the Laravel development server:
   ```sh
   php artisan serve
   ```
5. Start the WebSocket server:
   ```sh
   cd socket-server
   npm install
   npm start
   ```

## Usage
- Visit `http://127.0.0.1:8000` to access Meetsync.
- Ensure the WebSocket server is running for real-time features.
- Use the speech-to-text feature for hands-free note-taking.
- Real-time translated notes can be viewed and edited from the Manager and Members pages.

## Contributing
1. Fork the repository.
2. Create a feature branch (`git checkout -b feature-name`).
3. Commit changes (`git commit -m 'Add new feature'`).
4. Push to the branch (`git push origin feature-name`).
5. Open a pull request.

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact
For any inquiries, reach out via [your email or GitHub profile].


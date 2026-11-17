# Kanban Board

A web-based Kanban board application developed with **PHP, CodeIgniter 4 and MySQL** to organize and manage tasks in a structured and visual way.

## Overview

The Kanban Board provides a centralized interface for managing tasks across different workflow columns. Tasks are organized by status, allowing users to keep track of their progress and structure their work.

## Technologies

- **Backend:** PHP, CodeIgniter 4
- **Database:** MySQL / MariaDB
- **Frontend:** HTML, CSS, JavaScript
- **Architecture:** Model-View-Controller (MVC)

## Database Structure

The application uses a relational database with the following main tables:

- `boards` – Stores board information
- `personen` – Stores user information
- `spalten` – Defines workflow columns
- `taskarten` – Stores task categories
- `tasks` – Stores task details, dates, notes and status information

Relationships between tables are managed through primary keys and foreign key constraints.

## Getting Started

### Prerequisites

Make sure the following tools are installed:

- PHP 7.4 or higher
- Composer
- MySQL or MariaDB
- A local development environment such as XAMPP

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/ramii3/Kanban-Board.git
   ```

2. Navigate to the project directory:

   ```bash
   cd Kanban-Board
   ```

3. Install the dependencies:

   ```bash
   composer install
   ```

4. Create a MySQL database and import the provided SQL file:

   `webentwicklung.sql`

5. Configure your database connection in the `.env` file.

6. Start the development server:

   ```bash
   php spark serve
   ```

7. Open the application in your browser:

   `http://localhost:8080`

## Project Structure

The project follows the CodeIgniter 4 MVC architecture:

- `app/` – Application logic, controllers, models and views
- `public/` – Public entry point and static assets
- `composer.json` – PHP dependencies
- `webentwicklung.sql` – Database structure and sample data

## License

This project is licensed under the MIT License.

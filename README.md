# MentorLink

**MentorLink** is a comprehensive, role-based mentorship platform built on **Laravel 12**. It connects aspiring students with experienced industry professionals for one-on-one guidance, session scheduling, and knowledge sharing.

---

## 🚀 Core Features

- **Role-Based Access Control**: Distinct experiences for Admins, Mentors, and Students.
- **Smart Discovery**: Advanced mentor directory with filtering by skills, rating, and keyword search.
- **Mentorship Requests**: Seamless workflow for students to request mentorship and mentors to accept/reject.
- **Session Booking**: Integrated availability management for mentors and calendar-based booking for students.
- **Reviews & Ratings**: Post-session feedback system that calculates average ratings dynamically.
- **Admin Dashboard**: Comprehensive platform management for users, reviews, skills, and departments.
- **Modern UI**: Polished, responsive interface built with Bootstrap 5 and modern CSS techniques.

---

## 👥 User Roles

### 1. Student
- Create a profile and browse the mentor directory.
- Send mentorship connection requests.
- Book sessions based on a mentor's availability.
- Leave reviews and ratings after completing a session.

### 2. Mentor
- Build a public profile detailing experience, designation, and skills.
- Set weekly availability slots for sessions.
- Manage incoming mentorship requests and session bookings.

### 3. Administrator
- Oversee platform health via the Admin Dashboard.
- Verify newly registered mentors.
- Manage user roles, departments, and skills.
- Moderate reviews.

---

## 🛠 Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates, Bootstrap 5, Bootstrap Icons
- **Database**: MySQL or SQLite (Fully compatible with both)
- **Testing**: Pest / PHPUnit

---

## ⚙️ Installation & Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd MentorLink
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   MentorLink supports both **SQLite** and **MySQL**.
   - **For SQLite (Default/Recommended for local testing):**
     Ensure your `.env` has:
     ```env
     DB_CONNECTION=sqlite
     # DB_HOST=...
     # DB_PORT=...
     # DB_DATABASE=...
     ```
     Create an empty `database/database.sqlite` file if it doesn't exist.
   - **For MySQL:**
     Update your `.env` to:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=mentorlink_db
     DB_USERNAME=root
     DB_PASSWORD=
     ```

5. **Build Assets**
   ```bash
   npm run build
   ```

6. **Run Migrations and Seed the Database**
   *Note: This will populate the system with departments, skills, and demo users.*
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Serve the Application**
   ```bash
   php artisan serve
   ```

---

## 🔑 Demo Credentials

After running `php artisan migrate:fresh --seed`, the following accounts will be available to test the platform. The password for all accounts is `password`.

| Role | Email |
|------|-------|
| **Admin** | `admin@mentorlink.test` |
| **Mentor 1** | `sarah@mentorlink.test` (Verified, with Bookings) |
| **Mentor 2** | `david@mentorlink.test` (Verified, Pending Requests) |
| **Student 1** | `alex@mentorlink.test` (Active) |
| **Student 2** | `emily@mentorlink.test` (Active) |

---

## 🧪 Testing

The project is backed by a robust test suite covering authentication, role middleware, feature workflows, and unit logic.

To run the test suite:
```bash
php artisan test
```

To format code style via Laravel Pint:
```bash
php artisan pint
```

---

## 📁 Folder Structure Highlight
- `app/Http/Controllers/Admin/` - Admin panel logic
- `app/Http/Controllers/Mentor/` - Mentor dashboard logic
- `app/Http/Controllers/Student/` - Student dashboard logic
- `resources/views/` - Segregated blade templates by role
- `tests/Feature/` - 60+ Feature tests

---

*Built with ❤️ using Laravel 12*

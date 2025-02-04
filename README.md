# 🎮 Video Games Blog | PHP Portfolio Project 

**A dynamic blog platform for gamers, built with PHP and MySQL**  
Explore, share, and discuss your favorite video games through a secure and user-friendly interface!

![PHP Version](https://img.shields.io/badge/PHP-8.x-%23777BB4?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.x-%234479A1?logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-%237952B3?logo=bootstrap)

## 🌟 Project Overview
This blog allows users to:
- 🔐 **Register/Login** securely with encrypted credentials.
- 📝 **Create, edit, and delete** gaming-related posts.
- 🗂️ **Organize content** by categories (RPG, FPS, etc.).
- 🔍 **Search posts** dynamically.
- 👤 **Manage profiles** (update email, name, etc.).

Designed with security and scalability in mind, featuring protection against SQL injection and session-based authentication.

---

## 🛠️ Technical Stack
| **Category**       | **Technologies**                                                                 |
|---------------------|---------------------------------------------------------------------------------|
| **Backend**         | PHP 8.x, MySQL 8.x                                                              |
| **Frontend**        | HTML5, CSS3, Bootstrap 5                                                        |
| **Security**        | `password_hash()`, `password_verify()`, `mysqli_real_escape_string()`           |
| **Database**        | MySQLi for database interactions                                                |
| **Session Handling**| PHP Native Sessions (`$_SESSION`)                                               |

---

## 🚀 Key Features

### 👥 User Management
- **Registration**:  
  Email uniqueness check, password hashing with `password_hash()`, and input sanitization.
- **Login**:  
  Session persistence with role-based redirects (future admin roles planned).
- **Profile Updates**:  
  Edit names, email, or password with real-time validations.

### 📑 Post System
- **Create Posts**:  
  Rich text entries with title, content, and category association.
- **Edit/Delete**:  
  Users retain full control over their content.
- **Public Feed**:  
  Chronologically displays posts with author info and timestamps.

### 🗃️ Category Management
- Admins (or authorized users) can:
  - Add/remove categories (e.g., "Indie Games", "Retro Consoles").
  - Filter posts by category on the homepage.

### 🔎 Advanced Search
- **Keyword Matching**:  
  Searches titles and content across all posts.
- **Instant Results**:  
  AJAX-based live search (planned in future updates).

### 🛡️ Security Measures
- **SQL Injection Protection**:  
  Input sanitization via `mysqli_real_escape_string()`.
- **Session Validation**:  
  Protected routes ensure users are logged in before performing actions.
- **Password Encryption**:  
  Bcrypt algorithm via PHP’s native functions.

---

## 📂 File Structure
```plaintext
video-games-blog/
├── index.php            # Homepage with latest posts
├── entry.php            # Single post view
├── create-entry.php     # Post creation form
├── edit-entry.php       # Post editor
├── delete-entry.php     # Post deletion handler
├── create-category.php  # Category management (admin)
├── search.php           # Search results page
├── update-user.php      # Profile update logic
├── my-data.php          # User profile dashboard
├── includes/
│   ├── connection.php   # Database config
│   └── helpers.php      # Utilities & validations
└── assets/
    ├── css/             # Custom styles
    └── js/              # Frontend scripts (future)

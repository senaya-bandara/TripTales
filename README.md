# WanderLanka — IN2120 Web Programming

A travel blog application built with:
- HTML
- CSS
- JavaScript
- PHP
- MySQL

## Assignment requirements covered

### 1. User Authentication & Authorization
- Register
- Login
- Logout
- Password hashing
- Session-based authentication
- Users can edit/delete only their own posts

### 2. Blog Management
- Create
- Read
- Update
- Delete

### 3. Frontend
- Home page with blog cards
- Single blog view
- Blog editor
- Responsive UI

### 4. Database
Required `user` and `blogPost` tables are included in `database.sql`.

### 5. Hosting
Upload the complete project to a PHP/MySQL hosting provider.
Change database credentials in `config/db.php`.

## Local XAMPP setup

1. Copy the `WanderLanka` folder into:
   `xampp/htdocs/`

2. Start Apache and MySQL.

3. Open phpMyAdmin.

4. Import:
   `database.sql`

5. If your MySQL username/password differs, edit:
   `config/db.php`

6. Open:
   `http://localhost/WanderLanka/`

## Demo flow

For the 3-minute assignment video:
1. Open hosted website.
2. Register a new account.
3. Login.
4. Create a travel blog.
5. Return to dashboard.
6. Edit the blog.
7. View the updated blog.
8. Delete the blog.
9. Show the home page and another user's post if available.
10. Show the hosted URL.

## Important security demonstration

The edit and delete operations use both:
- the requested blog ID
- the logged-in user's ID

This prevents one user from editing or deleting another user's blog through a modified URL or POST request.
# wanderlanka

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# BlogSphere - Multi-User Blogging Platform

A fully functional multi-user blogging platform built with Laravel 12, featuring role-based access control, OAuth authentication, and modern UI.

## Features

### 🔐 Authentication & Authorization
- **OAuth Integration**: Login with Google & GitHub using Laravel Socialite
- **Role-Based Access Control**: Admin, Editor, and Reader roles with specific permissions
- **Secure Registration**: Email verification and password protection

### 📝 Blog Management
- **Rich Text Editor**: TinyMCE integration for content creation
- **Image Upload**: Automatic image resizing and optimization
- **Categories & Tags**: Organize content with customizable categories and tags
- **Post States**: Draft, Published, and Archived statuses
- **SEO Friendly**: Slug-based URLs and meta tags

### 💬 Engagement Features
- **Comments System**: Nested comments with moderation
- **Like & Save**: Users can like and bookmark posts
- **View Tracking**: Post view counters
- **User Interaction**: Follow authors and save favorite posts

### 👥 User Management
- **Admin Dashboard**: Comprehensive user and content management
- **Role Assignment**: Dynamic role management for users
- **Content Moderation**: Comment approval and rejection system
- **User Profiles**: Avatar support with OAuth integration

## Tech Stack

- **Backend**: Laravel 12 with Eloquent ORM
- **Frontend**: Blade templates with Tailwind CSS
- **Authentication**: Laravel Breeze + Socialite (Google, GitHub)
- **Database**: MySQL with comprehensive migrations
- **Image Processing**: Intervention Image with GD driver
- **Permissions**: Spatie Laravel Permissions
- **Rich Text**: TinyMCE Editor

## Installation

1. **Clone the repository**
```bash
git clone <repository-url>
cd blog-platform
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database configuration**
```bash
# Update .env with your database credentials
php artisan migrate
php artisan db:seed --class=RolePermissionSeeder
php artisan db:seed --class=BlogSeeder
```

5. **OAuth setup**
```bash
# Add to .env file:
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

GITHUB_CLIENT_ID=your_github_client_id
GITHUB_CLIENT_SECRET=your_github_client_secret
GITHUB_REDIRECT_URI=http://localhost:8000/auth/github/callback
```

6. **Build assets and start server**
```bash
npm run build
php artisan serve
```

## Usage

### Default Accounts
- **Admin**: admin@blog.com / password
- **Editor**: editor@blog.com / password

### Creating Posts
1. Login with admin or editor account
2. Navigate to "Create Post" 
3. Fill in title, content, category, and tags
4. Choose to save as draft or publish
5. Upload featured image (optional)

### OAuth Login
1. Click "Login with Google" or "Login with GitHub"
2. Authorize the application
3. Automatically assigned "reader" role
4. Access blog reading and commenting features

## Permissions

### Admin Role
- Full access to all features
- User management and role assignment
- Content moderation and deletion
- System administration

### Editor Role
- Create, edit, and delete own posts
- Moderate comments
- Publish content
- View analytics

### Reader Role
- View published posts
- Comment on posts
- Like and save posts
- Basic user interactions

## API Endpoints

### Authentication
- `GET /auth/google` - Google OAuth
- `GET /auth/github` - GitHub OAuth
- `POST /login` - Standard login
- `POST /register` - User registration

### Blog
- `GET /blog` - All posts
- `GET /blog/{slug}` - Single post
- `POST /posts` - Create post (auth required)
- `PUT /posts/{post}` - Update post (auth required)
- `DELETE /posts/{post}` - Delete post (auth required)

### Interactions
- `POST /posts/{post}/like` - Toggle like
- `POST /posts/{post}/save` - Toggle save
- `POST /posts/{post}/comments` - Add comment

## File Structure

```
blog-platform/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/SocialiteController.php
│   │   ├── PostController.php
│   │   └── CommentController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Post.php
│   │   └── Comment.php
│   └── Policies/
│       └── PostPolicy.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── blog/
│   │   ├── posts/
│   │   └── auth/
│   ├── css/
│   └── js/
└── routes/
    ├── web.php
    └── auth.php
```

## Deployment

### Railway (Recommended)
```bash
npm install -g @railway/cli
railway login
railway init
railway up
```

### Heroku
```bash
heroku create your-app-name
git push heroku main
heroku run php artisan migrate --seed
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Write tests if applicable
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support and questions, please open an issue in the repository.

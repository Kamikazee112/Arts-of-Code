# Arts Of Code - Testing Guide

## 🚀 Getting Started

The application is now ready to test! Here's what you need to know:

### 🌐 Access Points

- **Main Application**: http://127.0.0.1:8000
- **Vite Dev Server**: http://localhost:5173

### 👤 Test Accounts

We've created two test accounts for you:

#### Regular User
- **Username**: testuser
- **Email**: test@example.com
- **Password**: password

#### Admin User
- **Username**: admin
- **Email**: admin@example.com
- **Password**: admin123

### 🎯 What You Can Test

#### 1. **Authentication System**
- ✅ User Registration (`/register`)
- ✅ User Login (`/login`)
- ✅ User Logout
- ✅ Protected Routes (require authentication)

#### 2. **User Profile**
- ✅ View your profile (`/users/{id}`)
- ✅ Update profile settings (`/settings`)
- ✅ Change password
- ✅ View user statistics

#### 3. **Dashboard**
- ✅ Personalized dashboard (`/dashboard`)
- ✅ Quick action cards
- ✅ Statistics overview

#### 4. **Articles System**
- ✅ View articles listing (`/articles`)
- ✅ Create new articles (`/articles/create`)
- ✅ View single article (`/articles/{slug}`)
- ✅ Edit your articles (`/articles/{slug}/edit`)
- ✅ Delete your articles
- ✅ Article validation and storage
- ✅ **Admin approval workflow** - Articles require admin approval
- ✅ **Tags system** - Proper tag management and display
- ✅ **Like functionality** - Users can like/unlike articles

#### 5. **Admin System**
- ✅ Admin dashboard (`/admin/dashboard`)
- ✅ View pending articles
- ✅ Approve/reject articles
- ✅ View published articles
- ✅ Admin-only access control

#### 5. **Navigation**
- ✅ Responsive navbar
- ✅ Mobile menu
- ✅ User dropdown menu
- ✅ Authentication state handling

### 📝 Testing Steps

1. **Visit the home page**: http://127.0.0.1:8000
   - Should see the Arts Of Code landing page
   - No articles shown yet (empty state)

2. **Test Registration**:
   - Click "Register" in the navbar
   - Fill in the form with username, email, and password
   - Submit and verify you're redirected to dashboard

3. **Test Login**:
   - Logout if you're logged in
   - Use the test credentials above
   - Verify you can access protected routes

4. **Test User Profile**:
   - Go to `/users/1` (or your user ID)
   - View your profile and stats
   - Try updating your profile in settings

5. **Test Articles System**:
   - Go to `/articles/create` (requires login)
   - Create a new article with title, body, and tags (e.g., "algorithms, data-structures")
   - Submit and verify it redirects to dashboard with "submitted for review" message
   - Check that article doesn't appear on `/articles` (pending approval)
   - Login as admin and go to `/admin/dashboard`
   - Approve the article from the admin dashboard
   - Verify article now appears on `/articles` and home page
   - Test editing and deleting your articles

6. **Test Tags System**:
   - Create an article with multiple tags separated by commas
   - View the article and verify tags are displayed as badges
   - Edit the article and change the tags
   - Verify tags are updated correctly

7. **Test Like Functionality**:
   - Go to any published article
   - Click the "Like" button
   - Verify the like count increases and button changes style
   - Click "Like" again to unlike
   - Verify the like count decreases and button returns to normal

8. **Test Admin Approval Workflow**:
   - Login as regular user and create an article
   - Verify article status is "draft" in dashboard
   - Logout and login as admin
   - Go to `/admin/dashboard`
   - View pending articles with preview, approve, and reject buttons
   - Approve an article and verify it becomes published
   - Reject an article and verify it shows as rejected
   - Check that only published articles appear on public pages

9. **Test Navigation**:
   - Try all the menu items
   - Test mobile responsiveness (resize browser)
   - Verify authentication state changes
   - Check admin link appears in dropdown for admin users

### 🔧 Database

The application uses SQLite with the following tables:
- `users` - User accounts
- `profiles` - User profiles
- `articles` - Articles (empty for now)
- `follows` - User relationships
- `posts` - User posts
- `comments` - Comments system
- `interactions` - Likes, bookmarks, etc.
- `quizzes` - Quiz definitions
- `quiz_attempts` - User quiz attempts
- `achievements` - Achievement system
- `user_achievements` - User achievements
- `conversations` - Messaging system
- `messages` - Conversation messages

### 🎨 Design System

The application uses a clean, minimal design with:
- **Font**: JetBrains Mono (monospace)
- **Colors**: Blue accent (#2563EB), light background
- **Style**: Modern, developer-focused aesthetic
- **Components**: Cards, buttons, inputs with custom styling

### 🚧 What's Next?

Here are features that still need to be implemented:

1. **Articles Enhancements**
   - Rich text editor for article content
   - Article categories system
   - Advanced search functionality
   - Comments system for articles
   - Article versioning/history

2. **Quiz/Exam System**
   - Quiz creation interface
   - Question management
   - Quiz taking interface
   - Results and scoring

3. **Ranking System**
   - Leaderboard implementation
   - XP calculation
   - User levels

4. **Achievement System**
   - Achievement definitions
   - Achievement unlocking logic
   - Achievement display

5. **Messaging System**
   - Real-time messaging
   - Conversation management
   - Notifications

6. **Admin Panel**
   - User management
   - Content moderation
   - System settings

### 🐛 Known Issues

- Some routes may show empty states (no data yet)
- Admin middleware needs to be created
- Some forms don't have backend processing yet
- No file upload functionality yet
- Notifications system is placeholder (coming soon)

### 💡 Development Notes

- The project uses Laravel 11 with PHP 8.x
- Frontend uses Vite with Tailwind CSS
- Authentication uses Laravel's built-in system
- Database uses SQLite for development

---

**Ready to start building?** The foundation is solid and ready for feature development!
---

## 🎯 **Key Features Implemented:**

### **Admin Approval System**
- Articles default to "draft" status
- Only published articles appear publicly
- Admin dashboard shows pending articles
- Admins can approve or reject articles
- Article status visible in user dashboard

### **Tags System**
- Proper many-to-many relationship
- Tags stored in separate table
- Tags displayed as badges on articles
- Tag input accepts comma-separated values
- Tags shown in listings and detail pages

### **Like System**
- Users can like/unlike articles
- Like count displayed on articles
- Visual feedback for liked state
- Uses interactions table for storage
- Toggle functionality implemented

# StartuPInvest UI Design Prompt

Design a **modern, premium web UI** for a platform called **“StartuPInvest”**, an equity crowdfunding application that connects startup founders and investors.

## 🎨 Overall Design Style
- Style: **Modern SaaS / Fintech dashboard**
- Inspiration: Stripe, Linear, Notion, modern startup platforms
- Feel: **clean, professional, trustworthy, slightly futuristic**
- Focus on **clarity, usability, and data readability**
- Avoid clutter — use whitespace generously

## 🌗 Theme & Colors
- Support **Light Mode and Dark Mode**
- Use **CSS variables for theming**

**Color palette:**
- Primary: Deep blue or indigo (trust, finance)
- Secondary: Emerald/green (growth, investment success)
- Accent: Soft purple or cyan (innovation/tech)
- Neutral: Gray scale for backgrounds and text

Example:
- Primary: #2563eb
- Success: #10b981
- Background (light): #f9fafb
- Background (dark): #0f172a

## 🔤 Typography
- Use modern sans-serif fonts (e.g. Inter, Poppins)
- Hierarchy:
  - Large bold headings
  - Medium section titles
  - Clean readable body text

## 🧩 Layout Structure

### 📌 Global Layout
- Sticky **top navbar**
- Optional **left sidebar** for dashboards
- Main content area with **cards and sections**
- Responsive design (mobile-first)

## 🧱 Core UI Components

### 1. Navigation
- Logo (StartuPInvest)
- Links: Home, Explore Projects, Dashboard
- Auth buttons: Login / Register
- User dropdown (profile, logout)

### 2. Landing Page
- Hero section:
  - Strong headline
  - CTA buttons (“Invest Now”, “Launch Your Startup”)
- Sections:
  - How it works (3 steps)
  - Featured projects (cards)
  - Trust indicators (stats, testimonials)

### 3. Project Cards (IMPORTANT)
Each project should be displayed in a **clean card UI**:
- Title
- Short description
- Funding progress bar
- % funded
- Price per share
- Remaining shares
- Button: “View Details”

### 4. Project Detail Page
- Large header with project info
- Tabs or sections:
  - Description
  - Financial info
  - Documents (PDF preview/download)
- Investment panel:
  - Input: number of shares
  - Auto-calculated total price
  - CTA: “Invest”

### 5. Dashboards (Key Feature)

#### 👤 Startuper Dashboard
- Stats cards:
  - Total funds raised
  - Number of projects
  - Shares sold
- Table/list of projects with status
- Actions: edit, delete

#### 💰 Investor Dashboard
- Portfolio overview
- Investments table
- Favorites list
- Stats (total invested, returns)

#### 🛠️ Admin Dashboard
- Global metrics (users, projects, revenue)
- Charts (use Chart.js style)
- Tables for moderation

### 6. Tables & Data UI
- Clean tables with:
  - Sorting
  - Filtering
  - Pagination
- Use subtle hover effects

### 7. Forms
- Modern input fields
- Floating labels or clean placeholders
- Inline validation (JS-friendly)
- Clear CTA buttons

### 8. Messaging UI
- Two-column layout:
  - Left: conversations list
  - Right: chat messages
- Clean chat bubbles

## ✨ UX Details
- Smooth hover effects
- Subtle animations
- Loading states
- Toast notifications
- Clear feedback for user actions

## 📱 Responsiveness
- Fully responsive:
  - Desktop → full dashboard
  - Tablet → compact sidebar
  - Mobile → stacked layout

## ⚙️ Technical Constraints
- Use **Bootstrap 5** as base
- Enhance with **custom CSS**
- Keep components reusable (MVC structure in mind)
- Avoid heavy frameworks

## 🎯 Design Goals
- Inspire **trust**
- Make **data easy to understand**
- Provide **smooth UX**
- Look like a **production-ready startup product**

## 💡 Optional
- Icons (Heroicons / Bootstrap Icons)
- Charts
- Light/dark toggle
- 8px spacing system

## 🧠 Extra Instruction
Generate reusable UI components and page templates that can be easily integrated into a PHP MVC architecture.

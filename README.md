# Mini Trello API

A RESTful API built with Laravel for managing workspaces, boards, lists, and cards efficiently.
This project is inspired by Trello and focuses on clean backend architecture, relational data handling, and secure API design.

---

## Features

- User Authentication using Laravel Sanctum
- Workspace, Board, Board List, and Card Management (CRUD)
- Nested resource structure (Workspace → Board → List → Card)
- Role-based authorization using Laravel Policies
- Protected API routes with access control
- Request validation using Form Requests
- Relational database design using Eloquent ORM
- Optimized queries with eager loading
- Secure access control (prevents unauthorized data access)
- RESTful API architecture
- Structured JSON responses

---

## Tech Stack

- Laravel
- PHP
- MySQL
- Laravel Sanctum
- Eloquent ORM
- REST API
- Postman

---

## API Modules

### Authentication
- Register
- Login
- Logout
- Get Authenticated User

### Workspaces
- Get Workspaces
- Create Workspace
- Update Workspace
- Delete Workspace

### Boards
- Get Boards
- Create Board
- Update Board
- Delete Board

### Board Lists
- Get Board Lists
- Create Board List
- Update Board List
- Delete Board List

### Cards
- Get Cards
- Create Card
- Update Card
- Delete Card

---

## Authentication

This API uses Laravel Sanctum for token-based authentication.

Example Authorization Header:

```http
Authorization: Bearer your_token
```

---
## What I Learned

During the development of this project, I learned:

* Designing scalable RESTful APIs
* Structuring nested resources (Workspace → Board → List → Card)
* Implementing authentication using Laravel Sanctum
* Using Laravel Policies for authorization
* Preventing unauthorized access to resources (IDOR protection)
* Designing relational database structures with Eloquent ORM
* Understanding eager loading vs lazy loading
* Using Form Requests for validation
* Structuring clean and maintainable controllers
* Handling HTTP status codes properly (200, 201, 404, 403)
* Testing APIs using Postman
* Writing clean and consistent backend architecture
---


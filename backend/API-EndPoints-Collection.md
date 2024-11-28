
# **API Collection**

## **Base URL**
All API requests will be made to the following base URL:
```
http://your-domain.com/..
```

---

## **Endpoints**

### 1. **Public Routes**

#### **Test Page**
- **Endpoint**: `GET /api/test`
- **Description**: Unprotected route for testing purposes.
- **Request Headers**: None
- **Response**:
    ```json
    {
        "message": "Un-Protected Route ((Test page))"
    }
    ```

---

### 2. **Authentication Routes**

#### **Register**
- **Endpoint**: `POST  /api/auth/register`
- **Description**: Registers a new user and returns a token.
- **Request Headers**: None
- **Request Body**:
    ```json
    {
        "name": "John Doe",
        "email": "johndoe@example.com",
        "password": "password123",
        "role_id": "1",
        "phone_number": "1234567890"
    }
    ```
- **Response**:
    ```json
    {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "johndoe@example.com",
            "role_id": "1",
            "phone_number": "1234567890"
        },
        "role": "admin",
        "token": "your_access_token_here"
    }
    ```

    **Notes**
    - to register as a company (`role_id :2`).
    - to register as a student (`role_id :3`).

---

#### **Login**
- **Endpoint**: `POST /api/auth/login`
- **Description**: Logs in a user and returns a token.
- **Request Headers**: None
- **Request Body**:
    ```json
    {
        "email": "johndoe@example.com",
        "password": "password123"
    }
    ```
- **Response**:
    ```json
    {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "johndoe@example.com",
            "role_id": "1"
        },
        "role": "admin",
        "token": "your_access_token_here"
    }
    ```

---

#### **Logout**
- **Endpoint**: `POST /api/logout`
- **Description**: Logs out the authenticated user and revokes the token.
- **Request Headers**:
    ```json
    {
        "Authorization": "Bearer your_access_token_here"
    }
    ```
- **Response**:
    ```json
    {
        "message": "Logged out successfully"
    }
    ```

---

### 3. **Protected Routes**

#### **Admin Routes**
- **Endpoint**: `GET /api/admin`
- **Description**: Access for admins only.
- **Request Headers**:
    ```json
    {
        "Authorization": "Bearer your_access_token_here"
    }
    ```
- **Response**:
    ```json
    {
        "message": "Hello Admin"
    }
    ```

---

#### **Company Routes**
- **Endpoint**: `GET /api/company`
- **Description**: Access for companys only.
- **Request Headers**:
    ```json
    {
        "Authorization": "Bearer your_access_token_here"
    }
    ```
- **Response**:
    ```json
    {
        "message": "Hello company"
    }
    ```

---

#### **Customer Routes**
- **Endpoint**: `GET /api/student`
- **Description**: Access for students only.
- **Request Headers**:
    ```json
    {
        "Authorization": "Bearer your_access_token_here"
    }
    ```
- **Response**:
    ```json
    {
        "message": "Hello student"
    }
    ```

---

## **Authorization**

### **Token-Based Authentication**
After successful login or registration, include the token in the `Authorization` header for all protected routes.
Example:
```
Authorization: Bearer your_access_token_here
```

---

## **Error Responses**

### **Validation Error**
- **Status Code**: `422`
- **Response**:
    ```json
    {
        "status": "error",
        "message": "Validation failed",
        "errors": {
            "email": ["The email field is required."],
            "password": ["The password field is required."]
        }
    }
    ```

### **Unauthorized**
- **Status Code**: `401`
- **Response**:
    ```json
    {
        "status": "error",
        "message": "Unauthorized"
    }
    ```

---

## **Roles**

- **Admin**: Can access `/admin` and other admin-specific routes.
- **Company**: Can access `/company` and other company-specific routes.
- **Student**: Can access `/student` and other student-specific routes.

---

This collection provides developers with a structured guide to interact with your API endpoints effectively.

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="Admindbstyle.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="https://scontent.fmnl4-1.fna.fbcdn.net/v/t39.30808-6/471162732_122180547374100636_2607041914606744030_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeE6D1imUD2siVS-_HczZUm6XyMjWvLJLwBfIyNa8skvAN4rZw09nYlusAp1WnbrvmBNVIlbTg0MKLJMEo2GzUtY&_nc_ohc=asMhda-F_WoQ7kNvwFMoe1R&_nc_oc=Adn5-Wp3paBMpEPhC96hlKdLOch1_4YDZgdtqUWPlu4ev5JVoN6IYF8qsc9FZjDmAbc&_nc_zt=23&_nc_ht=scontent.fmnl4-1.fna&_nc_gid=6z8avOW5v3FQINpTFGc2cw&oh=00_AfOc3G9gDT0k_xw02h0EdyDltuOyGVScayspH1ATlurXcg&oe=685984C4" alt="Logo" class="sidebar-logo">
            <h2>ADMIN</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active" id="logins-tab"><i class="fas fa-user-shield"></i> Logins</a></li>
            <li><a href="#" id="logsheets-tab"><i class="fas fa-clipboard-list"></i> Logsheets</a></li>
            <li><a href="#" id="masterlist-tab"><i class="fas fa-list-ol"></i> Masterlist</a></li>
            <li><a href="#" id="training-tab"><i class="fas fa-graduation-cap"></i> Special Training</a></li>
            <li><a href="#" id="products-tab"><i class="fas fa-box-open"></i> Products</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="content-header">
            <h1 class="content-title">User Logins</h1>
            <button class="add-btn" id="add-user-btn">
                <i class="fas fa-plus"></i> Add New User
            </button>
        </div>

        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search users...">
            <button id="search-btn"><i class="fas fa-search"></i></button>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table id="users-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="users-table-body">
                        <!-- User data will be loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- User Modal (Hidden by default) -->
    <div id="user-modal" class="modal" style="display: none; position: fixed; z-index: 1001; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
        <div class="modal-content" style="background-color: #fff; margin: 10% auto; padding: 20px; border-radius: 8px; width: 400px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <span class="close-btn" style="float: right; font-size: 24px; cursor: pointer;">&times;</span>
            <h2 style="margin-top: 0;" id="modal-title">Add New User</h2>
            <form id="user-form">
                <input type="hidden" id="user-id">
                <div style="margin-bottom: 15px;">
                    <label for="full-name" style="display: block; margin-bottom: 5px; font-weight: 500;">Full Name</label>
                    <input type="text" id="full-name" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="email" style="display: block; margin-bottom: 5px; font-weight: 500;">Email</label>
                    <input type="email" id="email" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="password" style="display: block; margin-bottom: 5px; font-weight: 500;">Password</label>
                    <input type="password" id="password" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 4px;">
                </div>
                <div style="display: flex; justify-content: flex-end;">
                    <button type="button" id="cancel-btn" style="padding: 8px 16px; background-color: #e2e8f0; border: none; border-radius: 4px; margin-right: 10px; cursor: pointer;">Cancel</button>
                    <button type="submit" id="save-btn" style="padding: 8px 16px; background-color: #0ea5e9; color: white; border: none; border-radius: 4px; cursor: pointer;">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sample user data (in a real app, this would come from MySQL database)
        let users = [
            { id: 1, fullName: "John Doe", email: "john@example.com", password: "password123" },
            { id: 2, fullName: "Jane Smith", email: "jane@example.com", password: "securepass" },
            { id: 3, fullName: "Mike Johnson", email: "mike@example.com", password: "mikepass" },
            { id: 4, fullName: "Sarah Williams", email: "sarah@example.com", password: "sarah1234" },
            { id: 5, fullName: "David Brown", email: "david@example.com", password: "dbrown2023" }
        ];

        // DOM elements
        const usersTableBody = document.getElementById('users-table-body');
        const searchInput = document.getElementById('search-input');
        const searchBtn = document.getElementById('search-btn');
        const addUserBtn = document.getElementById('add-user-btn');
        const userModal = document.getElementById('user-modal');
        const modalTitle = document.getElementById('modal-title');
        const userIdInput = document.getElementById('user-id');
        const fullNameInput = document.getElementById('full-name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const saveBtn = document.getElementById('save-btn');
        const cancelBtn = document.getElementById('cancel-btn');
        const userForm = document.getElementById('user-form');
        const closeBtn = document.querySelector('.close-btn');

        // Tab elements
        const tabs = {
            logins: document.getElementById('logins-tab'),
            logsheets: document.getElementById('logsheets-tab'),
            masterlist: document.getElementById('masterlist-tab'),
            training: document.getElementById('training-tab'),
            products: document.getElementById('products-tab')
        };

        // Initialize the dashboard
        function initDashboard() {
            renderUserTable(users);
            setupEventListeners();
        }

        // Render user table
        function renderUserTable(usersToRender) {
            usersTableBody.innerHTML = '';
            
            usersToRender.forEach(user => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.fullName}</td>
                    <td>${user.email}</td>
                    <td>${'•'.repeat(user.password.length)}</td>
                    <td>
                        <button class="edit-btn" data-id="${user.id}" style="background-color: #f59e0b; color: white; border: none; padding: 5px 10px; border-radius: 4px; margin-right: 5px; cursor: pointer;">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-btn" data-id="${user.id}" style="background-color: #ef4444; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                `;
                
                usersTableBody.appendChild(row);
            });
        }

        // Setup event listeners
        function setupEventListeners() {
            // Search functionality
            searchBtn.addEventListener('click', handleSearch);
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    handleSearch();
                }
            });

            // Add user button
            addUserBtn.addEventListener('click', () => {
                openModal('add');
            });

            // Modal buttons
            saveBtn.addEventListener('click', handleSaveUser);
            cancelBtn.addEventListener('click', closeModal);
            closeBtn.addEventListener('click', closeModal);

            // Form submission
            userForm.addEventListener('submit', function(e) {
                e.preventDefault();
                handleSaveUser();
            });

            // Tab navigation
            Object.values(tabs).forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Remove active class from all tabs
                    Object.values(tabs).forEach(t => t.classList.remove('active'));
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Here you would load the appropriate content for each tab
                    // For this demo, we're just showing the logins tab
                    // In a real app, you would make AJAX calls or show/hide different content
                    alert(`Loading ${this.textContent} content...`);
                });
            });

            // Delegate edit and delete button events
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('edit-btn') || e.target.closest('.edit-btn')) {
                    const button = e.target.classList.contains('edit-btn') ? e.target : e.target.closest('.edit-btn');
                    const id = parseInt(button.getAttribute('data-id'));
                    openModal('edit', id);
                }

                if (e.target.classList.contains('delete-btn') || e.target.closest('.delete-btn')) {
                    const button = e.target.classList.contains('delete-btn') ? e.target : e.target.closest('.delete-btn');
                    const id = parseInt(button.getAttribute('data-id'));
                    if (confirm('Are you sure you want to delete this user?')) {
                        deleteUser(id);
                    }
                }
            });
        }

        // Handle search
        function handleSearch() {
            const searchTerm = searchInput.value.toLowerCase();
            const filteredUsers = users.filter(user => 
                user.fullName.toLowerCase().includes(searchTerm) || 
                user.email.toLowerCase().includes(searchTerm)
            );
            renderUserTable(filteredUsers);
        }

        // Open modal for adding/editing users
        function openModal(mode, id = null) {
            if (mode === 'add') {
                modalTitle.textContent = 'Add New User';
                userIdInput.value = '';
                fullNameInput.value = '';
                emailInput.value = '';
                passwordInput.value = '';
            } else if (mode === 'edit' && id) {
                const user = users.find(u => u.id === id);
                if (user) {
                    modalTitle.textContent = 'Edit User';
                    userIdInput.value = user.id;
                    fullNameInput.value = user.fullName;
                    emailInput.value = user.email;
                    passwordInput.value = user.password;
                }
            }
            userModal.style.display = 'block';
        }

        // Close modal
        function closeModal() {
            userModal.style.display = 'none';
        }

        // Handle save user (add or edit)
        function handleSaveUser() {
            const id = parseInt(userIdInput.value) || 0;
            const fullName = fullNameInput.value.trim();
            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();

            // Basic validation
            if (!fullName || !email || !password) {
                alert('Please fill in all fields');
                return;
            }

            if (id) {
                // Edit existing user
                const index = users.findIndex(u => u.id === id);
                if (index !== -1) {
                    users[index] = { id, fullName, email, password };
                }
            } else {
                // Add new user (generate new ID)
                const newId = users.length > 0 ? Math.max(...users.map(u => u.id)) + 1 : 1;
                users.push({ id: newId, fullName, email, password });
            }

            renderUserTable(users);
            closeModal();
        }

        // Delete user
        function deleteUser(id) {
            users = users.filter(user => user.id !== id);
            renderUserTable(users);
        }

        // Initialize the dashboard when the page loads
        window.onload = initDashboard;
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Admindbstyle.css">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    
<!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="p-4 border-b border-gray-700">
            <h2 class="text-xl font-bold text-white">Admin Dashboard</h2>
        </div>
        <div class="p-4">
            <div class="mb-6">
                <h3 class="text-xs uppercase font-semibold text-gray-400 mb-2">Main</h3>
                <a href="#" class="nav-link active">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-database"></i>
                    <span>Database</span>
                </a>
            </div>
            <div class="mb-6">
                <h3 class="text-xs uppercase font-semibold text-gray-400 mb-2">Content</h3>
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-boxes"></i>
                    <span>Products</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-receipt"></i>
                    <span>Orders</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Database Management</h1>
            <button class="btn btn-primary" id="toggle-connection">
                <i class="fas fa-plug mr-2"></i>
                <span id="connection-text">Connect to Database</span>
            </button>
        </div>

        <!-- Connection Panel -->
        <div class="card mb-6" id="connection-panel" style="display: none;">
            <h2 class="text-lg font-semibold mb-4">Database Connection</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label class="form-label" for="db-host">Host</label>
                    <input type="text" id="db-host" class="form-control" placeholder="localhost">
                </div>
                <div class="form-group">
                    <label class="form-label" for="db-port">Port</label>
                    <input type="text" id="db-port" class="form-control" placeholder="3306">
                </div>
                <div class="form-group">
                    <label class="form-label" for="db-username">Username</label>
                    <input type="text" id="db-username" class="form-control" placeholder="root">
                </div>
                <div class="form-group">
                    <label class="form-label" for="db-password">Password</label>
                    <input type="password" id="db-password" class="form-control" placeholder="password">
                </div>
                <div class="form-group">
                    <label class="form-label" for="db-name">Database Name</label>
                    <input type="text" id="db-name" class="form-control" placeholder="my_database">
                </div>
                <div class="form-group flex items-end">
                    <button class="btn btn-primary w-full" id="test-connection">
                        <i class="fas fa-bolt mr-2"></i>
                        Test Connection
                    </button>
                </div>
            </div>
        </div>

        <!-- Status Bar -->
        <div class="flex items-center mb-6">
            <div class="connection-status disconnected mr-4" id="connection-status">
                <i class="fas fa-exclamation-circle"></i>
                <span>Disconnected</span>
            </div>
            <div class="flex-1"></div>
            <button class="btn btn-primary" id="add-record">
                <i class="fas fa-plus mr-2"></i>
                Add Record
            </button>
        </div>

        <!-- Database Table -->
        <div class="card overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="data-table-body">
                    <!-- Records will be inserted here -->
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center mt-4">
            <div class="text-sm text-gray-600">
                Showing <span id="start-record">1</span> to <span id="end-record">5</span> of <span id="total-records">10</span> records
            </div>
            <div class="flex space-x-2">
                <button class="btn" id="prev-page" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn" id="next-page">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div class="modal" id="record-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-lg font-semibold" id="modal-title">Add New Record</h3>
                <button class="text-gray-400 hover:text-gray-500" id="close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="record-form">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="form-group">
                            <label class="form-label" for="edit-name">Name</label>
                            <input type="text" id="edit-name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-email">Email</label>
                            <input type="email" id="edit-email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-role">Role</label>
                            <select id="edit-role" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="editor">Editor</option>
                                <option value="viewer">Viewer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-status">Status</label>
                            <select id="edit-status" class="form-control" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn mr-2" id="cancel-modal">
                    Cancel
                </button>
                <button class="btn btn-primary" id="save-record">
                    Save
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="delete-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-lg font-semibold">Confirm Deletion</h3>
                <button class="text-gray-400 hover:text-gray-500" id="close-delete-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this record? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button class="btn mr-2" id="cancel-delete">
                    Cancel
                </button>
                <button class="btn btn-danger" id="confirm-delete">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <div id="notification-message"></div>
    </div>

    <!-- Script -->
    <script>
        // Simulated database - in a real app, this would be replaced with actual database API calls
        let database = {
            connected: false,
            records: [
                {
                    id: 1,
                    name: "John Doe",
                    email: "john@example.com",
                    role: "admin",
                    status: "active",
                    created_at: "2023-05-15"
                },
                {
                    id: 2,
                    name: "Jane Smith",
                    email: "jane@example.com",
                    role: "editor",
                    status: "active",
                    created_at: "2023-06-20"
                },
                {
                    id: 3,
                    name: "Bob Johnson",
                    email: "bob@example.com",
                    role: "viewer",
                    status: "inactive",
                    created_at: "2023-07-10"
                },
                {
                    id: 4,
                    name: "Alice Brown",
                    email: "alice@example.com",
                    role: "editor",
                    status: "suspended",
                    created_at: "2023-08-05"
                },
                {
                    id: 5,
                    name: "Charlie Wilson",
                    email: "charlie@example.com",
                    role: "viewer",
                    status: "active",
                    created_at: "2023-09-12"
                },
                {
                    id: 6,
                    name: "Diana Prince",
                    email: "diana@example.com",
                    role: "admin",
                    status: "active",
                    created_at: "2023-10-18"
                },
                {
                    id: 7,
                    name: "Edward Norton",
                    email: "edward@example.com",
                    role: "editor",
                    status: "inactive",
                    created_at: "2023-11-22"
                },
                {
                    id: 8,
                    name: "Fiona Green",
                    email: "fiona@example.com",
                    role: "viewer",
                    status: "active",
                    created_at: "2023-12-05"
                },
                {
                    id: 9,
                    name: "George Harris",
                    email: "george@example.com",
                    role: "admin",
                    status: "suspended",
                    created_at: "2024-01-15"
                },
                {
                    id: 10,
                    name: "Hannah Lee",
                    email: "hannah@example.com",
                    role: "editor",
                    status: "active",
                    created_at: "2024-02-10"
                }
            ],
            connectionParams: {
                host: '',
                port: '',
                username: '',
                password: '',
                name: ''
            }
        };

        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const connectionPanel = document.getElementById('connection-panel');
        const toggleConnection = document.getElementById('toggle-connection');
        const connectionText = document.getElementById('connection-text');
        const connectionStatus = document.getElementById('connection-status');
        const testConnection = document.getElementById('test-connection');
        const addRecord = document.getElementById('add-record');
        const dataTableBody = document.getElementById('data-table-body');
        const prevPage = document.getElementById('prev-page');
        const nextPage = document.getElementById('next-page');
        const recordModal = document.getElementById('record-modal');
        const deleteModal = document.getElementById('delete-modal');
        const closeModal = document.getElementById('close-modal');
        const closeDeleteModal = document.getElementById('close-delete-modal');
        const cancelModal = document.getElementById('cancel-modal');
        const cancelDelete = document.getElementById('cancel-delete');
        const saveRecord = document.getElementById('save-record');
        const confirmDelete = document.getElementById('confirm-delete');
        const notification = document.getElementById('notification');
        const notificationMessage = document.getElementById('notification-message');
        const startRecord = document.getElementById('start-record');
        const endRecord = document.getElementById('end-record');
        const totalRecords = document.getElementById('total-records');
        const modalTitle = document.getElementById('modal-title');
        const recordForm = document.getElementById('record-form');

        // Form inputs
        const editName = document.getElementById('edit-name');
        const editEmail = document.getElementById('edit-email');
        const editRole = document.getElementById('edit-role');
        const editStatus = document.getElementById('edit-status');

        // Database input fields
        const dbHost = document.getElementById('db-host');
        const dbPort = document.getElementById('db-port');
        const dbUsername = document.getElementById('db-username');
        const dbPassword = document.getElementById('db-password');
        const dbName = document.getElementById('db-name');

        // Pagination
        let currentPage = 1;
        const recordsPerPage = 5;

        // Current record being edited/deleted
        let currentRecordId = null;
        let isEditing = false;

        // Initialization
        document.addEventListener('DOMContentLoaded', function() {
            renderTable();
            updatePagination();
            updateConnectionStatus();
        });

        // Toggle connection panel
        toggleConnection.addEventListener('click', function() {
            if (database.connected) {
                disconnectFromDatabase();
            } else {
                connectionPanel.style.display = connectionPanel.style.display === 'none' ? 'block' : 'none';
            }
        });

        // Test database connection
        testConnection.addEventListener('click', function() {
            // Save connection parameters
            database.connectionParams = {
                host: dbHost.value,
                port: dbPort.value,
                username: dbUsername.value,
                password: dbPassword.value,
                name: dbName.value
            };

            // In a real app, this would be an API call to test the database connection
            setTimeout(() => {
                // Simulate successful connection
                database.connected = true;
                updateConnectionStatus();
                connectionPanel.style.display = 'none';
                showNotification('success', 'Database connection established successfully');
            }, 1000);
        });

        // Add new record
        addRecord.addEventListener('click', function() {
            isEditing = false;
            currentRecordId = null;
            modalTitle.textContent = 'Add New Record';
            recordForm.reset();
            recordModal.classList.add('active');
        });

        // Close modal
        closeModal.addEventListener('click', closeAllModals);
        cancelModal.addEventListener('click', closeAllModals);
        closeDeleteModal.addEventListener('click', closeAllModals);
        cancelDelete.addEventListener('click', closeAllModals);

        // Save record
        saveRecord.addEventListener('click', function() {
            if (!recordForm.checkValidity()) {
                recordForm.reportValidity();
                return;
            }

            const record = {
                name: editName.value,
                email: editEmail.value,
                role: editRole.value,
                status: editStatus.value,
                created_at: new Date().toISOString().split('T')[0]
            };

            if (isEditing) {
                // Update existing record
                const index = database.records.findIndex(r => r.id === currentRecordId);
                if (index !== -1) {
                    record.id = currentRecordId;
                    database.records[index] = record;
                    showNotification('success', 'Record updated successfully');
                }
            } else {
                // Add new record
                record.id = database.records.length > 0 
                    ? Math.max(...database.records.map(r => r.id)) + 1 
                    : 1;
                database.records.push(record);
                showNotification('success', 'Record added successfully');
            }

            renderTable();
            updatePagination();
            closeAllModals();
        });

        // Confirm delete
        confirmDelete.addEventListener('click', function() {
            database.records = database.records.filter(r => r.id !== currentRecordId);
            showNotification('success', 'Record deleted successfully');
            renderTable();
            updatePagination();
            closeAllModals();
        });

        // Pagination
        prevPage.addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
                updatePagination();
            }
        });

        nextPage.addEventListener('click', function() {
            const totalPages = Math.ceil(database.records.length / recordsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
                updatePagination();
            }
        });

        // Functions
        function renderTable() {
            dataTableBody.innerHTML = '';
            
            const startIndex = (currentPage - 1) * recordsPerPage;
            const endIndex = Math.min(startIndex + recordsPerPage, database.records.length);
            const recordsToDisplay = database.records.slice(startIndex, endIndex);

            recordsToDisplay.forEach(record => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${record.id}</td>
                    <td>${record.name}</td>
                    <td>${record.email}</td>
                    <td><span class="px-2 py-1 rounded-full text-xs ${getRoleClass(record.role)}">${record.role}</span></td>
                    <td><span class="px-2 py-1 rounded-full text-xs ${getStatusClass(record.status)}">${record.status}</span></td>
                    <td>${record.created_at}</td>
                    <td>
                        <button class="btn btn-edit btn-sm mr-2 edit-btn" data-id="${record.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${record.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                dataTableBody.appendChild(row);
            });

            // Add event listeners to edit and delete buttons
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    editRecord(id);
                });
            });

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    confirmDeleteRecord(id);
                });
            });
        }

        function editRecord(id) {
            const record = database.records.find(r => r.id === id);
            if (record) {
                isEditing = true;
                currentRecordId = id;
                modalTitle.textContent = 'Edit Record';
                editName.value = record.name;
                editEmail.value = record.email;
                editRole.value = record.role;
                editStatus.value = record.status;
                recordModal.classList.add('active');
            }
        }

        function confirmDeleteRecord(id) {
            currentRecordId = id;
            deleteModal.classList.add('active');
        }

        function closeAllModals() {
            recordModal.classList.remove('active');
            deleteModal.classList.remove('active');
        }

        function updatePagination() {
            const totalPages = Math.ceil(database.records.length / recordsPerPage);
            const startRecord = (currentPage - 1) * recordsPerPage + 1;
            const endRecord = Math.min(currentPage * recordsPerPage, database.records.length);

            document.getElementById('start-record').textContent = startRecord;
            document.getElementById('end-record').textContent = endRecord;
            document.getElementById('total-records').textContent = database.records.length;

            prevPage.disabled = currentPage === 1;
            nextPage.disabled = currentPage === totalPages;
        }

        function updateConnectionStatus() {
            if (database.connected) {
                connectionStatus.classList.remove('disconnected');
                connectionStatus.classList.add('connected');
                connectionStatus.innerHTML = '<i class="fas fa-check-circle"></i><span>Connected</span>';
                connectionText.textContent = 'Disconnect';
                toggleConnection.classList.remove('btn-primary');
                toggleConnection.classList.add('btn-danger');
            } else {
                connectionStatus.classList.remove('connected');
                connectionStatus.classList.add('disconnected');
                connectionStatus.innerHTML = '<i class="fas fa-exclamation-circle"></i><span>Disconnected</span>';
                connectionText.textContent = 'Connect to Database';
                toggleConnection.classList.remove('btn-danger');
                toggleConnection.classList.add('btn-primary');
            }
        }

        function disconnectFromDatabase() {
            // In a real app, this would be an API call to disconnect
            database.connected = false;
            updateConnectionStatus();
            showNotification('success', 'Disconnected from database');
        }

        function getRoleClass(role) {
            switch (role) {
                case 'admin': return 'bg-purple-100 text-purple-800';
                case 'editor': return 'bg-blue-100 text-blue-800';
                case 'viewer': return 'bg-green-100 text-green-800';
                default: return 'bg-gray-100 text-gray-800';
            }
        }

        function getStatusClass(status) {
            switch (status) {
                case 'active': return 'bg-green-100 text-green-800';
                case 'inactive': return 'bg-yellow-100 text-yellow-800';
                case 'suspended': return 'bg-red-100 text-red-800';
                default: return 'bg-gray-100 text-gray-800';
            }
        }

        function showNotification(type, message) {
            notification.className = `notification ${type} show`;
            notificationMessage.textContent = message;
            
            if (type === 'success') {
                notification.querySelector('i').className = 'fas fa-check-circle';
            } else {
                notification.querySelector('i').className = 'fas fa-exclamation-circle';
            }

            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Mobile menu toggle (hidden in HTML but added here for completeness)
        const mobileMenuBtn = document.createElement('button');
        mobileMenuBtn.className = 'md:hidden fixed top-4 left-4 z-50 p-2 bg-gray-800 text-white rounded-lg';
        mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
        document.body.appendChild(mobileMenuBtn);

        mobileMenuBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    </script>



</body>
</html>
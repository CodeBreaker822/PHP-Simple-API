<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Test Examples</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .api-card {
            transition: transform 0.2s;
        }
        .api-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .method-badge {
            font-size: 0.9em;
            padding: 5px 10px;
        }
        .get-badge { background-color: #61affe; }
        .post-badge { background-color: #49cc90; }
        .put-badge { background-color: #fca130; }
        .patch-badge { background-color: #50e3c2; }
        .delete-badge { background-color: #f93e3e; }
        .source-link {
            background-color: #2d2d2d;
            color: #d4d4d4;
            border: 1px solid #404040;
            padding: 6px 12px;
            font-size: 0.9em;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .source-link:hover {
            background-color: #3d3d3d;
            color: #ffffff;
            border-color: #505050;
            text-decoration: none;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        /* VS Code-like styling */
        .code-modal .modal-dialog {
            max-width: 80%;
        }
        .code-modal .modal-content {
            background-color: #1e1e1e;
            color: #d4d4d4;
        }
        .code-modal .modal-header {
            border-bottom: 1px solid #333;
            padding: 0.5rem 1rem;
        }
        .code-modal .modal-title {
            color: #fff;
            font-size: 1rem;
        }
        .code-modal .modal-body {
            padding: 0;
        }
        .code-modal pre {
            margin: 0;
            padding: 1rem;
            background-color: #1e1e1e;
            color: #d4d4d4;
            font-family: 'Consolas', monospace;
            font-size: 14px;
            line-height: 1.5;
            overflow-x: auto;
        }
        .code-modal .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        .code-modal .line-numbers {
            color: #858585;
            text-align: right;
            padding-right: 1rem;
            user-select: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">API Test Examples</h1>
        
        <div class="row g-4">
            <!-- GET API Example -->
            <div class="col-md-6">
                <div class="card api-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">GET API Examples</h5>
                            <span class="badge method-badge get-badge">GET</span>
                        </div>
                        <p class="card-text">Test retrieving data from the API including:</p>
                        <ul>
                            <li>Get Classes</li>
                            <li>Get Students</li>
                            <li>Get Teachers</li>
                            <li>Get Grades</li>
                        </ul>
                        <div class="btn-group">
                            <a href="test_api/getAPIexample.php" class="btn btn-primary">Try GET Examples</a>
                            <a class="source-link" onclick="showSourceCode('get')">View Source</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- POST API Example -->
            <div class="col-md-6">
                <div class="card api-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">POST API Examples</h5>
                            <span class="badge method-badge post-badge">POST</span>
                        </div>
                        <p class="card-text">Test creating new records including:</p>
                        <ul>
                            <li>Add New Class</li>
                            <li>Add New Student</li>
                            <li>Add New Teacher</li>
                            <li>Add New Grade</li>
                        </ul>
                        <div class="btn-group">
                            <a href="test_api/postAPIexample.php" class="btn btn-success">Try POST Examples</a>
                            <a class="source-link" onclick="showSourceCode('post')">View Source</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PUT API Example -->
            <div class="col-md-6">
                <div class="card api-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">PUT API Examples</h5>
                            <span class="badge method-badge put-badge">PUT</span>
                        </div>
                        <p class="card-text">Test full updates of records including:</p>
                        <ul>
                            <li>Update Class (All Fields)</li>
                            <li>Update Student (All Fields)</li>
                            <li>Update Teacher (All Fields)</li>
                            <li>Update Grade (All Fields)</li>
                        </ul>
                        <div class="btn-group">
                            <a href="test_api/putAPIexample.php" class="btn btn-warning">Try PUT Examples</a>
                            <a class="source-link" onclick="showSourceCode('put')">View Source</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PATCH API Example -->
            <div class="col-md-6">
                <div class="card api-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">PATCH API Examples</h5>
                            <span class="badge method-badge patch-badge">PATCH</span>
                        </div>
                        <p class="card-text">Test partial updates of records including:</p>
                        <ul>
                            <li>Update Class (Partial)</li>
                            <li>Update Student (Partial)</li>
                            <li>Update Teacher (Partial)</li>
                            <li>Update Grade (Partial)</li>
                        </ul>
                        <div class="btn-group">
                            <a href="test_api/patchAPIexample.php" class="btn btn-info">Try PATCH Examples</a>
                            <a class="source-link" onclick="showSourceCode('patch')">View Source</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DELETE API Example -->
            <div class="col-md-6">
                <div class="card api-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">DELETE API Examples</h5>
                            <span class="badge method-badge delete-badge">DELETE</span>
                        </div>
                        <p class="card-text">Test deleting records including:</p>
                        <ul>
                            <li>Delete Class</li>
                            <li>Delete Student</li>
                            <li>Delete Teacher</li>
                            <li>Delete Grade</li>
                        </ul>
                        <div class="btn-group">
                            <a href="test_api/deleteAPIexample.php" class="btn btn-danger">Try DELETE Examples</a>
                            <a class="source-link" onclick="showSourceCode('delete')">View Source</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h3>API Documentation</h3>
            <div class="card">
                <div class="card-body">
                    <h5>Base URL</h5>
                    <code>http://localhost/Security2/api.php</code>
                    
                    <h5 class="mt-4">Authentication</h5>
                    <p>All requests require an API token passed as a query parameter:</p>
                    <code>?token=your_api_token</code>
                    
                    <h5 class="mt-4">Common Response Format</h5>
                    <pre><code>{
    "status": "success|error",
    "message": "Response message",
    "data": [] // Optional data array
}</code></pre>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Source Code Modals -->
    <div class="modal code-modal fade" id="sourceCodeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Source Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <pre><code id="sourceCodeContent"></code></pre>
                </div>
            </div>
        </div>
    </div>

    <!-- Add JavaScript for loading source code -->
    <script>
        function showSourceCode(type) {
            $.ajax({
                url: 'api.php',
                method: 'GET',
                data: {
                    getSource: type
                },
                dataType: 'text',
                success: function(data) {
                    // Add line numbers
                    const lines = data.split('\n');
                    const numberedLines = lines.map((line, index) => 
                        `<span class="line-numbers">${index + 1}</span> ${line}`
                    ).join('\n');
                    
                    $('#sourceCodeContent').html(numberedLines);
                    $('#sourceCodeModal .modal-title').text(`Source: api_routes/${type}.php`);
                    $('#sourceCodeModal').modal('show');
                },
                error: function() {
                    alert('Error loading source code');
                }
            });
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

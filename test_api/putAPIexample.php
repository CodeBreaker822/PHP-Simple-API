<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUT API Examples</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .loader {
            display: none;
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #3498db;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>PUT API Examples</h2>
            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#documentationModal">
                Put Documentation
            </button>
        </div>
        
        <div class="mb-3">
            <label for="apiToken" class="form-label">API Token:</label>
            <input type="text" class="form-control" id="apiToken" placeholder="Enter your API token">
        </div>

        <!-- Update Class Form Example -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Update Class Example (Full Update)</h5>
            </div>
            <div class="card-body">
                <form id="updateClassForm">
                    <div class="mb-3">
                        <label for="classId" class="form-label">Class ID:</label>
                        <input type="number" class="form-control" id="classId" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacity:</label>
                        <input type="number" class="form-control" id="capacity" required>
                    </div>
                    <div class="mb-3">
                        <label for="roomType" class="form-label">Room Type:</label>
                        <input type="number" class="form-control" id="roomType" required>
                    </div>
                    <div class="mb-3">
                        <label for="section" class="form-label">Section:</label>
                        <input type="text" class="form-control" id="section" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacherId" class="form-label">Teacher ID:</label>
                        <input type="text" class="form-control" id="teacherId" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Update Class</button>
                </form>
            </div>
        </div>
        
        <div class="loader" id="loader"></div>
        <div class="alert alert-danger mt-3" id="errorMessage" style="display: none;"></div>
        <div class="alert alert-success mt-3" id="successMessage" style="display: none;"></div>
        
        <div class="mt-4">
            <h5>Response:</h5>
            <pre><code id="responseData"></code></pre>
        </div>
    </div>
    
    <?php include("modals/putexamplemodal.php")?>

    <script>
        $(document).ready(function() {
            $('#updateClassForm').on('submit', function(e) {
                e.preventDefault();
                
                const token = $('#apiToken').val();
                const classId = $('#classId').val();
                
                if (!token) {
                    showError('Please enter an API token');
                    return;
                }

                if (!classId) {
                    showError('Please enter a Class ID');
                    return;
                }

                $('#loader').show();
                $('#errorMessage').hide();
                $('#successMessage').hide();
                $('#responseData').empty();

                $.ajax({
                    url: `http://localhost/PhpAPI/api.php?request=updateClass&id=${classId}&token=${token}`,
                    method: 'PUT',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        Capacity: $('#capacity').val(),
                        Room_Type: $('#roomType').val(),
                        Section: $('#section').val(),
                        Teacher_ID: $('#teacherId').val()
                    }),
                    success: function(response) {
                        $('#loader').hide();
                        $('#responseData').html(JSON.stringify(response, null, 2));
                        
                        if (response.status === 'success') {
                            $('#successMessage')
                                .text(response.message)
                                .show();
                            $('#updateClassForm')[0].reset();
                        } else {
                            showError(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#loader').hide();
                        showError('Error: ' + (xhr.responseJSON?.message || error));
                    }
                });
            });
        });

        function showError(message) {
            $('#errorMessage')
                .text(message)
                .show();
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

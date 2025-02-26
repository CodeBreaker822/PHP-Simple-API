<?php
require "includes/config.php";
require "includes/session.php";
require "includes/head.php";


$itemsPerPage = 5;
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
$startIndex = ($currentPage - 1) * $itemsPerPage;

$dataQuery = "SELECT id, user_name, token, canGET, canPOST, canPUT, canPATCH, canDELETE, status, last_modified 
              FROM api 
              LIMIT $startIndex, $itemsPerPage";
$dataResult = mysqli_query($conn, $dataQuery) or die(mysqli_error($conn));

$countQuery = "SELECT COUNT(*) AS total FROM api";
$countResult = mysqli_query($conn, $countQuery) or die(mysqli_error($conn));
$totalItemsRow = mysqli_fetch_assoc($countResult);
$totalItems = $totalItemsRow['total'];
$totalPages = ceil($totalItems / $itemsPerPage);
?>

<body>
    
    <section class="home-section">
        <div class="container-fluid m-0 p-4" style="height: 90vh;">
            <div class="seachbar my-3">
                <div class="row">
                    <div class="col-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by username" id="search-input">
                            <button class="btn btn-secondary" id="search-button">
                                <i class="bx bx-search align-middle"></i> Search
                            </button>
                            <a href="apimod.php" class="btn btn-warning text-white">Reset</a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex gap-2">
                            <a href="#addAPIModal" class="add-user-btn btn btn-success" data-bs-toggle="modal">
                                <i class="align-middle bx bxs-key" style="font-size: 22px;"></i> Generate API Token
                            </a>
                            <a href="testAPI.php" class="btn btn-primary" target="_blank">
                                <i class="align-middle bx bx-code-alt" style="font-size: 22px;"></i> Test API
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="container-fluid bg-white p-3 shadow-lg mb-3" style="margin-top: 30px; border:1px solid #d3d3d3;">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>User Name</th>
                            <th>Token</th>
                            <th>GET</th>
                            <th>POST</th>
                            <th>PUT</th>
                            <th>PATCH</th>
                            <th>DELETE</th>
                            <th>Active</th>
                            <th>Last Modified</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($result = mysqli_fetch_assoc($dataResult)) {
                        ?>
                            <tr>
                                <td><?php echo htmlentities($result['user_name']); ?></td>
                                <td style="max-width: 200px;">
                                    <span title="<?php echo htmlentities($result['token']); ?>" style="display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 255px;">
                                        <?php echo substr(htmlentities($result['token']), 0, 16) . '...'; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input permission-toggle" type="checkbox" 
                                               data-id="<?php echo $result['id']; ?>" 
                                               data-permission="canGET"
                                               <?php echo $result['canGET'] == 'true' ? 'checked' : ''; ?>>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input permission-toggle" type="checkbox" 
                                               data-id="<?php echo $result['id']; ?>" 
                                               data-permission="canPOST"
                                               <?php echo $result['canPOST'] == 'true' ? 'checked' : ''; ?>>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input permission-toggle" type="checkbox" 
                                               data-id="<?php echo $result['id']; ?>" 
                                               data-permission="canPUT"
                                               <?php echo $result['canPUT'] == 'true' ? 'checked' : ''; ?>>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input permission-toggle" type="checkbox" 
                                               data-id="<?php echo $result['id']; ?>" 
                                               data-permission="canPATCH"
                                               <?php echo $result['canPATCH'] == 'true' ? 'checked' : ''; ?>>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input permission-toggle" type="checkbox" 
                                               data-id="<?php echo $result['id']; ?>" 
                                               data-permission="canDELETE"
                                               <?php echo $result['canDELETE'] == 'true' ? 'checked' : ''; ?>>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox" 
                                               data-id="<?php echo $result['id']; ?>"
                                               <?php echo $result['status'] == 'true' ? 'checked' : ''; ?>>
                                    </div>
                                </td>
                                <td><?php echo htmlentities($result['last_modified']); ?></td>
                                <td class="text-center">
                                    <button class="btn btn-info btn-sm copy-token" data-token="<?php echo $result['token']; ?>">
                                        <i class="bx bx-copy"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm delete-token" data-id="<?php echo $result['id']; ?>">
                                        <i class="bx bx-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    
            <div class="pagination-container">
                <div class="pagination justify-content-end">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?php echo $currentPage - 1; ?>" class="page-link px-3 btn text-secondary">Back</a>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" 
                           class="page-link px-3 btn <?php echo $i == $currentPage ? 'active' : 'text-secondary'; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?php echo $currentPage + 1; ?>" class="page-link px-3 btn text-secondary">Next</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    
    <div id="addAPIModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addAPIForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Generate New API Token</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>User Name</label>
                            <input type="text" class="form-control" name="user_name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Permissions</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="canGET" checked>
                                <label class="form-check-label">GET</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="canPOST">
                                <label class="form-check-label">POST</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="canPUT">
                                <label class="form-check-label">PUT</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="canPATCH">
                                <label class="form-check-label">PATCH</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="canDELETE">
                                <label class="form-check-label">DELETE</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Generate Token</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    
	<script src="node_modules/jquery/dist/jquery.min.js"></script>
    
    <script>
    $(document).ready(function() {
        $('.permission-toggle, .status-toggle').change(function() {
            const $this = $(this);
            const id = $this.data('id');
            const permission = $this.data('permission') || 'status';
            const value = this.checked;
            
            $.ajax({
                url: 'update_token.php',
                method: 'POST',
                data: {
                    id: id,
                    permission: permission,
                    value: value.toString()
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status !== 'success') {
                        alert('Failed to update: ' + response.message);
                        $this.prop('checked', !value);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error updating permission: ' + error);
                    $this.prop('checked', !value);
                }
            });
        });
    
        $('.copy-token').click(function() {
            const token = $(this).data('token');
            
            // Create a temporary textarea element
            const textarea = document.createElement('textarea');
            textarea.value = token;
            textarea.setAttribute('readonly', '');
            textarea.style.position = 'absolute';
            textarea.style.left = '-9999px';
            document.body.appendChild(textarea);
            
            // Select the text and copy it
            textarea.select();
            try {
                const successful = document.execCommand('copy');
                if (successful) {
                    alert('Token copied to clipboard!');
                } else {
                    alert('Failed to copy token');
                }
            } catch (err) {
                alert('Failed to copy token: ' + err);
            }
            
            // Clean up
            document.body.removeChild(textarea);
        });
    
        $('.delete-token').click(function() {
            if (confirm('Are you sure you want to delete this API token?')) {
                const id = $(this).data('id');
                $.ajax({
                    url: 'delete_token.php',
                    method: 'POST',
                    data: { id },
                    success: function(response) {
                        if (response.status === 'success') {
                            location.reload();
                        } else {
                            alert('Failed to delete token');
                        }
                    }
                });
            }
        });
    
        $('#addAPIForm').submit(function(e) {
            e.preventDefault();
            
            const formData = {
                user_name: $('input[name="user_name"]').val(),
                canGET: $('input[name="canGET"]').is(':checked').toString(),
                canPOST: $('input[name="canPOST"]').is(':checked').toString(),
                canPUT: $('input[name="canPUT"]').is(':checked').toString(),
                canPATCH: $('input[name="canPATCH"]').is(':checked').toString(),
                canDELETE: $('input[name="canDELETE"]').is(':checked').toString()
            };
            
            $.ajax({
                url: 'generate_token.php',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        const message = `Token generated successfully!\n\n` +
                                      `Token: ${response.data.token}\n` +
                                      `Username: ${response.data.username}\n\n` +
                                      `Permissions:\n` +
                                      `GET: ${response.data.permissions.canGET}\n` +
                                      `POST: ${response.data.permissions.canPOST}\n` +
                                      `PUT: ${response.data.permissions.canPUT}\n` +
                                      `PATCH: ${response.data.permissions.canPATCH}\n` +
                                      `DELETE: ${response.data.permissions.canDELETE}`;
                                      
                        alert(message);
                        location.reload();
                    } else {
                        alert('Failed to generate token: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error details:', {xhr, status, error});
                    alert('Error: ' + error);
                }
            });
        });
    });
    </script>
</body>

    
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>

        var currentRow = null;
        
        // Context menu
        document.addEventListener("contextmenu", function (event) {
            event.preventDefault();

            if (event.target.closest("tr")) {
                event.preventDefault();
                currentRow = event.target.closest(".user_row");
                var contextMenu = document.getElementById("contextMenu");
                var x = event.pageX;
                var y = event.pageY;

                contextMenu.style.left = x + "px";
                contextMenu.style.top = y + "px";
                contextMenu.style.display = "block";
            }
        });

        // Hide the context menu when clicking elsewhere
        document.addEventListener("click", function (event) {
            var contextMenu = document.getElementById("contextMenu");
            contextMenu.style.display = "none";
        });

        document.getElementById('confirmDelete').addEventListener('click', function() {
            if (currentRow) {
                var empId = currentRow.getElementsByTagName("td").emp_id.textContent;
                var u_name = currentRow.getElementsByTagName("td").emp_username.textContent;
                var acc_type = currentRow.getElementsByTagName("td").emp_accounttype.textContent;

                var formData = new FormData();
                formData.append('employee_number', empId);
                formData.append('username', u_name);
                formData.append('account_type', acc_type);

                // console.log(empId, u_name, acc_type);

                fetch('../api/delete_user.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.response === 100) {
                        alert("Record deleted successfully.");
                        location.reload();
                    } else {
                        alert("Failed to delete record: " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
                $('#deleteModal').modal('hide');
            }
        });

        // Context menu actions
        function viewDetails() {
            if (currentRow) {
                var empId = currentRow.getAttribute("data-id");
                window.location.href = 'employee_details.php?employee_number=' + empId;
            }
        }

        function editRecord() {
            if (currentRow) {
                var empId = currentRow.getElementsByTagName("td").emp_id.textContent;
                var u_name = currentRow.getElementsByTagName("td").emp_username.textContent;
                var acc_type = currentRow.getElementsByTagName("td").emp_accounttype.textContent;
                window.location.href = 'edit_user.php?employee_number=' + empId + '&username=' + u_name + '&account_type=' + acc_type;
            }
        }

        function deleteRecord() {
            $('#deleteModal').modal('show');
        }

    </script>
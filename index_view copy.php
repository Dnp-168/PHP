<!DOCTYPE html>
<html>

<head>
    <title>User List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <h1>User List</h1>
    <a href="index.php?action=create" style="float:right">Add New Record</a>
   <!-- ... Your table and other content ... -->
   <table id="usersTable" border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>
    <?php if (!empty($users)) : ?>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['gender']; ?></td>
                <td><?php echo $user['phone']; ?></td>
                <td>
                    <!-- Your edit and delete links here -->
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="6">No users found.</td>
        </tr>
    <?php endif; ?>
</table>

<!-- Pagination -->
<div class="pagination">
<button class="page-link" onclick="loadUsers(1)">First</button>
    <button class="page-link" onclick="loadUsers(currentPage - 1)" id="prevButton">Previous</button>
    <!-- Pagination buttons will be inserted here using JavaScript -->
    <button class="page-link" onclick="loadUsers(currentPage + 1)" id="nextButton">Next</button>
    <button class="page-link" onclick="loadUsers(response.totalPages)" id="lastButton">Last</button> 
</div>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <script>
    var currentPage = 1; // Set the initial page number

    function loadUsers(page) {
        $.ajax({
            url: 'load_users.php',
            data: { page: page },
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var usersTable = document.getElementById('usersTable'); // Get the element
                usersTable.innerHTML = ""; // Clear previous content

                response.users.forEach(function(user) {
                    var row = "<tr>";
                    row += "<td>" + user.id + "</td>";
                    row += "<td>" + user.name + "</td>";
                    row += "<td>" + user.email + "</td>";
                    row += "<td>" + user.gender + "</td>";
                    row += "<td>" + user.phone + "</td>";
                    row += "<td> ... </td>"; // Add action links
                    row += "</tr>";
                    usersTable.innerHTML += row;
                });

                // var paginationButtons = "";
                // for (var i = 1; i <= response.totalPages; i++) {
                //     paginationButtons += "<button class='page-link' onclick='loadUsers(" + i + ")'>" + i + "</button>";
                // }
                // $(".pagination").html(paginationButtons);
                currentPage = page;

                // Enable/disable Previous, First, Last, and Next buttons based on the current page
                $("#prevButton").prop("disabled", currentPage === 1);
                $("#nextButton").prop("disabled", currentPage === response.totalPages);
            }
        });
    }
    
    $(document).ready(function () {
        loadUsers(currentPage);
    });
</script>

</body>
</html>
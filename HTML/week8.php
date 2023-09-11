<!DOCTYPE html>
<html>
<head>
    <title>Edit Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to load the list of people when the page opens
            function loadPeople() {
                $.ajax({
                    url: 'week8.ajaxphp',
                    type: 'POST',
                    data: { command: '' },
                    dataType: 'json',
                    success: function(data) {
                        // Display the list of people
                        var table = $('#peopleTable');
                        table.empty();
                        $.each(data, function(index, person) {
                            table.append('<tr><td>' + person.first_name + '</td><td>' + person.last_name + '</td><td>' + person.phone_number + '</td><td><button class="deleteBtn" data-id="' + person.id + '">Delete</button></td></tr>');
                        });
                    }
                });
            }

            // Call the loadPeople function to populate the list initially
            loadPeople();

            // Form submit event handler
            $('#insertForm').submit(function(e) {
                e.preventDefault();
                var firstName = $('#firstNameInput').val();
                var lastName = $('#lastNameInput').val();
                var phoneNumber = $('#phoneNumberInput').val();

                // Insert command with form data
                $.ajax({
                    url: 'week8.ajaxphp',
                    type: 'POST',
                    data: { command: 'insert', firstName: firstName, lastName: lastName, phoneNumber: phoneNumber },
                    success: function(response) {
                        // Reload the list of people after successful insertion
                        loadPeople();

                        // Clear the input fields
                        $('#firstNameInput').val('');
                        $('#lastNameInput').val('');
                        $('#phoneNumberInput').val('');

                        // Display a success message (you can customize this part)
                        alert(response.message);
                    },
                    dataType: 'json'
                });
            });

            // Delete button click event handler
            $(document).on('click', '.deleteBtn', function() {
                var id = $(this).data('id');

                // Delete command with person ID
                $.ajax({
                    url: 'week8.ajaxphp',
                    type: 'POST',
                    data: { command: 'delete', id: id },
                    success: function(response) {
                        // Reload the list of people after successful deletion
                        loadPeople();

                        // Display a success message (you can customize this part)
                        alert(response.message);
                    },
                    dataType: 'json'
                });
            });
        });
    </script>
</head>
<body>
    <h1>Edit Page</h1>

    <h2>People List</h2>
    <table id="peopleTable">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>
    </table>

    <h2>Add Person</h2>
    <form id="insertForm">
        <label for="firstNameInput">First Name:</label>
        <input type="text" id="firstNameInput" name="firstNameInput" required><br>

        <label for="lastNameInput">Last Name:</label>
        <input type="text" id="lastNameInput" name="lastNameInput" required><br>

        <label for="phoneNumberInput">Phone Number:</label>
        <input type="text" id="phoneNumberInput" name="phoneNumberInput" required><br>

        <input type="submit" value="Insert">
    </form>
</body>
</html>

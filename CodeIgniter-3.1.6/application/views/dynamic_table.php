<!DOCTYPE html>
<html>

<head>
    <title>Dynamic Table with Dependent Dropdowns</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <form id="myForm">
        <div>
            <label for="datepicker">Select Date:</label>
            <input type="text" id="datepicker" name="datepicker">
        </div>
        <div>
            <label for="country">Select Country:</label>
            <?php
            $options = array();
            foreach ($countries as $country) {
                $options[$country['country']] = $country['country'];
            }
            echo form_dropdown('country', $options, '', 'id="country"');
            ?>
        </div>

        <table id="myTable" style="display: none;">
            <thead>
                <tr>
                    <th>State</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select class="stateSelect" name="state[]">
                            <option value="">Select State</option>
                        </select>
                    </td>
                    <td><input type="text" name="quantity[]" /></td>
                   
                    <td><input type="text" name="total[]" readonly /></td>
                    <td><button type="button" id="addRow">Add Row</button><td>

                    <td><button type="button" class="removeRow">Remove</button></td>
                </tr>
            </tbody>
        </table>

        <!-- <button type="button" id="addRow">Add Row</button> -->

        <script>
            $(document).ready(function () {
                // Initialize the datepicker
                $("#datepicker").datepicker();
                var price = 0;
                // Event handler for country select change
                $("#country").on("change", function () {
                    var selectedCountry = $(this).val();
                    console.log("Selected country: " + selectedCountry);

                    // Show the table when a country is selected
                    $("#myTable").show();

                    // Populate the state dropdown based on the selected country
                    var states = <?= json_encode($countries); ?>;
                    console.log(states);
                    var stateSelect = $(".stateSelect");
                    stateSelect.empty();
                    stateSelect.append('<option value="">Select State</option>');
                    states.forEach(function (country) {
                        if (country.country === selectedCountry) {
                            country.states.forEach(function (state) {
                                stateSelect.append('<option value="' + state + '">' + state + '</option>');
                            });
                        }
                    });
                });

                $(document).on("change", ".stateSelect", function () {
                    var selectedState = $(this).val();
                    

                    var country = $("#country").val();
                    var states = <?= json_encode($countries); ?>;
                    states.forEach(function (country) {
                        if (country.country === $("#country").val()) {
                            country.states.forEach(function (state) {
                                if (state === selectedState) {
                                    price = country.price;
                                }
                            });
                        }
                    });

                    // $(this).closest("tr").find("input[name='price[]']").val(price);
                });

                // Event handler for quantity input change
                $(document).on("input", "input[name='quantity[]']", function () {
                    var row = $(this).closest("tr");
                    var quantity = $(this).val();
                    // var price = row.find("input[name='price[]']").val();
                    console.log(price);
                    var total = quantity * price;
                    row.find("input[name='total[]']").val(total);
                });

                // Event handler for add row button click
                $("#addRow").on("click", function () {
                    var lastRow = $("#myTable tbody tr:last");
                    var newRow = lastRow.clone();
                    newRow.find("input").val("");
                    newRow.find("select").val("");
                    lastRow.after(newRow);
                });

                // Event handler for remove row button click
                $(document).on("click", ".removeRow", function () {
                    $(this).closest("tr").remove();
                });
            });
        </script>
    </form>
</body>

</html>
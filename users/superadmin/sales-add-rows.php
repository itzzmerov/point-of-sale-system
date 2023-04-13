<?php 

include '../../includes/config.php';

// Generate options for the select element
$options = "";
$sql2 = "SELECT * FROM categories";
$result = $conn->query($sql2);
while ($row = $result->fetch_assoc()) {
    $options .= "<option value='" . $row["category_id"] . "'>" . $row["category_description"] . "</option>";
}

// Return the generated HTML content as response
$response = '<tr>
                <td>
                    <select id="category" name="category[]" class="form-select category" required>
                        <option selected hidden value="">Select Category Here...</option>'
                        . $options .
                    '</select>
                </td>
                <td>
                    <select id="name" name="name[]" class="form-select name" required onchange="fetchProductPrice(this)">

                    </select>
                </td>
                <td><input type="number" name="quantity[]" class="form-control quantity" min="1" required></td>
                <td><input type="number" name="price[]" class="form-control price" step="0.01" readonly></td>
                <td><input type="number" name="discount[]" class="form-control discount" value="0" step="0.01" min="0" max="100"></td>
                <td><input type="number" name="subtotal[]" class="form-control subtotal" step="0.01" readonly></td>
                <td><button type="button" class="btn btn-danger delete-product"><i class="fa fa-trash"></i></button></td>
            </tr>';

echo $response;
?>
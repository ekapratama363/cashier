<table id="" border="1" class="ExcelTableXP" style="width:100%; border-bottom: none">
    <thead>
        <tr>
            <th style="text-align:left !important;padding:2px">
                <button type="button" onclick="addRow()" title="Add Row" class="btn btn-success btn-sm"><i
                        class="fa fa-plus fa-sm"></i></button>
            </th>
        </tr>
    </thead>
</table>

<div id="detail_complain">
    <div
        style="width: 100%; max-height:500px; height:450px; overflow: auto; border:1px solid #ACA899; table-layout:fixed;">

        <table class="ExcelTableXP" border="1" style="border-left: none; border-right: none; width: 100%"
            id="productTable">
            <thead>
                <tr>
                    <th class="text-center" style="width:25px;">No</th>
                    <th class="text-center" style="width:250px;">Product Code</th>
                    <th class="text-center" style="width:15px;"></th>
                    <th class="text-center" style="width:200px;">Product Name</th>
                    <th class="text-center" style="width:400px;">Description</th>
                    <th class="text-center" style="width:50;">Price</th>
                    <th class="text-right" style="width:25px;">Quantity</th>
                    <th class="text-right" style="width:150px;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" 
                            class="no1"
                            name="no[1]" id="no1" 
                            value="1" 
                            readonly
                            style="text-align:center; border: none; width: 100%;">
                    </td>
                    <td>
                        <select class="product_id" onchange="onChangeProduct(1, this)" name="product_id[1]"
                            id="product_id1" style="float:left; width: 100%; height: 27px" required>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm"
                            onclick="deleteRowProductTable(this)">Remove</button>
                    </td>
                    <td>
                        <input type="text" name="name[1]" id="name1" style="float:left; width: 100%; border: none"
                            required readonly>
                    </td>
                    <td>
                        <input type="text" name="description[1]" id="description1"
                            style="float:left; width: 100%; border: none" required readonly>
                    </td>
                    <td>
                        <input type="text" name="price[1]" id="price1"
                            value="200"
                            style="text-align:right; width: 100%; border: none; padding: 10px"
                            required readonly>
                    </td>
                    <td>
                        <input type="number" name="quantity[1]" id="quantity1" 
                            style="text-align:right; width: 100%;"
                            onkeyup="updateTotalPrice(1, this)"
                            required>
                    </td>
                    <td>
                        <input type="text" name="subtotal[1]" id="subtotal1"
                            style="text-align:right; width: 100%; border: none; padding: 10px"
                            onchange="updateTotalPrice(1, this)"
                            required readonly>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<br>
<table id="" border="1" class="" style="width:100%; ">
    <thead>
        <tr>
            <td rowspan="4">
                <textarea name="note" class="form-control" id="note" cols="30" rows="100" 
                    style="border:none; padding: 0; margin: 0"
                    placeholder="Write something..."></textarea>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px">Total</td>
            <td>
                <input type="number" name="total" 
                    id="total"
                    value="0" class="form-control"
                    style="border:none; text-align:right;" readonly>
            </td>
        </tr>
            <td style="padding: 10px">Pay</td>
            <td>
                <input type="number" name="pay" 
                    id="pay"
                    value="0" class="form-control"
                    onkeyup="onKeyUpPay()"
                    style="border:none; text-align:right;">
            </td>
        <tr>
            <td style="padding: 10px">Refund</td>
            <td>
                <input type="number" name="refund"
                    id="refund" 
                    value="0" class="form-control"
                    style="border:none; text-align:right;" readonly>
            </td>
        </tr>
    </thead>
</table>

<script src="<?php echo base_url(); ?>assets/js/lib/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        loadSelect2(-1);
    });
</script>

<script>

    let click = 1;
    function addRow() {
        let index = click += 1;

        let assetTable = document.getElementById('productTable').tBodies[0];
        let lastRowIndex = assetTable.rows.length;
        let newRow = assetTable.insertRow(lastRowIndex)
        let cell1 = newRow.insertCell(0);
        let cell2 = newRow.insertCell(1);
        let cell3 = newRow.insertCell(2);
        let cell4 = newRow.insertCell(3);
        let cell5 = newRow.insertCell(4);
        let cell6 = newRow.insertCell(5);
        let cell7 = newRow.insertCell(6);
        let cell8 = newRow.insertCell(7);

        cell1.innerHTML = `
            <input type="text" 
                class="no${index}"
                name="no[${index}]" id="no${index}" 
                value="${lastRowIndex + 1}" 
                readonly
                style="text-align:center; border: none; width: 100%";>
        `;

        cell2.innerHTML = `<select class="product_id${index}"
                            onchange="onChangeProduct(${index}, this)"
                            name="product_id[${index}]" 
                            id="product_id${index}" 
                            style="float:left; width: 100%; height: 27px"
                            required>
                        </select>`;

        cell3.innerHTML = `<button type="button" class="btn btn-danger btn-sm" onclick="deleteRowProductTable(this)">Remove</button>`;

        cell4.innerHTML = `<input type="text" 
                            name="name[${index}]" 
                            id="name${index}" 
                            style="float:left; width: 100%; border: none"
                            required readonly>`;


        cell5.innerHTML = `<input type="text" 
                            name="description[${index}]" 
                            id="description${index}" 
                            style="float:left; width: 100%; border: none"
                            required readonly>`

        cell6.innerHTML = ` <input type="text" 
                            name="price[${index}]" 
                            id="price${index}" 
                            value="300"
                            style="text-align:right; width: 100%; border: none; padding: 10px"
                            required readonly>`;

        cell7.innerHTML = `<input type="number" 
                            name="quantity[${index}]" 
                            id="quantity${index}" 
                            style="text-align:right; width: 100%;"
                            onkeyup="updateTotalPrice(${index}, this)"
                            required>`;

        cell8.innerHTML = ` <input type="text" 
                            name="subtotal[${index}]" 
                            id="subtotal${index}" 
                            onchange="updateTotalPrice(${index}, this)"
                            style="text-align:right; width: 100%; border: none; padding: 10px"
                            required readonly>`;

        loadSelect2(index);
    }

    function loadSelect2(index){
        var product_id;

        if (index == -1) {
            product_id = $(`.product_id`)
        } else {
            product_id = $(`.product_id${index}`)
        }

        product_id.select2({
            // allowClear: true,
            // placeholder: "Choose product",
            ajax: {
                url: '<?php echo base_url(); ?>product/ajax_product',
                dataType: 'json',
                type: 'GET',
                delay: 250,
                processResults: function (data){
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: ` ${item.title} - ${item.description} `,
                                id: item.id
                            }
                        })
                    };
                },
            }
        });
    }

    function onChangeProduct(index, field) {

        var id_product_selected = field.value ? field.value : 0;

        $.get(`<?php echo base_url(); ?>product/ajax_by_id/${id_product_selected}`, function(data, status){
            var response = JSON.parse(data)
            // console.log('response ', response)

            $(`#name${index}`).val(response.title);
            $(`#description${index}`).val(response.description);
        });
    }

    function updateTotalPrice(index, field) {

        var id_product_quantity_selected = field.value ? field.value : 0;
        var price = $(`#price${index}`).val();

        var subtotal = parseInt(id_product_quantity_selected) * parseInt(price);

        $(`#subtotal${index}`).val(subtotal);

        var count_subtotal = [];
        for(var i = 1; i <= index; i++) {
            count_subtotal.push($(`#subtotal${i}`).val());
        }

        var total = count_subtotal.reduce((a, b) => parseInt(a) + parseInt(b), 0)
        
        $(`#total`).val(total);
    }

    function onKeyUpPay() {
        var pay = $('#pay').val();
        var total = $('#total').val();

        var refund = parseInt(pay) - parseInt(total);
        
        refund < 0 ? $('#refund').val(0) : $('#refund').val(refund);

        
    }

    function deleteRowProductTable(row) {
        var d = row.parentNode.parentNode.rowIndex;
        document.getElementById('productTable').deleteRow(d);
    }
</script>
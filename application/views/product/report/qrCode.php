<?php
    //Load composer's autoloader
    require_once 'vendor/autoload.php';

    use chillerlan\QRCode\{QRCode, QROptions};
?>

<?php if($products) { ?>
    <table border="0.1">
        <?php foreach($products as $product) { ?>
            <tr>
                <td>
                    <img src='<?php echo (new QRCode)->render($product->id); ?>' alt='QR Code' width='100'/>
                </td>
                <td style="border: none; padding: 10">
                    <span style='display: block; font-weight: bold;'>CASHIER APP</span>
                    <span style='display: block;'><?php echo $product->title; ?></span>
                    <span style='display: block;'><?php echo $product->description; ?></span>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>

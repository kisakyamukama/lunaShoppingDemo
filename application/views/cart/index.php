<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Luna shopping cart</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>"/>
    <script>
    /* Update item quantity */
    function updateCartItem(obj, rowid){
        $.get("<?php echo base_url('cart/updateItemQty/'); ?>", {rowid:rowid, qty:obj.value}, function(resp){
            if(resp == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
    </script>
</head>
<body class="container">



<h2>Luna Shopping Cart</h2>
<div class="row cart">
    <table class="table">
    <thead>
        <tr>
            <th width="10%"></th>
            <th width="30%">Product</th>
            <th width="15%">Price</th>
            <th width="13%">Quantity</th>
            <th width="20%">Subtotal</th>
            <th width="12%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if($this->cart->total_items() > 0){ foreach($cartItems as $item){    ?>
        <tr>
            <td>
                <?php $imageURL = !empty($item["image"])?base_url('assets/images/'.$item["image"]):base_url('assets/images/pro-demo-img.jpeg'); ?>
                <img src="<?php echo $imageURL; ?>" width="50"/>
            </td>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo $item["price"].' UGX'; ?></td>
            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this,'<?php echo $item["rowid"]; ?>')"></td>
            <td><?php echo $item["subtotal"].' UGX'; ?></td>
            <td>
                <a href="<?php echo base_url('index.php/cart/removeItem/'.$item["rowid"]); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="6"><p>Your cart is empty.....</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td><a href="<?php echo base_url('index.php/products/'); ?>" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a></td>
            <td colspan="3"></td>
            <?php if($this->cart->total_items() > 0){ ?>
            <td class="text-left">Grand Total: <b><?php echo $this->cart->total().' UGX'; ?></b></td>
            <td><a href="<?php echo base_url('index.php/checkout/'); ?>" class="btn btn-success btn-block">Checkout <i class="glyphicon glyphicon-menu-right"></i></a></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
</div>
    
</body>
</html>
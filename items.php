<?php
    $_title = 'Product';
    $page = 'items';
    // require_once(__DIR__.'/../components/header.php'); // This one doesnt take variables
    require_once('components/header.php');
    require_once('components/session-check.php');   
?>  
<div id="itemsPage">
    <?php 
     require_once('components/main-nav.php');   
    ?>
    <main>
        <h1>PRODUCTS</h1>
        <div id="uploadArea">
            <form onsubmit="validate(uploadItem); return false">
                <input 
                    type="text" 
                    name="item_name"
                    data-validate="str"
                    data-min="2"
                    data-max="20"
                    class="nameInput"
                    placeholder="Product name"
                    >
                    <input
                    type="number" 
                    name="item_price"
                    step=".01"
                    data-validate="str"
                    data-min="1"
                    class="priceInput"
                    placeholder="Price DKK"
                >
                <button>Create product</button>
            </form>
        </div>
            <table  id="items" cellspacing="0">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th class="updateItemHeader">Update</th>
                    <th class="deleteItemHeader">Delete</th>
                </tr>
                
            </table>
            
            
            <div onclick="cancel()" id="deleteModal" class="modal">
                <div class="modalContent">
                    <p class="modalText"></p>
                    <div class="actions">
                        <button onclick="deleteItem()" type="button" class="confirmBtn">Delete</button>
                        <button onclick="cancel()" type="reset" class="cancelBtn">Cancel</button>
                    </div>
                </div>
            </div>
            

            <div onclick="cancel()" id="updateModal" class="modal">
                <div class="modalContent">
                    <p class="modalText"></p>
                    <form onsubmit="validate(updateItem); return false">
                        <input 
                            type="text" 
                            name="item_name"
                            data-validate="str"
                            data-min="2"
                            data-max="20"
                            class="nameInput"
                            placeholder="Product name"
                        >
                        <input 
                            type="number" 
                            step=".01"
                            name="item_price"
                            data-validate="str"
                            data-min="1"
                            class="priceInput"
                            placeholder="Price DKK"
                        >
                        <!-- <input type="text" class="hiddenInput" name="item_id"> -->
                        <div class="actions">
                            <button type="submit" class="confirmBtn">Update</button>
                            <button onclick="cancel()" type="reset" class="cancelBtn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

    </main>
</div>
<script src="js/validator.js"></script>
<script src="js/items.js"></script>
<?php
    require_once('components/footer.php');
?>


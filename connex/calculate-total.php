<?php 
    $total = 0;
    foreach ($_SESSION as $key=>$val){
        $product_id_number_without_p = substr($key, -6);    // returns "f"
        $name = return_info($conn, 'products', 'name', 'id', $product_id_number_without_p);
        $price = return_info($conn, 'products', 'price', 'id', $product_id_number_without_p);
        $image = return_info($conn, 'products', 'image', 'id', $product_id_number_without_p);
    echo("
    <article class='product-miniature js-product-miniature' data-id-product='4637' data-id-product-attribute='1988'>
    <div class='thumbnail-container'>

        <div class='product-left'>
            <div class='product-image-container'>


                <a href='#' class='thumbnail product-thumbnail'>
                    <img src='images/$image' alt='Pioneer CDJ 350 Multi...' data-full-size-image-url='https://connexstore.co.za/11814-large_default/pioneer-cdj-350-multi-player-usbcd-refurbished.jpg' width='259' height='259'>
                    </a>
                    
                    
                    
                    <a class='quick-view' href='#' data-link-action='quickview'>
                    <i class='material-icons search'>&#xE8B6;</i>Quick view
                </a>

            </div>
        </div>

        <div class='product-right'>
            <div class='product-description'>
                <p class='pl_reference'>
                    Reference:
                    <span><strong>Pioneer CDJ 350</strong></span>
                </p>

                <p class='pl_manufacturer'>
                    Brand:
                    <a href='#' title='pioneer'><strong>pioneer</strong></a>
                </p>
                
                
                <h3 class='h3 product-title'><a href='#'>$name</a></h3>
                
                
                
                <div class='comments_note'>
                <div class='star_content clearfix'>
                        <div class='star'></div>
                        <div class='star'></div>
                        <div class='star'></div>
                        <div class='star'></div>
                        <div class='star'></div>
                    </div>
                    <span class='nb-comments'><span class='pull-right'>Review(s): <span>0</span></span></span>
                </div>
                <div class='roja45quotationspro product enabled' data-id-product='4637' data-id-product-attribute='1988' data-minimal-quantity='1' style='display:none;'></div>



                <p class='product-desc'>

                    Free delivery available or express delivery available.
                    Hassle-Free exchanges &amp;amp; returns for 30 days.
                    12-Month Limited Warranty
                    Same day collection or delivery if paid before 10am (JHB)




                    Available Payment Options

                    EFT (Bank Transfer)
                    Visa, Master card and Credit Card
                    Installment zero pay (3 Months to pay)
                    Installment mobicred (12 Months to pay)



                </p>

            </div>

            <div class='product-bottom'>

                <div class='product-price-and-shipping'>


                    <span class='sr-only'>Price</span>
                    <span class='price'> R $price</span>


                    <span class='sr-only'>Regular price</span>
                    <span class='regular-price'>R 16,500.00</span>




                </div>


                <div class='button-container'>



                <form action='load-page.php' method='post'>
                <button class='btn add-to-cart' name='remove_from_cart' type='submit'>
                    <i class='material-icons shopping-cart'></i>
                    Remove 
                </button>
                <input type='hidden' name='id' value='$product_id_number_without_p'>
            </form>

                    <a class='button lnk_view btn' href='#' title='More'>
                        <span>More</span>
                    </a>

                </div>

                <div class='availability'>

                <span class='pl-availability'>
                <i class='material-icons product-available'></i>
                In Stock
            </span>



                </div>

                <div class='highlighted-informations no-variants hidden-sm-down'>
                

                </div>
            </div>
        </div>

        <div class='clearfix'></div>

    </div>
</article>
    ");
    $total += $price;
    }

?>

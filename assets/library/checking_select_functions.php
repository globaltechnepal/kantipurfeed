<?php
echo json_encode(get_Table_Data("SELECT pv.id,pv_img.img_path,pv_img.img,p.product_name,clr.color_name,p.actual_Price,p.sell_Price,o.quantity 
              from orders o
              inner join productvariant pv on o.product_variant_id=pv.id
              inner join productvariant_image pv_img on pv_img.product_varient_id=pv.id
              inner join products p on pv.product_id=p.id
              inner join colors clr on pv.color_id=clr.id
              where cart_id=9;"));
              ?>
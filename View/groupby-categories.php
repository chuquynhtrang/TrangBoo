<!DOCTYPE html>
<html lang="en">
<?php
include_once 'menu.php';
?>

<div class="content">
    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="index.php?controller=CategoryController&action=index&page=1">List Categories</a></li>
        </ul>

    </div>
    <div class="workplace">

        <div class="row-fluid">
            <div class="span12 search">
                <form method="GET" action="index.php">
                    <input type="hidden" class="" name="controller" value="ProductController"/>
                    <input type="hidden" class="" name="action" value="index"/>
                    <input type="hidden" class="" name="category_id" value="<?php if(isset($_GET['category_id'])) echo $_GET['category_id'];?>">
                    <input type="text" class="span11"  name="search" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>"/>
                    <input type="hidden" class="" name="page" value="1"/>
                    <button class="btn span1" type="submit">Search</button>
            </div>
        </div>
    <div class="row-fluid">

        <div class="span12">
            <div class="head">
                <div class="isw-grid"></div>
                <h1>Products Management</h1>

                <div class="clear"></div>
            </div>
            <div class="block-fluid table-sorting">
                <a href="index.php?controller=ProductController&action=viewAddProduct" class="btn btn-add">Add Product</a>
                <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                    <thead>
                    <form method="POST" action="index.php?controller=ProductController&action=index">
                        <?php
                        if(!isset($_GET['order']) || $_GET['order']=='desc'){
                            $order = 'asc';
                        } else if($_GET['order']=='asc' ||$_GET['order']!=$order){
                            $order = 'desc';
                        }
                        $class ='';
                        if(isset($_GET['sort'])){
                            if($_GET['order'] == 'desc')
                                $class = 'sorting_desc';
                            else
                                $class = 'sorting_asc';
                        }
                        if(isset($_GET['search']))
                            $href_search="index.php?controller=ProductController&action=index&&category_id=".$_GET['category_id']."search=".$_GET['search'];
                        $href="index.php?controller=ProductController&action=index&category_id=".$_GET['category_id'];
                        ?>
                        <tr>
                            <th><input type="checkbox" id="checkAll"/></th>
                            <?php if(isset($_GET['search'])){ ?>
                                <th width="10%" class=<?php echo $class;?>>
                                    <a href="<?php echo $href_search;?>&sort=id&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>" id="sortId">ID</a>
                                </th>
                                <th width="20%" class="<?php echo $class;?>">
                                    <a href="<?php echo $href_search;?>&sort=productname&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Productname</a>
                                </th>
                                <th width="10%" class="<?php echo $class;?>">
                                    <a href="<?php echo $href;?>&sort=categoryname&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Category</a>
                                </th>
                                <th width="15%" class="<?php echo $class;?>">
                                    <a href="<?php echo $href_search;?>&sort=price&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Price</a>
                                </th>
                                <th width="15%" class="<?php echo $class;?>">
                                    <a href="<?php echo $href_search;?>&sort=activate&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Activate</a>
                                </th>
                                <th width="10%" class="<?php echo $class;?>">
                                    <a href="<?php echo $href_search;?>&sort=time_created&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Time Created</a>
                                </th>
                                <th width="10%" class="<?php echo $class;?>">
                                    <a href="<?php echo $href_search;?>&sort=time_updated&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Time Updated</a>
                                </th>
                                <th width="10%">Action</th>
                            <?php }else{ ?>
                                <th width="10%" class=<?php echo $class;?>>
                                    <a href="<?php echo $href;?>&sort=id&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>" id="sortId">ID</a>
                                </th>
                                <th width="20%" class="<?php echo $class;?>">
                                    <a href="<?php echo $href;?>&sort=productname&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Productname</a>
                                </th>
                                <th width="10%" class="<?php echo $class;?>">
                                    <a href="<?php echo $href;?>&sort=categoryname&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Category</a>
                                </th>
                                <th width="15%" class="<?php echo $class;?>">
                                    <a href="<?php echo $href;?>&sort=price&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Price</a>
                                </th>
                                <th width="15%" class="<?php echo $class;?>">
                                    <a href="<?php echo $href;?>&sort=activate&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Activate</a>
                                </th>
                                <th width="10%" class="<?php echo $class;?>">
                                    <a href="<?php echo $href;?>&sort=time_created&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Time Created</a>
                                </th>
                                <th width="10%" class="<?php echo $class;?>">
                                    <a href="<?php echo $href;?>&sort=time_updated&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Time Updated</a>
                                </th>
                                <th width="10%">Action</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data_limit as $key) {?>
                        <tr>
                            <td><input type="checkbox" name="checkbox[]" value="<?php echo $key['id']; ?>"> </td>
                            <td width="10%"><?php echo $key['id'];?></td>
                            <td width="20%"><?php echo $key['productname'];?></td>
                            <td width="10%"><?php echo $key['categoryname'];?></td>
                            <td width="10%"><?php echo $key['price'];?></td>
                            <td width="10%"><span class="<?php if($key['activate']) echo 'text-success'; else echo 'text-error';?>"><?php if($key['activate']) echo "Activate"; else echo "Deactivate";?></span></td></td>
                            <td width="10%"><?php echo $key['time_created'];?></td>
                            <td width="10%"><?php echo $key['time_updated'];?></td>
                            <td><a href="#" class="btn btn-info">Edit</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="bulk-action">
                    <button class="btn btn-success" name="activate">Activate</button>
                    <button class="btn btn-danger" name="delete" onclick="return(confirm('Are you sure delete?'))">Delete</button>
                </div><!-- /bulk-action-->
                </form>
                <div class="dataTables_paginate">
                    <div class="dataTables_paginate">
                        <?php echo $link; ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>

    </div>
    <div class="dr"><span></span></div>

</div>

</div>
</body>
</html>
<?php
//var_dump($link);
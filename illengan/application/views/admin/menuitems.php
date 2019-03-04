    <!-- Content -->
    <div>
        <div>
            <span>Add Menu Item</span>
        </div>
        <form method="get">
            <div>
                <div>
                    <span>Item Name: </span>
                    <span>Item Description: </span>
                    <!-- <span>Size: </span> -->
                    <span>Category: </span>
                    <span>Price: </span>
                    <span>Menu Availability: </span>
                </div>
                <div>
                    <input type="text" name="item_name" value="">
                    <input type="text" name="item_desc" value="">
                    <!-- <input type="text" name="category_name" value=""> -->
                    <select name="category">
                        <?php 
                      if(!empty($category)){
                        foreach($category as $category_item){
                      ?>
                        <option value="<?php echo $category_item['category_id']?>">
                            <?php echo $category_item['category_name']?>
                        </option>
                        <?php
                        }
                      }
                      ?>
                    </select>
                    <input type="text" name="price" value="">
                    <input id="avail" type="radio" name="availability" value="available"><label
                        for="avail">Available</label>
                    <input id="unavail" type="radio" name="availability" value="unavailable"><label
                        for="unavail">Unavailable</label>
                </div>
            </div>
            <div>
                <button onclick="">Cancel</button>
                <button type="submit" formaction="<?php echo site_url('admin/menu/add')?>" value="Add">Add</button>
            </div>
        </form>
    </div>
    <div>
        <div>
            <span>Edit Menu Item</span>
        </div>
        <form method="get">
            <div>
                <div>
                    <span>Item Name: </span>
                    <span>Item Description: </span>
                    <!-- <span>Size: </span> -->
                    <span>Category: </span>
                    <span>Price: </span>
                    <span>Menu Availability: </span>
                </div>
                <div>
                    <input type="hidden" name="item_id" value="">
                    <input type="text" name="item_name" value="">
                    <input type="text" name="item_desc" value="">
                    <!-- <input type="text" name="category_name" value=""> -->
                    <select name="category">
                        <?php 
                      if(!empty($category)){
                        foreach($category as $category_item){
                      ?>
                        <option value="<?php echo $category_item['category_id']?>">
                            <?php echo $category_item['category_name']?>
                        </option>
                        <?php
                        }
                      }?>
                    </select>
                    <input type="text" name="price" value="">
                    <input id="" type="radio" name="availability" value=""><label for=""></label>
                </div>
            </div>
            <div>
                <button onclick="">Cancel</button>
                <button type="submit" formaction="<?php echo site_url('admin/menu/add')?>" value="Add">OK</button>
            </div>
        </form>
    </div>
    <div class="container">
        <table id="table" class="display">
            <thead>
                <tr>
                    <!-- <th scope="col">Code</th> -->
                    <th scope="col">Menu Item</th>
                    <th scope="col">Description</th>
                    <!-- <th scope="col">Size</th> -->
                    <th scope="col">Category</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    if (isset($menu)){
                      foreach ($menu as $item){
                    ?>
                <tr>
                    <!-- <th scope="row">1</th> -->
                    <td><?php echo $item['menu_name'] ?></td>
                    <td><?php echo $item['menu_description']?></td>
                    <!-- <td></td> -->
                    <td><?php echo $item['category_name']?></td>
                    <!-- <td>&#8369;</td> -->
                    <td><?php echo $item['menu_availability']?></td>
                    <td>
                        <div class="text-left mt-2">
                            <button class="btn btn-primary btn-xs mb-2" name="editmenu">Edit</button>
                            <button class="btn btn-success btn-xs mb-2"
                                formaction="<?php echo site_url('admin/menu/delete/'. $item['menu_id'])?>">Delete</button>
                        </div>
                    </td>
                </tr>
                <?php  }
                    }
                    ?>
            </tbody>

        </table>
    </div>
    <!-- Javascript -->
    <script src="<?php echo  framework_url()?>mdb/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo  framework_url()?>bootstrap-native/bootstrap.bundle.min.js"></script>
    <script src="<?php echo  framework_url()?>mdb/js/popper.min.js"></script>
    <script src="<?php echo  framework_url()?>mdb/js/mdb.min.js"></script>
    </body>

    </html>
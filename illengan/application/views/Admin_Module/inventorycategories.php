<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <!-- SIDEBAR -->
        <div class="nav-left-sidebar dark-sidebar">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="dashboard.html">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>  
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column"><br>
                            
                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/dashboard')?>"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>
                            </li>
    
                            <li class="nav-item">
                                    <a class="nav-item" href="<?php echo site_url('admin/menu')?>"><i class=""></i>Menu Items</a>
                            </li>
    
                            <li class="nav-item">
                                    <a class="nav-item" href="<?php echo site_url('admin/sales')?>"><i class=""></i>Sales</a>
                               </li>
    
                            <li class="nav-item">
                                    <a class="nav-item" href="<?php echo site_url('admin/inventory')?>"><i class=""></i>Inventory</a>
                            </li>
    
                            <li class="nav-item">
                                    <a class="nav-item" href="<?php echo site_url('admin/tables')?>"><i class=""></i>Tables</a>
                            </li>
    
                            <li class="nav-item">
                                    <a class="nav-item" href="<?php echo site_url('')?>"><i class=""></i>Reports</a>
                            </li>
    
                            <li class="nav-item">
                                    <a class="nav-item" href="<?php echo site_url('admin/accounts')?>"><i class=""></i>Accounts</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    <!-- END OF SIDEBAR-->
        <div>
            <table id="tablevalues">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Number of Items</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($category)){
                        foreach($category as $category){
                    ?>
                    <tr id="category<?echo $category['category_id']?>">
                        <td><?php echo $category['category_name']?></td>
                        <td><?php echo $category['stock_no']?></td>
                        <td>
                            <button>Edit</button>
                            <button>Delete</button>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
    <!-- <div id="editModal"> 
        <div>
        <div>
        <div>
            <form method="get" action="<?php echo site_url('admin/category/edit/')?>">
                <input type="hidden" value="<??>">
                <span>CategoryName</span><input id="modalNameInput" type="text" value="">
            </form>
        </div>
        <div>
            <button>Cancel</button>
            <button formaction="<?php echo site_url('admin/category/edit/')?>">OK</button>
        </div>
    </div> -->
</html>
<script>
var tuples = ((document.getElementByID('tablevalues')).getElementsByTagName('tbody'))[0].getElementsByTagName('tr');
var tupleNo = tuples.length;
for(var x = 0; x < tupleNo;x++){
    tuples.lastChild.firstChild.addEventListener("click", showEditModal);
    tuples.lastChild.lastChild.addEventListener("click", showDeleteModal);
}   
    function editModal(event){
        var row = event.target.parentElement.parentElement;
        

        var arrayValues;
        for(var y = 0; y < array.length -1){
            arrayValues.push(escape(array[y].innerHTML));
        }
        event.target.parentElement.parentElement
    }
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= device-width, initial-scale= 1 shrink-to-fit= no">
    <link rel="icon" type="image/ico" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../../css/admin/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('application/css/frameworks/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/circular-std/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/css/admin/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/fontawesome/css/fontawesome-all.css')?>">
    <link rel="stylesheet"
        href="<?php echo base_url('application/others/fonts/material-design-iconic-font/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/flag-icon-css/flag-icon.min.css')?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>Il-Lengan</title>
</head>

<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="dashboard.html">Il-Lengan</a>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">

                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                                aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">John Abraham </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Navigation Bar -->

        <!-- Left Sidebar-->
        <div class="nav-left-sidebar dark-sidebar">

            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="dashboard.html">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column"><br>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/dashboard')?>"><i
                                        class="fa fa-fw fa-user-circle"></i>Dashboard</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/menu')?>"><i class=""></i>Menu
                                    Items</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/sales')?>"><i
                                        class=""></i>Sales</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/inventory')?>"><i
                                        class=""></i>Inventory</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/tables')?>"><i
                                        class=""></i>Tables</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('')?>"><i class=""></i>Reports</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/accounts')?>"><i
                                        class=""></i>Accounts</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- End of Left Sidebar -->

        <!-- Content -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <!--Billings-->
                <div class="container-fluid dashboard-content ">            <!--start of add menu-->
            <div style="width:40%;margin:5%;">
                <div>
                    <span>Add Menu Item</span>
                </div>
                <form method="post" action="<?php echo site_url("admin/menu/add")?>" enctype="multipart/form-data">   
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Menu Image</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="menu_image" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Item Name</span>
                        </div>
                        <input type="text" name="menu_name" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Description</span>
                        </div>
                        <input type="text" name="menu_description" class="form-control">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Category</span>
                        </div>
                            <select class="custom-select" name="category_id">
                                <?php 
                                    if(!empty($category)){
                                        foreach($category as $category_item){?>
                                                <option value="<?php echo $category_item['category_id']?>">
                                                    <?php echo $category_item['category_name']?>
                                                </option>
                                <?php }} ?>
                            </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Price ( &#8369; )</span>
                        </div>
                        <input type="text" name="menu_price" class="form-control">
                    </div>
            <div>
                <button onclick="" class="btn btn-secondary btn-xs mb-2">Cancel</button>
                <input class="btn btn-success btn-xs mb-2" type="submit" name="insert" value="Insert" />
            </div>
            </form>
        </div>
        <!--end of add menu-->
        

        <!--start of edit menu-->
        <div id="editModel" style="width:40%;margin:5%;">
            <div>
                <span>Edit Menu Item</span>
            </div>
            <form method="post" action="<?php echo site_url('admin/menu/edit')?>" >
            <input type="hidden" name="menu_id" id="menu_id" value="" />
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Item Name</span>
                    </div>
                    <input type="text" value="" id="new_name" name="new_name" class="form-control">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm"style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Description</span>
                    </div>
                    <input type="text" value="" id="new_description" name="new_description"class="form-control">
                </div>
                <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Category</span>
                        </div>
                        <select class="custom-select"  id="new_category" name="new_category" >
                            <?php 
                                if(!empty($category)){
                                    foreach($category as $category_item){?> 
                                        <option value="<?php echo $category_item['category_id']?>">
                                            <?php echo $category_item['category_name']?>
                                        </option>
                                        <?php } }?>
                        </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Price ( &#8369; )</span>
                    </div>
                    <input type="text" value="" id="new_price" name="new_price" class="form-control">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Menu Status</span>
                    </div>
                        <select class="custom-select" id="new_availability" name="new_availability">
                            <option value="Available" selected="selected">Available</option>
                            <option value="Unavailable">Unavailable</option>
                        </select>
                </div>
                <div>
                    <button onclick="" class="btn btn-secondary btn-xs mb-2">Cancel</button>
                    <button type="submit" class="btn btn-success btn-xs mb-2">Update</button>
                </div>
            </form>
            <!--end of update-->
        </div>



        <div class="table-responsive" style="width:100%;">
            <table id="tablevalues" class="table">
                <thead class="bg-light">
                    <tr>
                        <!-- <th scope="col">Code</th> -->
                        <th style="width:15%;">Menu Image</th>
                        <th style="width:15%">Menu Item</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody style="background:white;">
                    <?php 
                    if (isset($menu)){
                      foreach ($menu as $item){
                    ?>
                    <tr>
                        <td>
                        <div style="width:100%;height:100px;overflow:hidden;border:2px solid gray; "><div><a href="<?php echo site_url("admin/menu/edit_image")?>" class="glyphicon glyphicon-pencil" style="font-size:14px;">edit</a></div>                   
                        <img name="editImage" data-image="<?php echo $item['menu_id']?>" style="width:100%;position:relative;" src="<?php echo base_url('uploads/'.$item['menu_image']) ?>"/>
                        </div>
                        </td>
                        <td><?php echo $item['menu_name'] ?></td>
                        <td><?php echo $item['menu_description']?></td>
                        <td><?php echo $item['category_name']?></td>
                        <td><?php echo $item['menu_price']?></td>
                        <td><?php echo $item['menu_availability']?></td>
                        <td>
                            <div class="text-left mt-2">
                            <button name="editMenu" data-id="<?php echo $item['menu_id']?>"
                                                class="btn btn-primary btn-xs mb-2">Edit</button>
                                <a href="#" class="delete_data"
                                                id="<?php echo $item['menu_id'];?>"><button
                                                    class="btn btn-danger btn-xs mb-2">Delete</button></a>
                            </div>
                        </td>
                    </tr>
                    <?php  }
                    }
                    ?>
                </tbody>

            </table>
        </div>
   
    </div>
    </div>
    </div> 
     
    <script>
        $(document).ready(function() {
            $('.delete_data').click(function() {
                var id = $(this).attr("id");
                if (confirm("Are you sure you want to delete this?")) {
                    window.location = "<?php echo base_url(); ?>index.php/admin/delete_menu/" + id;
                } else {
                    return false;
                }
            });
        });

        var tuples = ((document.getElementById('tablevalues')).getElementsByTagName('tbody'))[0].getElementsByTagName(
            'tr');
        var tupleNo = tuples.length;
        var editButtons = document.getElementsByName('editMenu');
        var editModal = document.getElementById('editModal');
        for (var x = 0; x < tupleNo; x++) {
            editButtons[x].addEventListener("click", showEditModal);
        }

        function showEditModal(event) {
            var row = event.target.parentElement.parentElement.parentElement;
            document.getElementById('new_name').value = row.firstElementChild.nextElementSibling.innerHTML;
            document.getElementById('new_description').value = row.firstElementChild.nextElementSibling.nextElementSibling.innerHTML;
            document.getElementById('new_category').value = row.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML;
            document.getElementById('new_price').value = row.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML;
            document.getElementById('new_availability').value = row.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML;
            document.getElementById('menu_id').value = event.target.getAttribute('data-image');
        
        }

        $('#inputGroupFile01').on('change',function(){
                //get the file name
                var filePath = $(this).val();
                var fileName = filePath.replace('C:\\fakepath\\', " ");
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
    </script>
    <script>
        var tuples =  var tuples = ((document.getElementById('tablevalues')).getElementsByTagName('tbody'))[0].getElementsByTagName('tr');
        var tupleNo = tuples.length;
        var editButtons = document.getElementsByName('editImage');
        var editModal = document.getElementById('editImageModal');
        for (var x = 0; x < tupleNo; x++) {
            editButtons[x].addEventListener("click", showEditModal);
        }
        function showEditModal(event) {
            var row = event.target.parentElement.parentElement.parentElement;
            document.getElementById('new_image').value = row.firstElementChild.nextElementSibling.innerHTML;
            document.getElementById('menu_id').value = event.target.getAttribute('data-id');
        
        }
    </script>
     
        <script src="application/js/frameworks/jquery-3.3.1.min.js"></script>
        <!-- bootstap bundle js -->
        <script src="application/js/frameworks/bootstrap.bundle.js"></script>
        <!-- main js -->
        <script src="application/js/admin/main-js.js"></script>
        <!-- chart chartist js -->
        <script src="application/others/charts/chartist-bundle/chartist.min.js"></script>
        <!-- chart c3 js -->
        <script src="application/others/charts/c3charts/c3.min.js"></script>
        <script src="application/others/charts/c3charts/d3-5.4.0.min.js"></script>
        <script src="application/others/charts/c3charts/C3chartjs.js"></script>
        <script src="application/js/admin/dashboard.js"></script>
</body>
</html>
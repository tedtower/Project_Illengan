<!-- ADD CATEGORY-->
<div>
    <div>
        <span>Add Menu Category</span>
    </div>
    <form method="get">
        <div>
            <span>Category Name: </span><input type="text" name="category_name" value="">
        </div>
        <div>
            <button onclick="">Cancel</button>
            <button type="submit" formaction="<?php echo site_url('admin/menucategories/add')?>">Add</button>
        </div>
    </form>
</div>
<!-- END ADD CATEGORY-->
<!-- EDIT CATEGORY -->
<div id="editModal">
    <div>
        <span>Edit Menu Category</span>
    </div>
    <div>
        <form method="get" action="<?php echo site_url('admin/menucategories/edit')?>">
            <input id="category_id" type="hidden" name="category_id" value="">
            <span>CategoryName</span><input id="new_name" name="new_name" type="text" value="">
            <div>
                <button>Cancel</button>
                <button type="submit">OK</button>
            </div>
        </form>
    </div>
</div>
<!-- END EDIT CATEGORY -->
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
            <tr>
                <td><?php echo $category['category_name']?></td>
                <td><?php echo $category['menu_no']?></td>
                <td>
                    <button name="editCategory" data-id="<?php echo $category['category_id']?>">Edit</button>
                    <a href="<?php echo site_url('admin/menucategories/delete/'.$category['category_id'])?>">Delete</a>
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

</html>
<script>
var tuples = ((document.getElementById('tablevalues')).getElementsByTagName('tbody'))[0].getElementsByTagName('tr');
var tupleNo = tuples.length;
var editButtons = document.getElementsByName('editCategory');
// var deleteButtons = document.getElementsByName('deleteCategory');
var editModal = document.getElementById('editModal');
for (var x = 0; x < tupleNo; x++) {
    editButtons[x].addEventListener("click", showEditModal);
    // deleteButtons[x].addEventListener("click", showDeleteModal);
}

function showEditModal(event) {
    var row = event.target.parentElement.parentElement;
    document.getElementById('new_name').value = row.firstElementChild.innerHTML;
    document.getElementById('category_id').value = event.target.getAttribute('data-id');
}

function showDeleteModal() {

}
</script>
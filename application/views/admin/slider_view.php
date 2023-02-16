<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Slider</h4>
        </div>
        <div class="modal-body">
            <!-- Add Modal Form -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-primary">
                            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_slider/create" enctype="multipart/form-data">
                                <div class="box-body">
                                        <div class="form-group">
                                                    <label>Title</label>
                                                    <input class="form-control" id="txt_slider_title" name="txt_slider_title">
                                        </div>
                                        <div class="form-group">
                                                    <label>Title Text Color</label>
                                                    <div class="input-group my-colorpicker2">
                                                      <input type="text"  id="txt_slider_text_color" name="txt_slider_text_color" class="form-control">
                                                      <div class="input-group-addon">
                                                        <i></i>
                                                      </div>
                                                    </div>
                                        </div>
                                        <div class="form-group">
                                                    <label>SubTitle</label>
                                                    <input class="form-control" id="txt_slider_subtitle" name="txt_slider_subtitle">
                                        </div>
                                        <div class="form-group">
                                                    <label>SubTitle Text Color</label>
                                                    <input class="form-control" id="txt_slider_subtitle_color" name="txt_slider_subtitle_color">
                                        </div>
                                        <div class="form-group">
                                                    <label>Link</label>
                                                    <input class="form-control" id="txt_slider_link" name="txt_slider_link">
                                        </div>
                                        <div class="form-group">
                                                    <label>Image</label>
                                                    <input type="file" id="img_slider" name="img_slider">
                                        </div>
                                        <div class="form-group">
                                                    <label>Sort Order</label>
                                                    <input class="form-control" id="txt_slider_order" name="txt_slider_order">
                                        </div>
                                        <div class="form-group">
                                                    <label>Thumbnail</label>
                                                    <input type="file" id="img_slider_thumbnail" name="img_slider_thumbnail">
                                        </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </form>
                        </div></div>
                    
                </div>
            <!-- Add Modal Form Ends -->
        </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>

<div class="content-wrapper">
    
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                  <!--<h3 class="box-title" style="font-size:25px">Slider List</h3>
                <label style="float:right">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add New Slider</button>
                </label>-->


                <div class="row">
                    <div class="col-md-6">
                        <h3 class="box-title" style="font-size:25px">Slider List</h3>
                    </div><div class="col-md-3">
                        <form id="search_form" name="search_form" method="post" action="<?php echo base_url()."admin/manage_slider/search/"; ?>">
                                        <div class="form-group" style="float:right">
                                                <!--<label>Search: -->
                                                    <input class="form-control" type="text" id="txt_search" name="txt_search" placeholder="Search slider title"  onKeyDown="submit_form(event);"
                                                value="<?php if(isset($search_data))
                                                {echo $search_data; }?>">
                                                <!--</label>-->
                                        </div>
                        </form>
                        <script type="text/javascript">
                            function submit_form(event)
                            {
                                //alert(event.keyCode);
                                if (event.keyCode == 13) 
                                {
                                    //window.location="http://www.google.com";
                                    document.getElementById("search_form").submit();
                                }
                            }
                        </script>
                    </div>
                    <div class="col-md-3">
                        <label style="float:right">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add New Slider</button>
                        </label>
                    </div>
                        
                </div>
            </div>


            <div class="box-body table-responsive no-padding">
            
                <table class="table table-bordered table-hover">
                              <thead>
                                  <th>#</th>
                                <th>Title</th>
                                <th>Title Text Color</th>
                                <th>SubTitle</th>
                                <th>SubTitle Text Color</th>
                                <th>Link</th>
                                <th>Image</th>
                                <th>Sort Order</th>
                                <th>Thumbnail</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            <?php
                            if(!isset($start_position))
                            {
                                $i=1;
                            }
                            else
                            {
                                $i=$start_position;
                            }
                            foreach($resultset->result() as $result_row)
                            {
                            ?>
                                <tr>
                                <td><?php echo $i; ?></td>
                                    <td><?php echo $result_row->slider_title; ?></td>
                                    <td><?php echo $result_row->slider_title_text_color; ?></td>
                                    <td><?php echo $result_row->slider_subtitle; ?></td>
                                    <td><?php echo $result_row->slider_subtitle_text_color; ?></td>
                                    <td><?php echo $result_row->slider_link; ?></td>
                                    <td>
                                    <?php 
                                        if(trim($result_row->slider_image)!="")
                                        {
                                        ?>
                                    <img src="<?php echo base_url(); ?>files/admin/slider/thumb/<?php echo $result_row->slider_image; ?>" width="40px">
                                        <?php 
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $result_row->slider_order; ?></td>
                                    <td>
                                    <?php 
                                        if(trim($result_row->slider_thumbnail)!="")
                                        {
                                        ?>
                                    <img src="<?php echo base_url(); ?>files/admin/slider/thumb/<?php echo $result_row->slider_thumbnail; ?>" width="40px">
                                        <?php 
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-success" class="btn btn-info" data-toggle="modal" data-target="#editModal" onclick="get_edit_data(<?php echo $result_row->slider_id; ?>);"><em class="fa fa-pencil"></em></a>
                                        <a class="btn btn-danger confirm-delete" data-id="<?php echo $result_row->slider_id; ?>"><em class="fa fa-trash-o"></em></a>
                                    </td>
                                </tr>
                                <?php
                                    $i++;
                                } 
                                ?>
                            </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <?php 
                    if(isset($paging_string))
                    {
                        echo $paging_string; 
                    }
                ?>
              </ul>
            </div>
          </div>
           </div>
      </div>
    </section>
<!-- /.container-fluid -->
</div>
<script type="text/javascript">
function confirmDelete()
{
  return confirm("Are you sure you want to delete this?");
}
</script>
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Slider</h4>
        </div>
        <div class="modal-body">
            <!-- Edit Modal Form -->
                <div class="row">
                    <div class="col-lg-12" id="edit_div">
                    </div>
                </div>
            <!-- Edit Modal Form Ends -->
        </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>
<script type="text/javascript">
            var controller = "ajax/get_slider";
            var base_url = "<?php echo base_url(); ?>";

     function getXMLHTTP() { //fuction to return the xml http object
        var xmlhttp=false;  
        try{
            xmlhttp=new XMLHttpRequest();
        }
        catch(e)    {       
            try{            
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e){
                try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e){
                    xmlhttp=false;
                }
            }
        }
            
        return xmlhttp;
    }

    function get_edit_data(primary_id)
    {       
        var strURL=base_url+controller+"/"+primary_id;
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                    //alert(req.responseText);                      
                        document.getElementById("edit_div").innerHTML=req.responseText;
                        
                            $('.my-colorpicker2').colorpicker()
                            
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }               
            }           
            req.open("GET", strURL, true);
            req.send(null);
            
        }
    }

    
</script>
<div id="deleteModal"  class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" aria-hidden="true" class="close">X</a>
                 <h3>Delete Slider</h3>
            </div>
                <div class="modal-body">
                    <p>You are about to delete.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                        <a href="#" id="btnYes" class="btn btn-sm btn-danger">Yes</a>
                        <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-success">No</a>
                    
                </div>
            
        </div>
    </div>
</div>
<script>
$('#deleteModal').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#deleteModal').data('id', id).modal('show');
});

$('#btnYes').click(function() {
    // handle deletion here
    var id = $('#deleteModal').data('id');
    //$('[data-id='+id+']').remove();
    window.location=base_url+'admin/manage_slider/delete/'+id;
    $('#deleteModal').modal('hide');
});
</script>
<script src='<?php echo base_url(); ?>template/ckeditor/ckeditor.js'></script>
<script>
  $(function () {
      
                                            $('.my-colorpicker2').colorpicker()
                                            
      })
</script>



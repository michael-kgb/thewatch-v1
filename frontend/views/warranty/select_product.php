<select class="warranty-select-product"></select>
<script type="text/javascript">
   var produ = '<?php echo json_encode($products); ?>';
   var data_produ = $.map(JSON.parse(produ), function (obj) {
	    return { id: obj.id, text: obj.text, attr: obj.attr };
	  });
   function formatData (data) {
    if (!data.id) { return data.text; }
      if (data.type == 2){
        var $result= $(
          '<div style="position:relative;width:100%;"><span style="padding-right:10px;width:20%;"><img src="'+ data.attr +'"/></span><span class="hidden-lg hidden-sm hidden-md" style="width:65%;float:right;margin-top:10%;">' + data.text + '</span><span class="hidden-xs" style="width:75%;float:right;margin-top:10%;">' + data.text + '</span></div>'
        );
      }else {
        var $result= $(
          '<div style="position:relative;width:100%;"><span style="padding-right:10px;width:20%;"><img src="'+ data.attr +'"/></span><span class="hidden-lg hidden-sm hidden-md" style="width:65%;float:right;margin-top:10%;">' + data.text + '</span><span class="hidden-xs" style="width:75%;float:right;margin-top:10%;">' + data.text + '</span></div>'
        );
      }
      
      return $result;
    };
   $('.warranty-select-product').prepend('<option></option>').select2({
    width: '100%',
    placeholder: 'Nama Product',
    data: data_produ,
    allowClear: true,
    templateResult: formatData
  });
</script>
var orders = $('#data-orders').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": dataUrl,
    "columns": dataColumn,
    "columnDefs": [
        {
            "targets": [ 6, 7 ],
            "visible": false
        }
    ]
});

var warranty = $('#data-warranty').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": dataUrl,
    "columns": dataColumn,
    "columnDefs": [
        {
            "targets": [ 7, 8 ],
            "visible": false
        }
    ]
});

var serviceType = $('#data-service-type').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": dataUrl,
    "columns": dataColumn
});

var service = $('#data-service').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": dataUrl,
    "columns": dataColumn,
	"columnDefs": [
        {
            "targets": [ 9, 10, 11, 12 ],
            "visible": false
        }
    ]
});

var feedback = $('#data-feedback').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": dataUrl,
    "columns": dataColumn,
	"columnDefs": [
        {
            "targets": [ 9, 10, 11, 12 ],
            "visible": false
        }
    ]
});

var serviceManual = $('#data-service-manual').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": dataUrl,
    "columns": dataColumn,
	"columnDefs": [
        {
            "targets": [ 6, 7 ],
            "visible": false
        }
    ]
});

$('#filter-orders').on('click', function (e) {
	e.preventDefault();
	
	var orderDateFrom = $('input[name=date_from]').val(),
        orderDateTo = $('input[name=date_to]').val();
	
	orders.search('').columns().search('');
	
	if(orderDateFrom != 0){
        orders.column([6]).search(orderDateFrom);
    }
    
    if(orderDateTo != 0){
        orders.column([7]).search(orderDateTo);
    }
	
	orders.draw();
});

$('#filter-warranty').on('click', function (e) {
	e.preventDefault();
	
	var orderDateFrom = $('input[name=date_from]').val(),
        orderDateTo = $('input[name=date_to]').val(),
        status = $('select[name=warranty_status]')[0].value;
	
	warranty.search('').columns().search('');
	
	if(orderDateFrom != 0){
        warranty.column([7]).search(orderDateFrom);
    }
    
    if(orderDateTo != 0){
        warranty.column([8]).search(orderDateTo);
    }
    if(status != ''){
        warranty.column([4]).search(status);
    }
	
	warranty.draw();
});

$('#filter-servis').on('click', function (e) {
	e.preventDefault();
	
	var orderDateFrom = $('input[name=date_from]').val(),
        orderDateTo = $('input[name=date_to]').val(),
		serviceStatus = $('select#service_state_lang_id option:selected').val(),
		serviceDetailDropStoreId = $('select#service_detail_drop_store_id option:selected').val(),
		exportTo = $('select#export_to option:selected').val();
	
	service.search('').columns().search('');
	
	if(orderDateFrom != 0){
        service.column([6]).search(orderDateFrom);
    }
    
    if(orderDateTo != 0){
        service.column([7]).search(orderDateTo);
    }
	
	if(serviceStatus != 0){
		service.column([8]).search(serviceStatus);
	}
	
	if(serviceDetailDropStoreId != 0){
		service.column([9]).search(serviceDetailDropStoreId);
	}
	
	if(exportTo != 0){
		$.ajax({
			type: "GET",
			url: baseUrl + '/servis?export=Excel&serviceDateFrom=' + orderDateFrom + '&serviceDateTo=' + orderDateTo + '&serviceStatus=' + serviceStatus + '&serviceDetailDropStoreId=' + serviceDetailDropStoreId,
			success: function () {
				window.open(this.url,'_blank' );
			}
		});
	}
	
	service.draw();
});

$('#filter-servis-manual').on('click', function (e) {
	e.preventDefault();
	
	var orderDateFrom = $('input[name=date_from]').val(),
        orderDateTo = $('input[name=date_to]').val(),
		serviceStatus = $('select#service_state_lang_id option:selected').val();
	
	serviceManual.search('').columns().search('');
	
	if(orderDateFrom != 0){
        serviceManual.column([6]).search(orderDateFrom);
    }
    
    if(orderDateTo != 0){
        serviceManual.column([7]).search(orderDateTo);
    }
	
	if(serviceStatus != 0){
		serviceManual.column([3]).search(serviceStatus);
	}
	
	serviceManual.draw();
});
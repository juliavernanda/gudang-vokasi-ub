var url = 'http://'+window.location.hostname+":"+window.location.port;

function setFormValidation(id) {
  $(id).validate({
    highlight: function(element) {
      $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
      $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
    },
    success: function(element) {
      $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
      $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
    },
    errorPlacement: function(error, element) {
      $(element).closest('.form-group').append(error);
    },
  });
}

function sendAjax(response, link, type, dataType, redirect='') {
 if(redirect == '')
 {
	 $.ajax({
		 url 	: link,
		 type 	: type,
		 dataType: dataType,
		 success : function(data)
		 {
			 $(response).html(data);
		 }
	 });
 } else {
	 $.ajax({
		 url 	: link,
		 type 	: type,
		 dataType: dataType,
		 success : function(data)
		 {
			 if(data == 'redirect')
			 {
				 window.location.href = redirect;
			 } else {
				 $(response).html(data);
         $(response).selectpicker('refresh');
			 }
		 }
	 });
 }
}

function showLoading(target,type="",isClose="") {
  var gifLoad = url+"/assets/img/loader.gif";
  if(type == "form") {
    if(isClose == "close") {
      $(target+">#canvas_loading_form").delay(500).fadeOut(1000);
    } else if(isClose == "show") {
      var html = '<div id="canvas_loading_form" style="position: absolute;z-index: 9;width: 100%;height: 100%;text-align: center;background: #fff;">'+
                   '<span class="helper" style="display: inline-block; height: 100%; vertical-align: middle;"></span>'+
                   '<img src="'+gifLoad+'" style="vertical-align: middle;"/>'+
                 '</div>';
      $(target).prepend(html);
    }
  } else {
    $(target).html("<center><img src='"+gifLoad+"'/></center>");
  }
}

$('#province').change(function() {
	var province = $(this).val();
	sendAjax("#city", url+'/getCity/'+province,'get','html');
  $("#district").html("<option disabled selected value=''>Districts</option>").trigger('change');
  $("#subdistrict").html("<option disabled selected value=''>Sub-Districts</option>").trigger('change');
  $("#postalcode").val("");
});
$('#city').change(function() {
	var city = $(this).val();
	sendAjax("#district", url+'/getDistrict/'+city, 'get', 'html');
  $("#subdistrict").html("<option disabled selected value=''>Sub-Districts</option>").trigger('change');
  $("#postalcode").val("");
});
$('#district').change(function() {
	var district = $(this).val();
	sendAjax("#subdistrict", url+'/getSubDistrict/'+district, 'get', 'html').trigger('change');
  $("#postalcode").val("");
});
$('#subdistrict').change(function() {
	var subdistrict = $(this).val();
	$.ajax({
		url 	: url+'/getPostalCode/'+subdistrict,
		type 	: 'get',
		dataType: 'html',
		success : function(data)
		{
			$('#postalcode').val(data);
		}
	});
});

$('#province2').change(function() {
	var province = $(this).val();
	sendAjax("#city2", url+'/getCity/'+province,'get','html');
  $("#district2").html("<option disabled selected value=''>Districts</option>");
  $("#subdistrict2").html("<option disabled selected value=''>Sub-Districts</option>");
  $("#postalcode2").val("");
});
$('#city2').change(function() {
	var city = $(this).val();
	sendAjax("#district2", url+'/getDistrict/'+city, 'get', 'html');
  $("#subdistrict2").html("<option disabled selected value=''>Sub-Districts</option>");
  $("#postalcode2").val("");
});
$('#district2').change(function() {
	var district = $(this).val();
	sendAjax("#subdistrict2", url+'/getSubDistrict/'+district, 'get', 'html');
  $("#postalcode2").val("");
});
$('#subdistrict2').change(function() {
	var subdistrict = $(this).val();
	$.ajax({
		url 	: url+'/getPostalCode/'+subdistrict,
		type 	: 'get',
		dataType: 'html',
		success : function(data)
		{
			$('#postalcode2').val(data);
		}
	});
});

function setAjaxAdress(inputProvince, dataProvince, inputCity, dataCity, inputDistrict, dataDistrict, inputSubDistrict, dataSubDistrict, inputPostalCode, dataPostalCode) {
    $.ajax({
      url 	: url+'/getCity/'+dataProvince,
      type 	: 'get',
      dataType: 'html',
      success : function(data)
      {
        $(inputCity).html(data);
        $(inputCity).val(dataCity).trigger('change');
        $.ajax({
          url 	: url+'/getDistrict/'+dataCity,
          type 	: 'get',
          dataType: 'html',
          success : function(data)
          {
            $(inputDistrict).html(data);
            $(inputDistrict).val(dataDistrict).trigger('change');
              $.ajax({
                url 	: url+'/getSubDistrict/'+dataDistrict,
                type 	: 'get',
                dataType: 'html',
                success : function(data)
                {
                  $(inputSubDistrict).html(data);
                  $(inputSubDistrict).val(dataSubDistrict).trigger('change');
                  $(inputPostalCode).val(dataPostalCode);

                  $(".loading").fadeOut();
                }
              });
          }
        });
      }
    });
}






$(".toggle-password").click(function() {
   $(this).toggleClass("fa-eye fa-eye-slash");
   var input = $($(this).attr("toggle"));
   if (input.attr("type") == "password") {
     input.attr("type", "text");
   } else {
     input.attr("type", "password");
   }
 });



$('#autocomplete').keyup(function() {
	$('.show-result').fadeIn(100);
	var cari = $(this).val();
	sendAjax('.show-result', url+'/cari/autocomplete?key='+cari, 'get', 'html');
});
$('.cari_autocomplete').keyup(function() {
	$('.show-result').fadeIn(100);
	var cari = $(this).val();
	sendAjax('.show-result', url+'/cari/autocomplete?key='+cari, 'get', 'html');
});
// $('.traking-petugas').click(function(){
// 	var cari = $('#id_autocomplete').val();

// });
$('#cekNik').focusin(function(){
	$('.show-result-nik').fadeIn(100);
});
$('#cekNik').keyup(function() {
	$('.show-result-nik').fadeIn(100);
	var cari = $(this).val();
	sendAjax('.show-result-nik', url+'/cek/nik?key='+cari, 'get', 'html');
});
$('#cekNama').focusin(function(){
	$('.show-result-nama').fadeIn(100);
});
$('#cekNama').keyup(function() {
	var cari = $(this).val();
	sendAjax('.show-result-nama', url+'/cek/nama?key='+cari, 'get', 'html');
});
$('#autocomplete').focusin(function() {
	$('.show-result').show();
	$(this).attr('autocomplete','off');
});
$('.cari_autocomplete').focusin(function() {
	$('.show-result').show();
	$(this).attr('autocomplete','off');
});
$('.cari-petugas').click(function(){
	$('.popup').fadeIn(100);
	$.ajax({
		url 	: url+'/cari/petugas',
		type 	: 'get',
		dataType: 'html',
		success : function(data) {
			$('.window').html(data);
		}
	});
});
$('.close-btn').click(function() {
	$('.popup').fadeOut(100);
});
$('.glyphicon-remove').click(function() {
	$('.popup').fadeOut(100);
});
// $('.btn-select').click(function() {
// 	var nik = $(this).attr('id');
// 	$.ajax({
// 		url 	: '/dishub/select/petugas/'+id,
// 		type 	: 'get',
// 		dataType: 'html',
// 		success : function(data)
// 		{
// 			document.getElementById('add-petugas').innerHTML = data;
// 		}
// 	});
// });
$('.btn-read').click(function(){
	var id = $(this).attr('id');
	$('.popup').fadeIn(100);
	sendAjax('.window',url+'/read/message/'+id,'get','html');
});
$('.btn-add').click(function() {
	sendAjax('.page-ajax',url+'/users/tambah','get','html');
});
$('.edit-users').click(function() {
	var id = $(this).attr('id');
	sendAjax(".page-ajax",url+"/users/edit/"+id,"get","html");
});
$('.delete-users').click(function() {
	var id = $(this).attr('id');
	sendAjax('', url+'/users/delete/'+id, 'get', 'html', 'users');
});
$('#cari').keyup(function() {
	var cari = $(this).val();
	sendAjax('.response-cari', url+'/users/cari?s='+cari, 'get', 'html');
});
$('.btn-add-petugas').click(function() {
	sendAjax('.page-ajax', url+'/petugas/tambah', 'get', 'html');
});
$('#cari_petugas').keyup(function(){
	var cari = $(this).val();
	sendAjax('.response-cari', url+'/petugas/cari?s='+cari, 'get', 'html');
});
$('#cari_penugasan').keyup(function(){
	var cari = $(this).val();
	sendAjax('.response-cari', url+'/penugasan/cari?s='+cari, 'get', 'html');
});
$('.edit-penugasan').click(function() {
	var id = $(this).attr('id');
	sendAjax('.page-ajax', '/dishub/edit/penugasan/'+id, 'get', 'html');
});
$('.btn-delete').click(function(){
	var id = $(this).attr('id');
	sendAjax('', url+'/delete/message/'+id, 'get', 'json','pesan');
});
$('.hapus-penugasan').click(function() {
	var id = $(this).attr('id');
	sendAjax('', url+'/hapus/penugasan/'+id, 'get', 'html', 'petugas');
});
$('#nikah').change(function() {
	var nikah = $(this).val();
	if(nikah == 'nikah')
	{
		$('#jumlah_anak').removeAttr('disabled');
		$('#nama_pasangan').removeAttr('disabled');
	} else {
		$('#jumlah_anak').attr('disabled','disabled');
		$('#nama_pasangan').attr('disabled','disabled');
	}
});
$('.simpan-maps').click(function(){
	  var alamat = $('#pac-input').val();
	  $('#alamat').val(alamat);
	  $('#modal-maps').slideUp();
});
function page_item(id){
	$('.table-item').hide();
	$('.loading').show();
	$.ajax({
		type : "POST",
		url  : "./page_item",
		data : "id="+id,
		success:function(html){
			$('.table-item').show();
			$('.table-item').html(html);
			$('.loading').hide();
		}
	});
}
function page_view_item(id,nomor){
	$('.page_jos').hide();
	$.ajax({
		type : "GET",
		url  : url+"/page",
		data : {'id':id,'nomor':nomor},
		success:function(html){
			$('.page_jos').show();
			$('.response-cari').html(html);
		}
	});
}

function paginate_petugas(id) {
	$('.page_jos').hide();
	$.ajax({
		type : "GET",
		url  : url+"/page_petugas",
		data : {'id':id},
		success:function(html){
			$('.page_jos').show();
			$('.response-cari').html(html);
		}
	});
}


function ceknumber(div) {
  if($(div).val() < 0) {
    $(div).val(0);
  }
}

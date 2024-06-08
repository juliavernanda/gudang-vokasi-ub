function actionShowHistorySalary(){
  $('#modalhistorysalary').modal('show');
  $('#txtName').select2();
  var opt = '';
  $('#txtName').html(opt);
  $('#txtName').select2({
  placeholder: 'Search...',
  ajax: {
    url: "/autocomplete",
    dataType: 'json',
    delay: 250,
    processResults: function (data) {
      return {
        results:  $.map(data, function (item) {
          return {
            text: item.first_name + ' ' + item.last_name,
            id: item.nik
          }
        })
      };
    },
    cache: true
  }
});
   $('.datepicker#txtDate').datetimepicker({
    format: 'YYYY-MM-DD',
    maxDate: 'now',
    icons: {
      time: "fa fa-clock-o",
      date: "fa fa-calendar",
      up: "fa fa-chevron-up",
      down: "fa fa-chevron-down",
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-screenshot',
      clear: 'fa fa-trash',
      close: 'fa fa-remove'
    }
  });
   actionReset();
}

function actionReset() {
  $('#txtName').select2();
  var opt = '';
  $('#txtName').html(opt);
  $('#txtName').select2({
  placeholder: 'Search...',
  ajax: {
    url: "/autocomplete",
    dataType: 'json',
    delay: 250,
    processResults: function (data) {
      return {
        results:  $.map(data, function (item) {
          return {
            text: item.first_name + ' ' + item.last_name,
            id: item.nik
          }
        })
      };
    },
    cache: true
  }
});
  $('#divTypePayment').hide();
  $('#divSch').hide();
  $('#divTax').hide();
  // $('#txtDate').val('')
  $('#lblNik').text('');
  $('#hdNIK').val('');
  $('#lblRole').text('');
  $('#idRole').val('');
  $('#lblBank').text('');
  $('#lblRek').text('');
  $('#txtAmount').val('');
  $('#txtAllowance').val('');
  $('#txtTakeHome').val('');
  $('#lblTake').text('0');
  $('#slctRate').val('1').selectpicker('refresh');
  $('#slctPayment').val('1').selectpicker('refresh');
  $('#slctSch').val('1').selectpicker('refresh');

}

function getUser(id) {
    $.ajax({
      url : "/get_data_user",
      type : "GET",
      data : {nikUser : id},
      dataType : "json",
      success : function(data){
        var a = data[0];
        $('#lblNik').text(a.nik);
        $('#hdNIK').val(a.nik);
        $('#lblRole').text(a.name_user_category);
        $('#idRole').val(a.id_user_category);
        if(a.id_user_category == 6 || a.id_user_category == 7){
          $('#divTypePayment').show();
          $('#divSch').show();
          $('#divTax').hide();
          $('#slctRate').val('1').selectpicker('refresh');
          $('#slctPayment').val('1').selectpicker('refresh');
          $('#slctSch').val('1').selectpicker('refresh');
        }else{
          $('#divTypePayment').hide();
          $('#divSch').hide();
          $('#divTax').hide();
          $('#slctRate').val('Monthly').selectpicker('refresh');
          $('#txtTax').prop('disabled',true);
        }
        $('#lblBank').text(a.nama_type_rekening);
        $('#lblRek').text(a.rekening);
        $('#txtAmount').val(hilang_spasi(a.salary));
        $('#txtAllowance').val(a.allowance);
        actionCount();
      }
    });
  }

function hilang_spasi(string) {
  return string.split('.00').join('');
}

function changeType() {
  var rate      = $('#slctRate').val();
  if(rate == 'Mandays'){
    $('#divAllowance').hide();
  }else{
    $('#divAllowance').show();
  }
}

function changePay() {
  var payment      = $('#slctPayment').val();
  if(payment == 'Net'){
    $('#divTax').hide();
  }else{
    $('#divTax').show();
  }
}

function actionCount(){
  var rate      = $('#slctRate').val();
  var payment   = $('#slctPayment').val();
  var Gapok     = parseInt($('#txtAmount').val());
  var Allowance = parseInt($('#txtAllowance').val());
  var Days      = parseInt($('#txtDays').val());
  var total     = 0;
  var tax       = 0.025;
  if(isNaN(Gapok)) Gapok =0;
  if(isNaN(Allowance)) Allowance =0;
  if(isNaN(Days)) Days =0;

  if(payment == 'Net'){
    if(rate == 'Monthly'){
      total = Gapok + (Allowance * Days);
    }else if(rate == 'Mandays'){
      total = Gapok * Days;
    }   
  }else if(payment == 'Gross'){
    if(rate == 'Monthly'){
      var subtotal = (Gapok + (Allowance * Days)) * tax;
      total = (Gapok + (Allowance * Days)) - subtotal;
    }else if(rate == 'Mandays'){
      var subtotal = (Gapok  * Days) * tax;
      total = (Gapok * Days) - subtotal;
    }   
  }else{
    if(rate == 'Monthly'){
      total = Gapok + (Allowance * Days);
    }else if(rate == 'Mandays'){
      total = Gapok * Days;
    }   
  }
 
  $('#txtTakeHome').val(total);
  $('#lblTake').text(total);
}
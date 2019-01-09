function memberDetails( data ){
  var company_address = data.address;
  var address = '';
  if( null != company_address.street )
    address += company_address.street + '<br />';
  if( null != company_address.city )
    address += company_address.city;
  if( null != company_address.state )
    address += ', ' + company_address.state;
  if( null != company_address.zip )
    address += ' ' + company_address.zip + '<br />';

  if( null != data.website.url )
    address = address + '<a href="' + data.website.url + '" target="_blank">' + data.website.address + '</a>';

  var primary_contact = '';
  var contact = data.primary_contact;
  if( null != contact.name )
    primary_contact = contact.name + '<br/>';
  if( null != contact.title )
    primary_contact += '<em>' + contact.title + '</em><br/>';
  if( null != contact.email )
    primary_contact += '<a href="mailto:' + contact.email + '">' + contact.email + '</a><br/>';
  if( null != contact.phone )
    primary_contact += 'Office: ' + contact.phone + '<br/>';
  if( null != contact.cell )
    primary_contact += 'Cell: ' + contact.cell + '<br/>';
  primary_contact = '<div class="col-md">' + primary_contact + '</div>';

  var alt_contact = '';
  if( null != data.alt_contact.name ){
    var contact = data.alt_contact;
    alt_contact = contact.name + '<br />';
    if( null != contact.title )
      alt_contact += '<em>' + contact.title + '</em><br/>';
    if( null != contact.email )
      alt_contact += '<a href="mailto:' + contact.email + '">' + contact.email + '</a><br />';
    if( null != contact.phone )
      alt_contact += 'Office: ' + contact.phone + '<br/>';
    alt_contact = '<div class="col-md">' + alt_contact + '</div>';
  }

  var description_row = '';
  if( null != data.description )
    description_row = '<tr><td>&nbsp;</td><td colspan="2"><p>' + data.description + '</p></td></tr>';

  return '<table width="100%">' +
    '<colgroup><col style="width: auto;"><col style="width: 40%;"><col style="width: 60%;"></colgroup>' +
    '<tr>' +
      '<td>&nbsp;</td>' +
      '<td style="vertical-align: top;"><p>' + address + '</p></td>' +
      '<td style="vertical-align: top;"><div class="row">' + primary_contact + alt_contact + '</div></td>' +
    '</tr>' +
    description_row +
    '</table>';
}

(function($){
  var table = $('#member-list').DataTable({
    'ajax': {
      'url': wpvars.endpoint,
      'type': 'GET',
      'dataSrc': '',
      'beforeSend': function(xhr){
        xhr.setRequestHeader( 'X-WP-Nonce', wpvars.nonce );
      }
    },
    'columns': [
      {
        'className': 'details-control',
        'orderable': false,
        'data': null,
        'defaultContent': ''
      },
      {
        'className': 'bold',
        'data': 'company'
      },
      { 'data': 'primary_contact.first_name' },
      { 'data': 'primary_contact.last_name' }
    ],
    'order': [[1, 'asc']]
  });

  $('#member-list tbody').on('click', 'td.details-control', function(){
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    if( row.child.isShown() ){
      // This row is already open - close it
      row.child.hide();
      tr.removeClass('shown');
    } else {
      // Open this row
      row.child( memberDetails( row.data() ) ).show();
      tr.addClass('shown');
    }
  });
})(jQuery);
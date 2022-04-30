$(document).ready(function() {
    $.ajaxSetup({
      headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  }); 
  $('#users-table').DataTable({
      //dom: 'Bfrtip',
      initComplete: function () {
          // Apply the search
          this.api().columns().every( function () {
              var that = this;

              $( 'input', this.footer() ).on( 'keyup change clear', function () {
                  if ( that.search() !== this.value ) {
                      that
                          .search( this.value )
                          .draw();
                  }
              } );
          } );
      },
      processing: true,
      serverSide: true,
      language: {
          url: "{{ $lang }}"
      },    
      serverMethod: 'get',
      ajax: {
          url:"{{ route('datatables.data') }}"
      },
      language: {
          url: "{{ $lang }}"
      },  
      columns: [
          {data : "id", className : "select-checkbox"},
          {data: "qin", className: 'qin'},
          {data: "name", className: 'name'},
          {data: "email", className: 'email'},
          {data: "phone_num", className: 'phone_num'},  
          {data: "role", className: 'role'},                  
          {data: "created_at", className: 'created_at'},
          {data: 'action', className: 'action', visible : 'false'},                 
      ],              
      columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
      }],
      select: {
          style: 'os',
          selector: 'td:first-child'
      },
     // select: { style: 'multi+shift' },
      
  });
  $('.dataTables_length').addClass('bs-select');
  // Setup - add a text input to each footer cell
$('#users-table tfoot th').each( function () {
console.log($(this).text());
var title = $(this).text();
if(title ==  "{{ $tbl_action }}" || title ==''){
  
} else {
  $(this).html( '<input type="text" class="form-control" placeholder="'+title+'" />' );
}      
} );
});
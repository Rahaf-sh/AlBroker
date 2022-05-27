$(document).ready(function () {
    alert('sdsd');
    $('#my-users').DataTable({
        processing:true,
        serverSide:true,
        ajax: {
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            url:"http://localhost:8000/ajax"
        },
        columns:[
            {data:'id',name:'id'},
            {data:'name',name:'name'},
            {data:'email',name:'email'},
            {data:'type',name:'type'}
        ]

    });
    alert('sdsd');

});
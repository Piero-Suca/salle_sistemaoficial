@extends('adminlte::page')

@section('title', 'Producto')

@section('content_header')
    <h1>Producto</h1>
@stop

@section('content_header')
@stop

@section('content')
    @livewire('admin.producto-index')
@stop

@section('footer')
    <div class="footer text-center py-3">
        © 2024 Todos los derechos reservados.
    </div>
@stop

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
    <style>
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            bottom: 0;
            width: 100%;
            z-index: 1030; /* Ensure it is above other elements */
            box-shadow: 0 -1px 5px rgba(0,0,0,.1); /* Optional shadow for better separation */
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
    <script>
        $('#producto').DataTable({
            responsive: true,
            autoWidth: false,
            "language": {
            "lengthMenu": " Mostrar _MENU_ registro por página",
            "zeroRecords": "No se encontró el registro",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
            }
        });
    </script>
@stop

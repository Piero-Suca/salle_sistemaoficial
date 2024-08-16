<div class="mt-3">
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "¡Éxito!",
                text: "{{ session('success') }}"
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}"
            })
        </script>
    @endif
    <!-- formulario -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit mr-2"></i>
                Registro de un nuevo producto
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.producto.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categoría</label>
                            <select class="form-control" name="category_id" required>
                                <option selected disabled>Seleccione una opción</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre del producto</label>
                            <input type="text" class="form-control" name="name" placeholder="Nombre del producto" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <input type="text" class="form-control" name="description" placeholder="Ingrese una descripción" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="text" class="form-control" name="precio" placeholder="Ingrese el precio del producto" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="text" class="form-control" name="stock" placeholder="Ingrese el stock del producto" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Imagen</label>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="image" onchange="updateFileName(this)" accept="image/*" required>
                                <label class="custom-file-label" for="image">Seleccione la imagen</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="manual">Manual</label>
                            <div class="custom-file">
                                <input type="file" name="manual" class="custom-file-input" id="manual" onchange="updateFileName(this)" accept=".pdf" required>
                                <label class="custom-file-label" for="manual">Seleccione el manual</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- tabla de cursos--}}
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title text-center">
                <i class="fas fa-table mr-2"></i>
                Tabla de productos
            </h3>
        </div>
        <div class="card-body">
            <table id="producto" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Categoria</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Image</th>
                        <th>Manual</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->category->name }}</td>
                        <td>{{ $producto->name }}</td>
                        <td>{{ $producto->description }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>
                            @if($producto->image)
                                <img src="{{ asset('storage/' . $producto->image) }}" alt="Imagen del producto" style="width: 50px; height: auto;">
                            @else
                                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                            @endif
                        </td>
                        <td>
                            @if($producto->manual)
                                <a href="{{ asset('storage/' . $producto->manual) }}" target="_blank">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                </a>
                            @else
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                            @endif
                        </td>
                        <td width="10px">
                            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $producto->id }}"><i class="fas fa-edit"></i></a>
                        </td>
                        <td width="10px">
                            <form action="{{ route('admin.producto.destroy', $producto->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal de edición -->
                    <div class="modal fade" id="editModal{{ $producto->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $producto->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModal{{ $producto->id }}Label">Editar producto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.producto.update', $producto->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Categoría</label>
                                            <select class="form-control" name="category_id">
                                                <option disabled>Seleccione una opción</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $producto->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name{{ $producto->id }}">Nombre del producto</label>
                                            <input type="text" class="form-control" name="name" id="name{{ $producto->id }}" value="{{ $producto->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description{{ $producto->id }}">Descripción</label>
                                            <input type="text" class="form-control" name="description" id="description{{ $producto->id }}" value="{{ $producto->description }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="precio{{ $producto->id }}">Precio</label>
                                            <input type="text" class="form-control" name="precio" id="precio{{ $producto->id }}" value="{{ $producto->precio }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stock{{ $producto->id }}">Stock</label>
                                            <input type="text" class="form-control" name="stock" id="stock{{ $producto->id }}" value="{{ $producto->stock }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stock{{ $producto->id }}">Image</label>
                                            <input type="text" class="form-control" name="image" id="image{{ $producto->id }}" value="{{ $producto->image }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stock{{ $producto->id }}">Manual</label>
                                            <input type="text" class="form-control" name="manual" id="manual{{ $producto->id }}" value="{{ $producto->manual}}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</div>
<script>
    function updateFileName(input) {
        var fileName = input.files[0].name;
        var label = input.nextElementSibling;
        label.innerHTML = fileName;
    }
</script>

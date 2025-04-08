@foreach ($items as $item)
    <tr>
        <td class="text-center align-middle">{{ $item->email }}</td>
        <td class="text-center align-middle">{{ $item->name }}</td>
        <td class="text-center align-middle">
            <span class="badge bg-primary rounded-pill px-3 py-2">{{ $item->rol }}</span>
        </td>
        <td class="text-center align-middle">
            <button onclick="setIdUser({{ $item->id }})" class="btn btn-outline-warning btn-sm rounded-pill"
                data-bs-toggle="modal" data-bs-target="#change_password">
                <i class="bi bi-key-fill me-1"></i>Clave
            </button>
        </td>
        <td class="text-center align-middle">
            <div class="d-flex justify-content-center">
                <div class="form-check form-switch d-flex align-items-center">
                    <input class="form-check-input btn-sm" type="checkbox" role="switch" id="{{ $item->id }}"
                        {{ $item->active ? 'checked' : '' }} style="transform: scale(1.5); cursor: pointer">
                </div>
            </div>
        </td>
        <td class="text-center align-middle">
            <a href="{{ route('users.edit', $item->id) }}" class="btn btn-outline-primary btn-sm rounded-pill"
                data-bs-toggle="tooltip" title="Editar usuario">
                <i class="bi bi-pencil-square me-1"></i>Editar
            </a>
        </td>
    </tr>
@endforeach
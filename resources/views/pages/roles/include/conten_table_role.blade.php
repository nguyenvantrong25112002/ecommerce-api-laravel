@php
$stt = 1;
@endphp
@foreach ($roles as $role)
    <tr>
        <td>
            {{ $stt++ }}
        </td>
        <td class="edit_role" data-id_role="{{ $role->id_role }}" style="font-size: 1.3rem;" contenteditable
            id="id_role_{{ $role->id_role }}">
            {{ $role->name }}
        </td>
        <td>
            <button data-toggle="modal" data-target="#exampleModal" data-id_role="{{ $role->id_role }}"
                data-name_role="{{ $role->name }}" class="btn_edit_role btn badge badge-rounded badge-primary mb-2">
                <i class="icofont-ui-edit"></i>
                Sửa
            </button>
            <a href="{{ route('admin.roles.delete', ['id' => $role->id_role]) }}"
                class="badge badge-rounded badge-danger mb-2">
                <i class="icofont-bin"></i>
                Xóa
            </a>
        </td>
    </tr>
@endforeach

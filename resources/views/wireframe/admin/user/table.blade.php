<div class="table-rep-plugin table-wrapper table-responsive">
    <table id="user-data " class="table table-striped table-bordered dt-responsive mt-2"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th class="table-view-10">Name</th>
                <th class="table-view-30">Email</th>
                <th class="table-view-15">Role</th>
                <th class="table-view-1">Status</th>
                <th class="table-view-5">Created at</th>
                <th class="table-view-1"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Super admin</td>
                <td>superadmin@mailinator.com</td>
                <td>Super admin</td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input ms-2" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                            title="Change Status" data-url='{{ route('wireframe.usermanagements.status') }}'
                            onclick="popupMassage(event)">
                    </div>
                </td>
                <td>28-12-2023 13:01</td>
                <td>

                    <div class="btn-group" role="group">

                        <i class="mdi mdi-dots-vertical" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="true"></i>
                        <div class="dropdown-menu">
                            @can('usermanagements.edit')
                                <a class="dropdown-item" onclick="showEditModel(event)"
                                    href="{{ route('wireframe.usermanagements.edit', 1) }}">Edit</a>
                            @endcan
                            @can('usermanagements.destroy')
                                <a class="dropdown-item">
                                    Delete</a>
                            @endcan
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>Admin</td>
                <td>admin@mailinator.com</td>
                <td>Admin</td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input ms-2" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                            checked title="Change Status" data-url='{{ route('wireframe.usermanagements.status') }}'
                            onclick="popupMassage(event)">
                    </div>
                </td>
                <td>28-12-2023 13:01</td>
                <td>

                    <div class="btn-group" role="group">

                        <i class="mdi mdi-dots-vertical" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="true"></i>
                        <div class="dropdown-menu">
                            @can('usermanagements.edit')
                                <a class="dropdown-item" onclick="showEditModel(event)"
                                    href="{{ route('wireframe.usermanagements.edit', 1) }}">Edit</a>
                            @endcan
                            @can('usermanagements.destroy')
                                <a class="dropdown-item">
                                    Delete</a>
                            @endcan
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

</div>
